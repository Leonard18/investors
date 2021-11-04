<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserAccountController;
use App\Deposit;
use App\Plans;
use Carbon\Carbon;
use App\Transaction;
use App\UserAccount;
use App\Earning;
use Illuminate\Support\Facades\Auth;
use Session;


class DepositController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }
    
    public function getIndex()
    {

        // Get all deposit
        $deposits = auth()->user()->deposits()->orderBy('id', 'desc')->get();
        $deCounter = 1;

        // Grab the user total depsits from the user account table... 
        $userDeposits = auth()->user()->deposits()->sum('amount');
        

        // Return the view to the user... 
        return view('dashboard.alldeposits', compact('deposits', 'userDeposits', 'deCounter'));
    }



    public function addDeposit() {

        $userDeposits = auth()->user()->deposits()->sum('amount');
        // All Available Investment plans... 
        $plans = Plans::all();

        // Return the view with alll the information.... 
        return view('dashboard.newdeposits', compact('plans', 'userDeposits'));

    }

    public function postDeposit(Request $request) {

        // Validate the data from the user... 
        $this->validate($request, [
            'plans' => 'bail|required|integer',
            'amount' => 'bail|required|numeric',
            'user_id' => 'bail|required|integer',
        ]);

        // Query the Plans ID for the specific plan... 
        $plan = Plans::find($request->plans);
        $plan_id = $plan->id;
        $plan_title = $plan->title;
        $plan_comm_rate = $plan->commission_rate;

        // Current date... 
        $currentDate = Carbon::now();

        // Expires at date... Adding hours
        $expires_at = $currentDate->addMinutes(2);

        // Expected return... 
        $expected_return = ($plan_comm_rate * $request->amount) / 100;

        $total = $expected_return + $request->amount;

        // dd($total);


        // Create a new deposit record... 
        $deposit = new Deposit();
        $deposit->user_id = $request->user_id;
        $deposit->amount = $request->amount;
        $deposit->plan_id = $plan_id;
        $deposit->status = 'Approved';
        $deposit->plan_title = $plan_title;


        // Get the transaction status;
        $transStatus = 'Still Running';

        
        // Save the deposit data.. 
        $deposit->save();


        // After saving, this should create a new record in the transaction table...
        // The user deposit/investment will run for the specified number of days... 
        TransactionController::newTransaction($request->user_id, $request->amount, $expected_return, $total, $plan_comm_rate, $plan_id, $plan_title, $transStatus, $expires_at);

        

        //if(!$newTrans) {
           // Session::flash('error', 'There was an error creating new transaction records');
       // }

        // Send a flash message to the user... 
        Session::flash('message', 'Deposit successfull. A new transaction has also been opended on your account');

        // Redirect to the add deposit page... 
        return redirect()->route('dashboard.newdeposits');


    }




}
