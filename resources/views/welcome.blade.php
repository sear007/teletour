@extends('navbar.header')
@section('title', 'Home')
<style>
	.branchs{
		cursor: pointer;
	}
	.branchs:hover{
		transition: transform .5s ease;
  		transform: scale(1.1);
	}
</style>
@section('content')
	<div class="hero">
		<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image:url(images/bg_1.jpg);">
			<div class="overlay"></div>
			<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-end">
			<div class="col-md-6 ftco-animate">
				<div class="text">
					<h2>More than a hotel... an experience</h2>
					<h1 class="mb-3">Hotel for the whole family, all year round.</h1>
				</div>
			</div>
			</div>
			</div>
		</div>

		<div class="slider-item" style="background-image:url(images/bg_2.jpg);">
			<div class="overlay"></div>
			<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-end">
			<div class="col-md-6 ftco-animate">
				<div class="text">
					<h2>TeleTour Hotel &amp; Resort</h2>
					<h1 class="mb-3">It feels like staying in your own home.</h1>
				</div>
			</div>
			</div>
			</div>
		</div>
		</section>
	</div>
	<section class="ftco-section ftco-no-pb ftco-room">
		<div class="container">
			<div class="heading-section text-center ftco-animate">
				<span class="subheading">Turism Site</span>
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
<br>
    <section class="ftco-section ftco-wrap-about ftco-no-pt ftco-no-pb ftco-room">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-7 order-md-last d-flex">
						<div class="img img-1 mr-md-2 ftco-animate" style="background-image: url(images/about-1.jpg);"></div>
						<div class="img img-2 ml-md-2 ftco-animate" style="background-image: url(images/about-2.jpg);"></div>
					</div>
					<div class="col-md-5 wrap-about pb-md-3 ftco-animate pr-md-5 pb-md-5 pt-md-4">
	          <div class="heading-section mb-4 my-5 my-md-0">
	          	<span class="subheading">About Hotel</span>
	            <h2 class="mb-4">Hotel the Most Recommended</h2>
	          </div>
	          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
	          <p><a href="#" class="btn btn-secondary rounded">Reserve Your Room Now</a></p>
					</div>
				</div>
			</div>
		</section>

    <section class="testimony-section">
      <div class="container">
        <div class="row no-gutters ftco-animate justify-content-center">
        	<div class="col-md-5 d-flex">
        		<div class="testimony-img aside-stretch-2" style="background-image: url(images/testimony-img.jpg);"></div>
        	</div>
          <div class="col-md-7 py-5 pl-md-5">
          	<div class="py-md-5">
	          	<div class="heading-section ftco-animate mb-4">
	          		<span class="subheading">Testimony</span>
			          <h2 class="mb-0">Happy Customer</h2>
			        </div>
	            <div class="carousel-testimony owl-carousel ftco-animate">
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(images/person_1.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Gerald Hodson</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(images/person_2.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Gerald Hodson</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(images/person_3.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Gerald Hodson</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	              <div class="item">
	                <div class="testimony-wrap pb-4">
	                  <div class="text">
	                    <p class="mb-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
	                  </div>
	                  <div class="d-flex">
		                  <div class="user-img" style="background-image: url(images/person_4.jpg)">
		                  </div>
		                  <div class="pos ml-3">
		                  	<p class="name">Gerald Hodson</p>
		                    <span class="position">Businessman</span>
		                  </div>
		                </div>
	                </div>
	              </div>
	            </div>
	          </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-no-pb ftco-room">
    	<div class="container-fluid px-0">
    		<div class="row no-gutters justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">TeleTour Rooms</span>
            <h2 class="mb-4">Hotel Master's Rooms</h2>
          </div>
        </div>  
    		<div class="row no-gutters">
				@foreach($guest_house as $key => $guest)
    			<div class="col-lg-6">
    				<div class="room-wrap d-md-flex ftco-animate">
    					<a href="#" class="img {{ $key == 2 || $key == 3 ? 'order-md-last' : '' }}"><img src="{{$guest->feature_image}}" alt="" height="100%" width="100%"></a>
    					<div class="half left-arrow d-flex align-items-center">
    						<div class="text p-4 text-center">
    							<p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
    							<!-- <p class="mb-0"><span class="price mr-1">{{price($guest->price)}}</span> <span class="per">per night</span></p> -->
	    						<h3 class="mb-3"><a href="{{route('hotel.show', [$guest->id, slug($guest->name)])}}">{{$guest->name}}</a></h3>
	    						<p class="pt-1"><a href="{{route('hotel.show', [$guest->id, slug($guest->name)])}}" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
    						</div>
    					</div>
    				</div>
    			</div>
				@endforeach
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Read Blog</span>
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_1.jpg');">
              </a>
              <div class="text mt-3 text-center">
              	<div class="meta mb-2">
                  <div><a href="#">Oct. 30, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_2.jpg');">
              </a>
              <div class="text mt-3 text-center">
              	<div class="meta mb-2">
                  <div><a href="#">Oct. 30, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_3.jpg');">
              </a>
              <div class="text mt-3 text-center">
              	<div class="meta mb-2">
                  <div><a href="#">Oct. 30, 2019</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="instagram">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Photos</span>
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
@endsection
    