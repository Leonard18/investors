<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Earning;
use App\Transaction;




class EarningController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);

    }

    
    public static function newEarning($trans_id,$amount, $dueDate, $userId, $planId, $planTitle) {

        $newEarning = new Earning();
        $newEarning->transaction_id = $trans_id;
        $newEarning->amount = $amount;
        $newEarning->due_date = $dueDate;
        $newEarning->user_id = $userId;
        $newEarning->plan_id = $planId;
        $newEarning->plan_title = $planTitle;

        $newEarning->save();

    }
}
