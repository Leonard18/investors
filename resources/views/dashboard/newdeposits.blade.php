@extends('layouts.custom')

@section('title', 'New Deposit - Dashboard | Investors')

@section('pageContent')

	<div class="container mt-4">
		
		<div class="row justify-content-center">
			<div class="col-md-4">
				<h3 class="blue-grey-text center">All Time Deposits</h3>
				<div class="card blue darken-3">
					<div class="card-content white-text">
						<h1 class="center"><span style="text-decoration: line-through;">N</span> <br> 
							{{ number_format($userDeposits, 2, '.', ',') }}
						</h1>
					</div>
					<div class="card-action white-text">
						<h5>RECENT/ONGOING DEPOSIT</h5>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="section">
		<div class="container">

				<!-- Alert serction -->

				@if(Session::has('message'))
							
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success: </strong> {{ Session::get('message') }}							
							
							</div>
							
						@endif

						@if(Session::has('error'))
							
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Error: </strong> {{ Session::get('error') }}							
							
							</div>
							
						@endif

			<h1 class="grey-text lighten-3">New Deposit</h2>
			<p class="mb-4"><small>Please note that all fields are required</small></p>
			<div class="forn-section my-4">
				<form action="{{ route('dashboard.postnewdeposits') }}" class="mt-5" method="POST">
					@csrf

					<div class="input-field">
						<select name="plans" id="plans">

							@foreach($plans as $plan)
				
								<option value="{{ $plan->id }}">{{ $plan->title }} <span class="ml-5">{{ $plan->commission_rate }}</span></option>
		
							@endforeach
						</select>
						<label for="plan">Select Plan </label>
					</div>

					<div class="input-field mt-3">
						<input type="number" step="any" name="amount" id="amount" placeholder="Enter amount">
						<label for="name">Amount </label>
					</div>

					
					<div class="input-field">
						<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

					</div>
					

					<button class="cyan darken-3 white-text btn-block btn-large mt-4">Make Deposit</button>
				</form>
			</div>
		</div>
	</section>



	<!-- Deposits history section -->
	<section class="section">
    <div class="container">
      <h3 class="grey-text lighten-3 mt-4">Recent Deposit</h3>

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

  <div>
    <h1></h1>
  </div>



@endsection

@section('secondSection')

<script>
	document.addEventListener('DOMContentLoaded', function(){
		const plan = document.querySelector('#plans');
		M.FormSelect.init(plan, {});
	});
</script>

@endsection