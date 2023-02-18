<div x-data="reservation" class='_card mb-3'>
    <div class='_card-image'>
        <img src='{{$room->fake_feature_image}}' alt='' />
    </div>
    <div class='_card-detail'>
        <div class='_card-detail-header'>
            <h1>{{$room->name}}</h1>
            <h5 class='price'>{{price($room->price)}}<span>/Night</span</h5>
        </div>

        <div class='_card-detail-body'>
            <div class="icons">
                <i class='fa fa-user'></i>
                <i class='fa fa-bed'></i>
                <i class="fa fa-bath"></i>
                <i class="fa-solid fa-car"></i>
            </div>
            @if ($room->short_description)
                <p>{{$room->short_description}}</p>
            @endif
        </div>

        <div class='_card-detail-footer'>
                <button 
                    data-branch-id="{{$branch_id}}" 
                    data-branch-name="{{$branch_name}}" 
                    data-room-type-id='{{$room->id}}'
                    data-room-type-name='{{$room->name}}'
                    data-room-type-feature-image='{{$room->fake_feature_image}}'
                    data-price='{{$room->price}}'
                    data-description='{{$room->description}}'
                    data-remark='{{$room->remark}}'
                    data-term-condition='{{$room->term_condition}}'
                    data-room-facilities='{{$room->room_facilities}}'
                    class='btn-detail btn btn-sm btn-primary'>
                    Detail
                </button>
                @auth
                    <button
                        data-branch-id="{{$branch_id}}" 
                        data-branch-name="{{$branch_name}}" 
                        data-room-type-id='{{$room->id}}'
                        data-room-type-name='{{$room->name}}'
                        data-room-price='{{$room->price}}'
                        class='btn-reserve btn btn-sm btn-primary'>
                        Reserve
                    </butoon>
                @else
                    <a role="button" href="{{route('login')}}" class='btn btn-sm btn-primary'>Reserve</a>
                @endauth
        </div>
    </div>
</div>