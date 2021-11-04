<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Image;
use App\User;
use App\Support;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getIndex() {

      $userName = auth()->user()->name;
      $userEmail = auth()->user()->email;
      $userPhone = auth()->user()->phone;
      $userCountry = auth()->user()->country;
      $userCreated_at = auth()->user()->created_at;

      return view('dashboard.index', compact('userName', 'userEmail', 'userPhone', 'userCountry', 'userCreated_at'));
    }

    // Deposit section...
    public function getAllDeposits() {
      return view('dashboard.alldeposits');
    }
    public function getRecentDeposits() {
      return view('dashboard.recentdeposits');
    }
    public function getNewDeposits() {

      $user_id = auth()->user()->id;

      $plans = Plans::all();


      return view('dashboard.newdeposits', compact('plans', 'user_id'));
    }

    // Add a new deposit to the deposit table... 
    public function postNewDeposits(Request $request) {

      // Validate the input fields value.. 
      $this->validate($request, array(
        'plans' => 'required',
        'amount' => 'required|numeric'
      ));

      // Find the user with the ID.. 
      $user = User::find($request->user_id);
      $user_id = $user->id;

      // Find the selected plan by the user... 
      $plan = Plans::find($request->plans);
      $plan_id = $plan->id;
      
      //Get the name of the plan... 
      $planTitle = $plan->title;
      $planReturn = $plan->commission_rate;

      // dd($planReturn);

      //Update the deposit table... 
      $deposit = new Deposit();

      $deposit->user_id = $user_id;
      $deposit->amount = $request->amount;
      $deposit->plan_id = $plan_id;
      $deposit->created_at = Carbon::now();
      $deposit->updated_at = Carbon::now();

      // Expected return date... 
      $expires_at = $deposit->created_at->addDays(30);

      // Expected return amount... 
      $expected_return = ($planReturn * $request->amount) / 100;

      $status = true;



      //Save the deposit... 
      $deposit->save();

      // Call the new transaction private method here... 
      (new self)::newTransaction($user_id, $expires_at, $expected_return, $plan_id, $status);

      // Send a flash message to the user... 
      Session::flash('message', 'A new deposit record has been added to your account!');

      $totalDeposits = Auth::user()->deposits->sum('amount');

      // dd($totalDeposits);

      

      // Return redirect... 
      return redirect()->route('dashboard.newdeposits');

    }

    // new transaction method
    private static function newTransaction($user_id,$expires_at,$expected_return,$plan_id,$status) {

        // Start the new transaction here... 
        $transaction = new Transactions();

        $transaction->user_id = $user_id;
        $transaction->expires_at = $expires_at;
        $transaction->expected_return = $expected_return;
        $transaction->plan_id = $plan_id;
        $transaction->status = $status;

        $transaction->save();

    }

    // Create a new entry in the plans_transactions table... 
    public static function plansTrans($planId, $tranId, $userId) {

      $planTran = new PlansTransactions();
      $planTran->plan_id = $planId;
      $planTran->transaction_id = $tranId;
      $planTran->user_id = $userId;

      $planTran->save();

    }

    public function getStatusDeposits() {
      return view('dashboard.statusdeposits');
    }


    // Transaction section...
    public function getAllTrans() {
      return view('dashboard.alltrans');
    }
    public function getRecentTrans() {
      return view('dashboard.recenttrans');
    }
    public function getOngoingTrans() {
      return view('dashboard.ongoingtrans');
    }
    public function getStatusTrans() {
      return view('dashboard.statustrans');
    }

    // Return section...
    public function getReturns() {
      return view('dashboard.returns');
    }

    // Commissions section...
    public function getCommissions() {
      return view('dashboard.commissions');
    }

    // Withdrawals section...
    public function getWithdrawal() {

      //Query the transaction table where expires at is completed.. 
      // $trans = Transactions::where(addHours)->get();


      return view('dashboard.withdrawal');
    }

    // Settings section...
    public function getSettings() {
      $user = auth()->user();
      return view('dashboard.settings', compact('user'));
    }

    //Post  Settings section...
    public function postSettings(Request $request, $id) {
      
      // Find the user with the id
      $user = User::find($id);
      dd($user);

      return view('dashboard.settings');
    }

    // Support section...
    public function getSupports() {
      return view('dashboard.supports');
    }
    
    //Submit New Support section...
    public function postSupports(Request $request) {

      // Grab the input field and validate them... 
      $this->validate($request, array(

        'subject' => 'bail|required|string|min:3|max:255',
        'description' => 'bail|required|string|min:10|max:1000',
      ));

      $ticketId = random_int(10000000, 99999999);
      // $ticketId = Str::random(5);
      // $ticketId = strtoupper($ticketId);
      // dd($ticketId);


      // Now, create a new suppot ticket... 
      $support = new Support();
      $support->subject = $request->subject;
      $support->description = $request->description;
      $support->user_id = auth()->user()->id;
      $support->ticket_id = $ticketId;

      // Save the support now.. 
      $support->save();

      // Send a flash message to the user.. 
      Session::flash('message', 'You have open a new support ticket. We will reply you as soon as possible');

      return redirect()->route('dashboard.supports');
    }

}
