@extends('layouts.app')
@section('title', 'TeleTour || Hotel Master\'s Rooms')
@section('content')
	@include('components.banner', ['title' => 'Sites', 'subTitle' => 'Place to visit', 'background' => ''])
	<div class="ftco-section ftco-no-pb ftco-room content-rooms mt-5">
		<div class="container-fluid px-0">
			<div class="container">
				<div class="row">
					@forelse($sites as $key => $site)
						<div class="col-md-3 mb-4">
							@include('pages.sites.components.card', ['post' => $site])
						</div>
					@empty
						<div class="col-m-12">
							<div class="alert alert-primary w-" role="alert">
								<strong>We're sorry,</strong> Record not found.
							  </div>
						</div>
					@endforelse
				</div>
			</div>
	
			<div class="row justify-content-center my-5">
				<div class="col-md-6">
					<div class="d-flex justify-content-center">
						{{ $sites->withQueryString()->onEachSide(5)->links() }}
					</div>
				</div>
			</div>
	
		</div>
	</div>
  	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection