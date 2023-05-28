@extends('layouts.app')
@section('title', 'TeleTour || Hotel Master\'s Rooms')
@section('content')
	@include('components.banner', ['title' => 'Hotel', 'subTitle' => ' Master\'s Rooms', 'background' => ''])
	<div class="container">
		<div class="p-2"></div>
		@include('components.forms.filter')
	</div>
	<div class="ftco-section ftco-no-pb ftco-room content-rooms">
		<div class="container-fluid px-0">
			<div class="row no-gutters justify-content-center mb-5 pb-3">
				<div class="col-md-12"></div>
				<div class="col-md-3">
					<select onchange="window.location.href='{{ route('hotel.index') }}?{{ http_build_query(array_merge(request()->query(), ['roomTypeId' => ''])) }}' + this.options[this.selectedIndex].value" class="custom-select">
						<option value="">All Room Types</option>
						@foreach ($roomTypes as $type)
							<option @if(request('roomTypeId') == $type->id) selected @endif value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>					
				</div>
			</div>
			<div class="container">
				<div class="row">
					@forelse($branch as $key => $hotel)
						<div class="col-md-3 mb-4">
							@include('pages.branch.layouts.card', ['post' => $hotel])
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
						{{ $branch->withQueryString()->onEachSide(5)->links() }}
					</div>
				</div>
			</div>
	
		</div>
	</div>
  	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection