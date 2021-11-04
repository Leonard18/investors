@extends('layouts.custom')

@section('title', 'New Deposit - Dashboard | Investors')

@section('pageContent')

	<!-- Deposits history section -->
	<section class="section">
    <div class="container">
      <h1 class="grey-text lighten-3 mt-4">All Deposit</h1>

      <!-- Deposits table -->
      <div class="table-responsive">
        <table class="table table-striped highlight">
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
                @forelse(auth()->user()->deposits as $deposit)
                  <tr>
                    <td>{{ $deposit->id }}</td>
                    <td>{{ $deposit->amount }}</td>
                    <td>{{ $deposit->plan_id }}</td>
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



@endsection

