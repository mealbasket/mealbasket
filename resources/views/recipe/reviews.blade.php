<div class="row" style="display: block;">
<h3 class="mt-4" id="reviews">Reviews</h3>

@auth
<form action="/recipe/review" method="POST">
  @csrf
  <textarea type="text" name="message" cols="50" rows="2" placeholder="Enter your review"> </textarea>
  <input type="text" name="id" value={{$recipe->id}} hidden>
  <button type="submit" class="btn py-1 btn-primary">Submit</button>
</form>
@endauth
</div>

@if(count($recipe->Reviews)>0)
  @foreach ($recipe->Reviews as $review)
  <div class="row mt-3 mb-4" style="display: block;">
    <span><img border="0" src="{{ asset('/img/user.png') }}" width="40" height="40">
    <p class="mb-0" style="font-weight: bold;">{{$review->User->name}}</p>
    </span>
    <p class="mb-0" style="font-size: 0.85rem; font-weight: 300;">{{$review->created_at->diffForHumans()}}</p>
    <p class="mb-0">{{$review->message}}</p>
    <p>
    @auth
      @if(Auth::User()->hasRole('admin'))
        <button class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete-review-form').submit();">Delete</button>
        <form id="delete-review-form" action="/recipe/review" method="POST" style="display: none;">
          @csrf
          {{ method_field('DELETE') }}
          <input type="text" name="id" value="{{$review->id}}" hidden>
        </form>
      @endif
    @endauth
    </p>
  </div>
  @endforeach
@else
  <p>No reviews yet!</p>
@endif

