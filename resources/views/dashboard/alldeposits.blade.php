@extends('layouts.custom')

@section('title', 'New Deposit - Dashboard | Investors')

@section('pageContent')

	<!-- Deposits history section -->
	<section class="section">
    <div class="container">
      <div class="my-5">
        <div class="row">
          <div class="col-md-7">
          <h1 class="grey-text lighten-3">All Deposit</h1>
          </div>
          <div class="col-md-4">
            <a href="{{ route('dashboard.newdeposits') }}" class="btn btn-primary btn-large float-right btn-block">Add New Deposit</a>
          </div>
        </div>
      </div>

      

    <!-- All deposits section -->
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <h3 class="blue-grey-text center">All Time Deposits</h3>
          
          <div class="card-panel cyan darken-2">
            <div class="card-content">
              <h1 class="white-text center"><span style="text-decoration: line-through;">N</span> <br> {{ number_format($userDeposits, 2, '.', ',') }}</h1>
            </div>
          </div>

        </div>
      </div>
    </div>

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
                @forelse($deposits as $deposit)
                  <tr>
                    <td>{{ $deCounter++ }}</td>
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



@endsection

