@extends('layouts.custom')

@section('title', 'All Transaction - Dashboard | Investors')

@section('pageContent')


	 <!-- Transaction history section -->
  <section class="section">
    <div class="container center">
      <h1 class="blue-grey-text lighten-3 mt-4 center">All Transaction</h1>
	  <p class="center"><small class="grey-text lighten-3">A table for both recent and completed transactions</small></p>
    </div>
  </section> <!-- End of transactions -->


  <!-- Completed Transactions -->

   <!-- Completed Transaction table -->
   
   <section class="mt-4">
   <h4 class="my-2 grey-text lighten-3">Completed Transactions</h4>
   <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="green lighten-1">
                <tr>
                  <th>#</th>
                  <th>Investment</th>
                  <th>Plans</th>
                  <th>Comm. Rate</th>
                  <th>Expected Return</th>
                  <th>Total</th>
                  <th>Date Entered</th>
                  <th>Due Date</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($completedTransactions as $comptrans)
                  <tr>
                    <td>{{ $comCount++ }}</td>
                    <td>{{ number_format($comptrans->amount_invested, 2, '.', ',') }}</td>
                    <td>{{ $comptrans->plan_title }}</td>
                    <td>{{ $comptrans->commission_rate }}</td>
                    <td>{{ number_format($comptrans->expected_return, 2, '.', ',') }}</td>
                    <td>{{ number_format($comptrans->total, 2, '.', ',') }}</td>
                    <td>{{ $comptrans->created_at }}</td>
                    <td>{{ $comptrans->expires_at }}</td>
                    <td>{{ $comptrans->status }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9">No records found! Start a new transaction <a href="{{ route('dashboard.newdeposits') }}">here</a></td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

   </section>


  <!-- Still Running Transactions -->


  <section class="mt-5">
  <h4 class="my-2 grey-text lighten-3">Still Running Transactions</h4>
   <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="cyan darken-5">
                <tr>
                  <th>#</th>
                  <th>Investment</th>
                  <th>Plans</th>
                  <th>Comm. Rate</th>
                  <th>Expected Return</th>
                  <th>Total</th>
                  <th>Date Entered</th>
                  <th>Due Date</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stillRunningTransactions as $stillrunningtrans)
                  <tr>
                    <td>{{ $stillCount++ }}</td>
                    <td>{{ number_format($stillrunningtrans->amount_invested, 2, '.', ',') }}</td>
                    <td>{{ $stillrunningtrans->plan_title }}</td>
                    <td>{{ $stillrunningtrans->commission_rate }}</td>
                    <td>{{ number_format($stillrunningtrans->expected_return, 2, '.', ',') }}</td>
                    <td>{{ number_format($stillrunningtrans->total, 2, '.', ',') }}</td>
                    <td>{{ $stillrunningtrans->created_at }}</td>
                    <td>{{ $stillrunningtrans->expires_at }}</td>
                    <td>{{ $stillrunningtrans->status }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9">No records found! Start a new transaction <a href="{{ route('dashboard.newdeposits') }}">here</a></td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

   </section>


  <!-- All Time Trasanctions -->

  <section class="mt-5">
  <h4 class="my-2 grey-text lighten-3">All Time Transactions</h4>
   <div class="table-responsive">
        <table class="table table-striped responsive-table">
            <thead class="teal">
                <tr>
                  <th>#</th>
                  <th>Investment</th>
                  <th>Plans</th>
                  <th>Comm. Rate</th>
                  <th>Expected Return</th>
                  <th>Total</th>
                  <th>Date Entered</th>
                  <th>Due Date</th>
                  <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allTransactions as $alltransaction)
                  <tr>
                    <td>{{ $allCount++ }}</td>
                    <td>{{ number_format($alltransaction->amount_invested, 2, '.', ',') }}</td>
                    <td>{{ $alltransaction->plan_title }}</td>
                    <td>{{ $alltransaction->commission_rate }}</td>
                    <td>{{ number_format($alltransaction->expected_return, 2, '.', ',') }}</td>
                    <td>{{ number_format($alltransaction->total, 2, '.', ',') }}</td>
                    <td>{{ $alltransaction->created_at }}</td>
                    <td>{{ $alltransaction->expires_at }}</td>
                    <td>{{ $alltransaction->status }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9">No records found! Start a new transaction <a href="{{ route('dashboard.newdeposits') }}">here</a></td>
                  </tr>
                @endforelse
            </tbody>
        </table>
      </div>

   </section>

  


@endsection