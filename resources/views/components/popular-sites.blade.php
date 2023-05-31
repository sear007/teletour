<section class="ftco-section ftco-no-pb ftco-room mb-5">
    <div class="container">
        <div class="heading-section text-center ftco-animate">
            <h2 class="mb-4">Popular Sites</h2>
        </div>
        <div class="row">
            @foreach($sites as $site)
            <div class="col-md-3 branchs mb-3" style=" height: 350px;">
                <a href="{{route('site.show', ['site_id' => $site->id, 'site_name' => slug($site->name)])}}" class="text-dark">
                    <div style="overflow: hidden;height: 100%;border-radius: 5%;border: solid 1px #e0e0e0;">
                        <div style="height:50%;width:100%">
                            <img src="{{$site->feature_image}}" alt="" height="100%" width="100%">
                        </div>
                        <div class="text-center" style="width: 100%;height:50%;">
                            <b class="text-center mb-4" style="color: black;margin-top: 5px;padding: 5px"><?= $site->name ?></b>
                            <br>
                            <span ><?= $site->address ?></span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>