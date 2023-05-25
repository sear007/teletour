@extends('layouts.app')
@section('title', 'TeleTour | About')
@section('content')
    @include('components.banner', [
        'title' => 'Tele Tours',
        'subTitle' => 'About us',
        'background' => '',
    ])
    <div class="container bg-white position-relative shadow rounded" style='top: -50px'>
       <div class="py-5">
		@include('components.what-is-tele-tour')
	   </div>
	</div>
@endsection