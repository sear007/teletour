@extends('navbar.header')
@section('title', 'TeleTour || Hotel Master\'s Rooms')
<style>
	.search {
		background-color: #ffffff;
		border-radius: 16px;
		box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
		text-align: center;
		margin-top: 20px;
	}
</style>

@section('content')
<div class="hero-wrap" style="background-image: url('images/bg_3.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text d-flex align-itemd-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
				<div class="text">
					<p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ url('/') }}">Home</a></span></p>
					<h1 class="mb-4 bread">Rooms</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ftco-section ftco-no-pb ftco-room content-rooms">
	<div class="container-fluid px-0">
		<div class="row no-gutters justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Tele Tour Rooms</span>
				<h2 class="mb-4">Hotel Master's Rooms</h2>
			</div>
			<div class="col-md-12"></div>

			<div class="col-md-3">
				<select onchange='window.location.href= `{{route("room")}}?roomTypeId=${this.options[this.selectedIndex].value}`' class="custom-select">
					<option value="">All Room Types</option>
					@foreach ($roomTypes as $type)
					<option @if(request('roomTypeId')==$type->id)) selected @endif value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="row no-gutters">
			@foreach($branch as $key => $hotel)
			<div class="col-lg-6">
				<div class="room-wrap d-md-flex ftco-animate">
					<a href="#" class="img {{ $key == 2 || $key == 3 ? 'order-md-last' : '' }}"><img src="{{$hotel->fake_feature_image}}" alt="" height="100%" width="100%"></a>
					<div class="half left-arrow d-flex align-items-center">
						<div class="text p-4">
							<p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
							<!-- <p class="mb-0"><span class="price mr-1">{{price($hotel->price)}}</span> <span class="per">per night</span></p> -->
							<h3 class="mb-3"><a href="{{route('room.show', [$hotel->id, slug($hotel->name)])}}">{{$hotel->name}}</a></h3>
							@foreach ($hotel->rooms as $room)
							<span class="badge badge-info">{{$room->name}}</span>
							@endforeach
							<p class="pt-1"><a href="{{route('room.show', [$hotel->id, slug($hotel->name)])}}" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<div class="row justify-content-center my-5">
			<div class="col-md-6">
				<div class="d-flex justify-content-center">
					{{ $branch->onEachSide(5)->links() }}
				</div>
			</div>
		</div>

	</div>
</div>
@push('scripts')
<script>
	$(document).ready(function() {
		// Handler for .ready() called.
		$('html, body').animate({
			scrollTop: $('.content-rooms').offset().top
		}, 'slow');
	});
</script>
@endpush
@endsection