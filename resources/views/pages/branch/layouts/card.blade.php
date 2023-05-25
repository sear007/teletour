<div class="__card">
    <a href="{{url('hotel')}}/{{$hotel->id}}/{{slug($hotel->name)}}?{{http_build_query(request()->query())}}"></a>
    <div class="img_container">
        <img src="{{$post->feature_image}}"/>
    </div>
    <div class="info_container">
        <div class="box-info">
            <span class="name">{{$post->name}}</span>
            <span class="short_desc">{{Str::limit($post->short_description, 100, '...')}}<span>
        </div>
        <div class="card-reviews">
            <span>{{$post->location->name}}</span>
            <span>{{count($post->rooms)}} available room types</span>
        </div>
    </div>
</div>