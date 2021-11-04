@extends('layouts.custom')

@section('title', 'Account Settings - Dashboard | Investors')

@section('pageContent')

	<section class="section my-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8">

					<div class="alert-section">

						@if(Session::has('message'))
							
							<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Success: </strong> {{ Session::get('message') }}
								<br>
								Your ticket ID is {{ 'ticketId' }}
							</div>
							
						@endif

					</div>

					<div class="section-header mb-4">
						<h1 class="center blue-gray-text">Update Account Info</h1>
					
					</div>

					<form action="" method="POST" role="form">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<h5>Name</h5>
								</div>
								<div class="col-md-8">
									<input type="text" name="name" value="{{ $user->name }}" class="form-control" disabled>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<h5>Email</h5>
								</div>
								<div class="col-md-8">
									<input type="text" value="{{ $user->email }}" class="form-control" disabled>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<h5>Phone</h5>
								</div>
								<div class="col-md-8">
									<input type="text" value="{{ $user->phone }}" class="form-control" disabled>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<h5>Country</h5>
								</div>
								<div class="col-md-8">
									<input type="text" value="{{ $user->country }}" class="form-control" disabled>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<h5>Account Status</h5>
								</div>
								<div class="col-md-8">
									<input type="text" value="{{ $user->email_verified_at ? 'verified' : 'Not verified' }}" class="form-control" disabled>
								</div>
							</div>
						</div>
						<button class="btn teal cyan darken-4 btn-block btn-large white-text" type="submit" disabled>Update Account Info</button>
					</form>
				</div>
			</div>
		</div>
	</section>


@endsection
