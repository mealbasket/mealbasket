@extends('layouts.app')
@section('content')


  <!--TODO: Same for $recent, $random, $activity-->


<div class="container-fluid full-width">
  <div class="row mt-5">
    <div class="col-md-12">
      <h3>Recently added recipes</h3>
      <div class="swiper-container swiper-recent">
        <div class="swiper-wrapper">
            @foreach ($recent as $r)
            <div class="swiper-slide">
                <img data-src="{{$r->getImageUrl()}}" class="d-block img-fluid swiper-lazy">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 20px; ">
                    <a href="{{ url( 'recipes/' . $r->id ) }}"><h5 style="color: white; ">{{$r->name}}</h5></a>
                  </div>
                <div class="swiper-lazy-preloader"></div>
            </div>
            @endforeach
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-recent"></div>
        <div class="swiper-button-prev swiper-button-prev-recent"></div>
        <div class="swiper-button-next swiper-button-next-recent"></div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center py-4 mt-2">
      <div class="col-md-6">
        <img class="img-fluid d-block" style="position:inherit; z-index: 999; width: inherit;" src="{{asset('/img/howItWorks.png')}}" />
      </div>
    </div>
<!-- <h5 style="z-index: 999; position: relative; padding-top: 40px">Choose from our large selection...</h5> -->
    <div class="row" style="margin-top: 0px">
        <div class="col-md-12">
          <h3>Random recipes</h3>
          <div class="swiper-container swiper-random">
            <div class="swiper-wrapper">
                @foreach ($random as $r)
                <div class="swiper-slide">
                    <img data-src="{{$r->getImageUrl()}}" class="d-block img-fluid swiper-lazy">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 20px; ">
                        <a href="{{ url( 'recipes/' . $r->id ) }}"><h5 style="color: white; ">{{$r->name}}</h5></a>
                      </div>
                    <div class="swiper-lazy-preloader"></div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-random"></div>
            <div class="swiper-button-prev swiper-button-prev-random"></div>
            <div class="swiper-button-next swiper-button-next-random"></div>
          </div>
        </div>
      </div>
      @isset($activity)
      <div class="row mt-5">
        <div class="col-md-12">
          <h3>Recently viewed recipes</h3>
          <div class="swiper-container swiper-recent">
            <div class="swiper-wrapper">
                @foreach ($activity as $a)
                <div class="swiper-slide">
                    <img data-src="{{$a->getImageUrl()}}" class="d-block img-fluid swiper-lazy">
                    <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 20px; ">
                        <a href="{{ url( 'recipes/' . $a->id ) }}"><h5 style="color: white; ">{{$a->name}}</h5></a>
                      </div>
                    <div class="swiper-lazy-preloader"></div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-recent"></div>
            <div class="swiper-button-prev swiper-button-prev-recent"></div>
            <div class="swiper-button-next swiper-button-next-recent"></div>
          </div>
        </div>
      </div>
      @endisset

</div>
@endsection

@section('pagespecificscripts')
<script>
$(document).ready(function () {
$(".swiper-slide").click(function(){
    window.location = $(this).find("a:first").attr("href");
    return false;
});

});

  if (window.matchMedia("(max-width: 600px)").matches) {

    $('.swiper-pagination').toggle();
    $('.swiper-button-prev').toggle();
    $('.swiper-button-next').toggle();

    var swiper = new Swiper('.swiper-recent', {
        slidesPerView: 2,
        spaceBetween: 10,
        preloadImages: false,
        loop: true,
        lazy: true,
        watchSlidesVisibility: true,
        navigation: {
        nextEl: '.swiper-button-next-recent',
        prevEl: '.swiper-button-prev-recent',
        },
        pagination: {
          el: '.swiper-pagination-recent',
          clickable: true,
        },
      });

      var swiper = new Swiper('.swiper-random', {
        slidesPerView: 3,
        spaceBetween: 10,
        preloadImages: false,
        loop: true,
        lazy: true,
        watchSlidesVisibility: true,
        navigation: {
        nextEl: '.swiper-button-next-random',
        prevEl: '.swiper-button-prev-random',
        },
        pagination: {
          el: '.swiper-pagination-random',
          clickable: true,
        },
      });
  } else {
    var swiper = new Swiper('.swiper-recent', {
        slidesPerView: 3,
        spaceBetween: 30,
        preloadImages: false,
        loop: true,
        lazy: true,
        watchSlidesVisibility: true,
        navigation: {
        nextEl: '.swiper-button-next-recent',
        prevEl: '.swiper-button-prev-recent',
        },
        pagination: {
          el: '.swiper-pagination-recent',
          clickable: true,
        },
      });

      var swiper = new Swiper('.swiper-random', {
        slidesPerView: 5,
        spaceBetween: 30,
        preloadImages: false,
        loop: true,
        lazy: true,
        watchSlidesVisibility: true,
        navigation: {
        nextEl: '.swiper-button-next-random',
        prevEl: '.swiper-button-prev-random',
        },
        pagination: {
          el: '.swiper-pagination-random',
          clickable: true,
        },
      });
  }


</script>
@endsection
