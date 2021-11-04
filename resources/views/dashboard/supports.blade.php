@extends('layouts.custom')

@section('title', 'Support Center - Dashboard | Investors')

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
						<h1 class="center blue-gray-text">Support Center</h1>
						<p class="grey-text lighten-3 center">We are here to help with any project on your account!</p>
					</div>
				
					<form action="#" method="POST" role="form">
						@csrf 
						<div class="input-field mb-4">
							<input type="text" name="subject" id="subject" class="mb-2">
							<label for="subject">Subject</label>
						</div>
						<div class="input-field">
							<textarea name="description" id="desc" class="materialize-textarea mb-2"></textarea>
							<label for="desc">Description</label>
						</div>
						<button type="submit" class="btn btn-block btn-large blue darken-3 white-text my-5">Submit Ticket</button>
					</form>

				</div>
			</div>
		</div>
	</section>


@endsection

@section('secondSection')

	<script>
		document.addEventListener('DOMContentLoaded', function(){
			// Get the textarea field.. 
			const desc = document.querySelector("#desc");
			M.Textarea.init(desc, {});
		});
	</script>

@endsection


@section('secondSection')

	<script>

	</script>

@endsection