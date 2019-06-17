<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/ingredients')}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Ingredients</label>
    <div class="offset-md-3 col-md-6">
      @foreach($recipe->Ingredients as $ri)
      <select class="form-control" name="ri[{{$loop->index}}][id]">
        @foreach($ingredients as $i)
        <option value="{{$i->id}}" @if($i->name == $ri->name) selected @endif>{{$i->name}}</option>
        @endforeach
      </select>
      
      <input class="form-control" type="text" name="ri[{{$loop->index}}][value]" placeholder="to taste"
        @if($ri->pivot->value != "to taste")
        value="{{$ri->pivot->value}}"
        @endif
        >
      <input class="form-control" type="text" list="units" name="ri[{{$loop->index}}][unit]" value="{{$ri->pivot->Unit->unit_short}}">
      @endforeach
    </div>

    <datalist id="units">
      @foreach($units as $u)
      <option>{{$u->unit_short}}</option>
      @endforeach
    </datalist>
  </div>
  <button type="submit" class="btn btn-primary">Update Ingredients</button>
</form>