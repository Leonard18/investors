<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Earning;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\UserController;


class TransactionController extends Controller
{

    // Return all transactions in the database...
    public function getIndex() {

        // All Trnsactions
        $allTransactions = auth()->user()->transactions->sortBy('id');
        $allCount = 1;

        // Completed Transactions
        $completedTransactions = auth()->user()->transactions()->where('status', 'Completed')->get();
        $comCount = 1;

        // Still Running Transactions...
        $stillRunningTransactions = auth()->user()->transactions()->where('status', 'Still Running')->get();
        $stillCount = 1;


        // Call both the statusUpdate and newEarning static methods...

        // Status Update...
        (new self)::statusUpdate();

        // New Earnings....
        (new self)::newEarning();



        return view('dashboard.alltrans', compact('allTransactions', 'completedTransactions', 'stillRunningTransactions', 'allCount', 'comCount', 'stillCount'));

    }


    // New Transaction record...
    public static function newTransaction($user, $invested, $return, $total, $comm, $planId, $planTitle, $status, $expires) {

        $trans = new Transaction();

        $trans->user_id = $user;
        $trans->amount_invested = $invested;
        $trans->expected_return = $return;
        $trans->total = $total;
        $trans->commission_rate = $comm;
        $trans->plan_id = $planId;
        $trans->plan_title  = $planTitle;
        $trans->status = $status;
        $trans->expires_at = $expires;

        $trans->save();

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
         ->select('id', 'user_id', 'amount_invested', 'plan_id', 'plan_title', 'expires_at')->where('status', 'Completed')
         ->where('processed', false)->get();


        //  dd($comTrans);


        // Loop through the array of the results from the query....
         foreach ($comTrans as $key => $value) {

            $earning[$key] = new Earning();
            $earning[$key]->transaction_id = $value->id;
            $earning[$key]->amount = $value->amount_invested;
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


}
