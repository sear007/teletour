<form action="{{route('site.index')}}" class="filter-section">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-map"></i>
            </span>
        </div>
        <input name="province" id="input-popular-destination-value" type="hidden">
        <input name="province_name" autocomplete="off" id="input-popular-destination" type="text" class="form-control" placeholder="Where are you going?">
        <div id="__close-drop-down" class="input-group-append">
            <a href="#" class="close">x</a>
        </div>
        <div id="input-popular-destination__drop" class="__drop-down"></div>
    </div>
    <button type="submit" class="btn-search">search</button>
</form>	
@push('scripts')
	<script src="{{asset('js/filter.js')}}"></script>
@endpush