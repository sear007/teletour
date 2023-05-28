<section class="ftco-section ftco-no-pb ftco-room" style="margin-top: -30px">
    <div class="container">
        <div class="heading-section text-center ftco-animate">
            <h2 class="mb-4">Popular Site</h2>
        </div>
        <div class="row">
            @foreach($turism as $tour)
            <div class="col-md-3 branchs" style=" height: 350px;">
                <div style="overflow: hidden;height: 100%;border-radius: 5%;border: solid 1px #e0e0e0;">
                    <div style="height:50%;width:100%">
                        <img src="{{$tour->feature_image}}" alt="" height="100%" width="100%">
                    </div>
                    <div class="text-center" style="width: 100%;height:50%;">
                        <b class="text-center mb-4" style="color: black;margin-top: 5px;padding: 5px"><?= $tour->name ?></b>
                        <br>
                        <span ><?= $tour->address ?></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>