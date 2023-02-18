@extends('navbar.header')
@section('title', 'Our Rooms/Room Detail')

@section('content')
@include('branch.layouts.banner', $branch);
<div class="container container-show-page">
    <div class="row">
        <div class="col-lg-9">
            <div class="branch-info">
                <p class="small text-muted mb-2"><i class="mr-2 fa fa-map"></i>{{$branch->address}}</p>
                <p class="text-muted mb-2">{{$branch->short_description}}</p>
                @include('branch.layouts.grid-photos', $branch)
                @foreach ($branch->rooms as $room)
                    @include('branch.layouts.room-card', ['room'=> $room, 'branch_id'=> $branch->id, 'branch_name'=> $branch->name])
                @endforeach
            </div>
        </div>
        <div class="col-lg-3">
            @include('branch.layouts.mini-map', ['title'=> $branch->name, 'long'=> $branch->long,'lat'=> $branch->lat])
        </div>
    </div>
</div>
@include('branch.layouts.modal-detail')
@include('branch.layouts.modal-reservation')
@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/css/swiffy-slider.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="{{asset('branch/css/stepper.css')}}" rel="stylesheet">
<link href="{{asset('branch/css/show-branch.css')}}" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous" defer></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous" defer></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.3/axios.min.js"></script>
<script src='{{asset("branch/js/reservation.js")}}'></script>
@endpush
@endsection