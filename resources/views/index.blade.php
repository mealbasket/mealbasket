@extends('layouts.app') 
@section('content')
<div class="container">
  <div class="row justify-content-center py-4">
    <div class="col-md-8">
      <img style="width: inherit;" src="{{asset('/img/howItWorks.png')}}" />
    </div>
  </div>

  <!--TODO: Same for $recent, $random, $activity-->


  <div class="row mt-3 pt-2">
    <h4>Some recently added dishes...</h4>
    <div class="offset-md-3 col-md-6">
      <div id="randomCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          @foreach ($random as $r)
          <li data-target="#randomCarouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
          @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
          @foreach ($random as $r)
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <img class="d-block img-fluid" src="{{$r->getImageUrl()}}" alt="{{$r->name}}">
            <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 20px; ">
              <h5 style="color: white; ">{{$r->name}}</h5>
            </div>
          </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#randomCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#randomCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($random as $r)
            <a href="{{ url( 'recipes/' . $r->id ) }}">
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
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>


</div>

@section('pagespecificscripts')
<script>
$(document).ready(function () {
    
// Or use this to Open link in same window (similar to target=_blank)
$(".swiper-slide").click(function(){
    window.location = $(this).find("a:first").attr("href");
    return false;
});

});

  var swiper = new Swiper('.swiper-container', {
      slidesPerView: 2,
      spaceBetween: 30,
      preloadImages: false,
      loop: true,
      lazy: true,
      watchSlidesVisibility: true,
      navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
</script>
@endsection