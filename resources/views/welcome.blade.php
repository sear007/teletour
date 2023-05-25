@extends('layouts.app')
@section('title', 'Home')
@section('content')
	@include('components.home-slider')
	<div class="container">
		@include('components.forms.filter')
		@include('components.popular-sites')
		@include('components.what-is-tele-tour')
		@include('components.popular-destination')
	</div>
  	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection