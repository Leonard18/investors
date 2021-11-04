@extends('layouts.custom')

@section('title', 'Home - Dashboard | Investors')

@section('pageContent')


  <!-- Section for the user information -->
  <div class="container">

    <ul class="collection with-header">
    
      <li class="collection-header">
        <h1>Your Dashboard</h1>
      </li>
      <li class="collection-item"><div>Full Name <span class="secondary-content" style="font-weight: bolder !important;">{{ $userName }}</span></div></li>
      <li class="collection-item"><div>Email <span class="secondary-content" style="font-weight: bolder !important;">{{ $userEmail }}</span></div></li>
      <li class="collection-item"><div>Phone <span class="secondary-content" style="font-weight: bolder !important;">{{ $userPhone }}</span></div></li>
      <li class="collection-item"><div>Registration date <span class="secondary-content" style="font-weight: bolder !important;">{{ $userCreated_at }}</span></div></li>
      <li class="collection-item"><div>Account Status <span class="secondary-content" style="font-weight: bolder !important;">
        {{ (auth()->user()->email_verified_at) ? 'Verified' : 'No verified' }}
      </span></div></li>

    </ul>

  </div>

  <!-- Section for User Investment statistics -->
  <section class="section mb-5">
    <div class="container">
      <h3 class="grey-text lighten-3 mt-4">Account Statistics</h3>
      <div class="row">

      <!-- Investment -->
        <div class="col-md-3 col-sm-6 col-lg-3">
          <div class="card  green darken-2 white-text py-3">
          <h1 class="center"><span style="text-decoration: line-through !important;">N</span> <br> {{ $totalInvest }}</h1>
          <h4 class="center">Invested</h4>
          </div>
        </div>

        <!-- Earned -->
        <div class="col-md-3 col-sm-6 col-lg-3">
          <div class="card  orange darken-2 white-text py-3">
          <h1 class="center"><span style="text-decoration: line-through !important;">N</span> <br> {{ $totalEarnings }}</h1>
          <h4 class="center">Earned</h4>
          </div>
        </div>

        <!-- Commisions -->
        <div class="col-md-3 col-sm-6 col-lg-3">
          <div class="card  purple darken-2 white-text py-3">
          <h1 class="center"><span style="text-decoration: line-through !important;">N</span> <br> {{ $allDepositsSum }}</h1>
          <h4 class="center">Deposits</h4>
          </div>
        </div>

        <!-- Withdrawn -->
        <div class="col-md-3 col-sm-6 col-lg-3">
          <div class="card  blue darken-2 white-text py-3">
          <h1 class="center"><span style="text-decoration: line-through !important;">N</span> <br> {{ $withdrawables }}</h1>
          <h4 class="center">Withdrawable</h4>
          </div>
        </div>
        
      </div>
        <a href="{{ route('dashboard.newdeposits') }}" class="btn btn-block cyan darken-5 white-text">Start New Transaction <i class="fa fa-chevron-right"></i></a>
    </div>
  </section> <!-- End of User statistics -->


  <!-- Earnings history section -->
  <section class="section">
    <div class="container">
      <h3 class="grey-text lighten-3 mt-4">Earnings History</h3>

      <!-- Earning table -->
      <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="green lighten-1">
                <tr>
                  <th>#</th>
                  <th>Amount Earned</th>
                  <th>Plan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($earnings as $earning)
                  <tr>
                    <td>{{ $ecounter++ }}</td>
                    <td>{{ number_format($earning->amount, 2, '.', ',') }}</td>
                    <td>{{ $earning->plan_title }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5">No records found!</td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

    </div>
  </section> <!-- End of earnings -->


  <!-- Transaction history section -->
  <section class="section">
    <div class="container">
      <h3 class="grey-text lighten-3 mt-4">Transaction History</h3>

      <!-- Transaction table -->
      <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="teal">
                <tr>
                  <th>#</th>
                  <th>Investment</th>
                  <th>Expected Return</th>
                  <th>Comm. Rate</th>
                  <th>Total</th>
                  <th>Plan</th>
                  <th>Date Entered</th>
                  <th>Completion Date</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
             <a href="{{ route('dashboard.alltrans') }}" class="float-right my-2">View All Transactions</a>
                @forelse($transactions as $transaction)
                  <tr>
                    <td>{{ $tcounter++ }}</td>
                    <td>{{ number_format($transaction->amount_invested, 2, '.', ',') }}</td>
                    <td>{{ number_format($transaction->expected_return, 2, '.', ',') }}</td>
                    <td>{{ $transaction->commission_rate }}</td>
                    <td>{{ number_format($transaction->total, 2, '.', ',') }}</td>
                    <td>{{ $transaction->plan_title }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->expires_at }}</td>
                    <td>{{ $transaction->status }}</td>
                  </tr>
                  
                @empty
                  <tr>
                    <td colspan="6">No records found! Start a new transaction <a href="#">here</a></td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

    </div>
  </section> <!-- End of transactions -->



  <!-- Deposits history section -->
  <section class="section">
    <div class="container">
      <h3 class="grey-text lighten-3 mt-4">Deposits History</h3>

      <!-- Deposits table -->
      <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="cyan">
                <tr>
                  <th>#</th>
                  <th>Amount</th>
                  <th>Plan</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deposits as $deposit)
                  <tr>
                    <td>{{ $dcounter++ }}</td>
                    <td>{{ number_format($deposit->amount, 2, '.', ',') }}</td>
                    <td>{{ $deposit->plan_title }}</td>
                    <td>{{ $deposit->created_at }}</td>
                    <td>{{ $deposit->status }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5">No records found! Start a new deposit <a href="{{ route('dashboard.newdeposits') }}">here</a></td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

    </div>
  </section>


  


  <div style="height: 100px;"></div>


@endsection
