<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/nutrition')}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Nutrition</label>
    <div class="offset-md-3 col-md-6">
      @foreach($recipe->Nutrition as $rn)
      <input class="form-control" type="text" list="nutrition" name="rn[{{$loop->index}}][name]" value="{{$rn->name}}">
      <input class="form-control" type="text" list="units" name="rn[{{$loop->index}}][unit]" value="{{$rn->pivot->Unit->unit_short}}">
      <input class="form-control" type="text" name="rn[{{$loop->index}}][amount]" value="{{$rn->pivot->value}}">
      @endforeach
    </div>
    <datalist id="nutrition">
      @foreach($nutrition as $n)
      <option>{{$n->name}}</option>
      @endforeach
    </datalist>
    <datalist id="units">
      @foreach($units as $u)
      <option>{{$u->unit_short}}</option>
      @endforeach
    </datalist>
  </div>
  <button type="submit" class="btn btn-primary">Update Nutrition</button>
</form>