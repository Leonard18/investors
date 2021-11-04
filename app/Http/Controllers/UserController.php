<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Deposit;
use App\Transaction;
use App\Earning;
use App\UserAccount;
use App\Withdrawable;
use App\Returns;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EarningController;



class UserController extends Controller
{
    public function __construnct() {
        $this->middleware(['auth']);
    }

    public function getIndex() {        

        // Grab the user info... 
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        $userPhone = auth()->user()->phone;
        $userCountry = auth()->user()->country;
        $userCreated_at = auth()->user()->created_at;


        // Send the user deposits and transactions alontg side...
        // Deposits 
        $deposits = auth()->user()->deposits()->get();
        $dcounter = 1;

        // Transactions
        $transactions = auth()->user()->transactions()->get();
        $tcounter = 1;


        // Earnings... 
        $earnings = auth()->user()->earnings()->get();
        $ecounter = 1;
        


        // User total Investment - For all running transactions... 
        $totalInvest = auth()->user()->transactions()->where('status', 'Still Running')->sum('amount_invested');
        $totalInvest = number_format($totalInvest, 2, '.', ',');

        // Total deposits  --- All time deposits... 
        $allDepositsSum = auth()->user()->deposits()->sum('amount');
        $allDepositsSum = number_format($allDepositsSum, 2, '.', ',');

        // User total earnings... 
        $totalEarnings = auth()->user()->transactions()
        ->where('status', 'Completed')
        ->where('processed', true)
        ->sum('expected_return');
        $totalEarnings = number_format($totalEarnings, 2, '.', ',');


        // Get the withdrawable amount from the withdrawable table... 
        $withdrawables = auth()->user()->transactions()
        ->where('status', 'Completed')
        ->where('processed', true)
        ->sum('total');
        $withdrawables = number_format($withdrawables, 2, '.', ',');


        // Trigger the statusUpdate static function here and inside the new transaction table below... 
        (new self)::statusUpdate();


         // Update the user earning info... 
         (new self)::newEarning();

  
        return view('dashboard.index', compact('userName', 'userEmail', 'userPhone', 'userCountry', 'userCreated_at', 'transactions', 'earnings', 'deposits', 'totalInvest', 'totalEarnings', 'allDepositsSum', 'withdrawables', 'dcounter', 'tcounter', 'ecounter'));


      }


      public static function statusUpdate()
      {
  
              // Get current time... 
          $now = Carbon::now();
          
          // Query for completed transaction... 
          auth()->user()->transactions()->where('expires_at', '<', $now)->update([
              'status' => 'Completed',
          ]);

      }


    //   New Earnings from "Completed" transactions 
    public static function newEarning() {

         //Grab all the transactions where status = "Completed"... 

         $comTrans = auth()->user()->transactions()
         ->select('id', 'user_id', 'amount_invested', 'expected_return', 'plan_id', 'plan_title', 'expires_at')->where('status', 'Completed')
         ->where('processed', false)->get();


        //  dd($comTrans);


        // Loop through the array of the results from the query.... 
         foreach ($comTrans as $key => $value) {
             
            $earning[$key] = new Earning();
            $earning[$key]->transaction_id = $value->id;
            $earning[$key]->amount = $value->expected_return;
            $earning[$key]->due_date = $value->expires_at;
            $earning[$key]->user_id = $value->user_id;
            $earning[$key]->plan_id = $value->plan_id;
            $earning[$key]->plan_title = $value->plan_title;

            // Save these records to the earnings tables....
            $earning[$key]->save();

            // Now update the 'processed' field of these transactions to true... 
            auth()->user()->transactions()
                ->where('status', 'Completed')
                ->where('processed', false)
                ->update([
                    'processed' => true,
                ]);
            
         }
    }

    // To be continued on the real application... 
    
}
