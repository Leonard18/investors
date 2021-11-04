<?php

use App\Events\StatusUpdate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('event', function () {
  
//   event(new StatusUpdate('How are you?'));

// });

// Dashboard Pages section...
Route::middleware(['auth'])->group(function(){


  Route::get('dashboard', 'UserController@getIndex')->name('dashboard.index');


// Deposits Section...
  Route::get('dashboard/deposit/alldeposits', 'DepositController@getIndex')->name('dashboard.alldeposits');

  Route::get('dashboard/deposit/newdeposit', 'DepositController@addDeposit')->name('dashboard.newdeposits');
  
  // Add a new deposit to the table...
  Route::post('dashboard/deposit/newdeposit/', 'DepositController@postDeposit')->name('dashboard.postnewdeposits');


// Transactions section...
  Route::get('dashboard/transactions/alltransactions', 'TransactionController@getIndex')->name('dashboard.alltrans');

  Route::get('dashboard/transactions/recenttransactions', 'DashboardController@getRecentTrans')->name('dashboard.recenttrans');

  Route::get('dashboard/transactions/ongoingtransactions', 'DashboardController@getOngoingTrans')->name('dashboard.ongoingtrans');

  Route::get('dashboard/transactions/transactionsstatus', 'DashboardController@getStatusTrans')->name('dashboard.statustrans');


  // Returns
  Route::get('dashboard/returns', 'DashboardController@getReturns')->name('dashboard.returns');

  // Commissions
  Route::get('dashboard/commissions', 'DashboardController@getCommissions')->name('dashboard.commissions');

  // // Withdrawals...
  Route::get('dashboard/withdrawals', 'DashboardController@getWithdrawal')->name('dashboard.userWithdrawal');



  // Settings...
  Route::get('dashboard/settings', 'DashboardController@getSettings')->name('dashboard.settings');
  // Post Settings...
  Route::post('dashboard/settings/', 'DashboardController@postSettings')->name('dashboard.postsettings');

  // Support Center... 
  Route::get('dashboard/supportcenter', 'DashboardController@getSupports')->name('dashboard.supports');
  
  //Post Support Center... 
  Route::post('dashboard/supportcenter', 'DashboardController@postSupports')->name('dashboard.postsupports');


});


// Pages Section... This section is not surrended with any middleware..
Route::get('/contact', 'PagesController@getContact')->name('page.contact');
Route::get('/contact', 'PagesController@getPrivacyPolicy')->name('page.privacypolicy');
Route::get('/contact', 'PagesController@getTermsAndConditions')->name('page.tandc');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
