<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/nutrition')}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Nutrition</label>
    <div class="offset-md-3 col-md-6">
      @foreach($recipe->Nutrition as $rn)
      <div id="rn[{{$loop->index}}]" class="py-1" style="border-bottom: 1px solid black;">
        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][name]">Name</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="nutrition" name="rn[{{$loop->index}}][name]" value="{{$rn->name}}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][unit]">Unit</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="units" name="rn[{{$loop->index}}][unit]" value="{{$rn->pivot->Unit->unit_short}}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][amount]">Amount</label>
          <div class="col-md-9">
            <input class="form-control" type="text" name="rn[{{$loop->index}}][amount]" value="{{$rn->pivot->value}}">
          </div>
        </div>

        @if($loop->last)
          <a class="btn btn-success" style="color: white" id="addNutrition" data-lastindex="{{$loop->index}}"><i class="fas fa-plus" href="" role="button"></i></a>
        @else
          <a class="btn btn-danger" style="color: white" data-nutrition="rn[{{$loop->index}}]"><i class="fas fa-minus" href="" role="button"></i></a>
        @endif


      </div>
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
