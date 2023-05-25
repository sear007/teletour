<section class="ftco-section ftco-no-pb ftco-room">
    <div class="container">
        <div class="heading-section text-center ftco-animate">
            <h2 class="mb-4">Popular Destination</h2>
        </div>
        <div class="row">
            @foreach($destination as $item)
            <div class="col-md-3 branchs mb-5">
                <div class="overflow-hidden w-100 h-100 rounded border">
                    <div class="overflow-hidden w-100" style="height:200px">
                        <img class="w-100 h-100" style="object-fit: cover" src="{{$item->feature_image}}" alt="" height="100%" width="100%">
                    </div>
                    <div class="text-center p-2">
                        <b class="text-center mb-4 text-dark"><?= $item->name ?></b>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>