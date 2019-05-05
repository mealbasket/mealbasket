<h3>Reviews</h3>

@auth
<form action="/recipe/review" method="POST">
  @csrf
  <input type="text" name="message" placeholder="Enter your review">
  <input type="text" name="id" value={{$recipe->id}} hidden>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endauth

@if(count($recipe->Reviews)>0)
  @foreach ($recipe->Reviews as $review)
    <p>{{$review->message}}
    {{$review->User->name}}
    {{$review->created_at->diffForHumans()}}
    @if(Auth::User()->hasRole('admin'))
      <button onclick="event.preventDefault();document.getElementById('delete-review-form').submit();">Delete</button>
      <form id="delete-review-form" action="/recipe/review" method="POST" style="display: none;">
        @csrf
        {{ method_field('DELETE') }}
        <input type="text" name="id" value="{{$review->id}}" hidden>
      </form>
    @endif
    </p>
  @endforeach
@else
  <p>No reviews yet!</p>
@endif