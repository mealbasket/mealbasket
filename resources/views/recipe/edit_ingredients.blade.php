<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/ingredients')}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Ingredients</label>
    <div class="offset-md-3 col-md-6">
      @foreach($recipe->Ingredients as $ri)

      <div id="rs[{{$loop->index}}]" class="py-1" style="border-bottom: 1px solid black;">

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="ri[{{$loop->index}}][id]">Name</label>
          <div class="col-md-9">
            <select class="form-control" name="ri[{{$loop->index}}][id]">
              @foreach($ingredients as $i)
              <option value="{{$i->id}}" @if($i->name == $ri->name) selected @endif>{{$i->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="ri[{{$loop->index}}][value]">Amount</label>
          <div class="col-md-9">
            <input class="form-control" type="text" name="ri[{{$loop->index}}][value]" placeholder="to taste"
              @if($ri->pivot->value != "to taste")
              value="{{$ri->pivot->value}}"
              @endif
              >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="ri[{{$loop->index}}][unit]">Unit</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="units" name="ri[{{$loop->index}}][unit]" value="{{$ri->pivot->Unit->unit_short}}">
          </div>
        </div>

        @if($loop->last)
          <a class="btn btn-success" style="color: white"><i class="fas fa-plus" href="" role="button"></i></a>
        @else
          <a class="btn btn-danger" style="color: white"><i class="fas fa-minus" href="" role="button"></i></a>
        @endif

      </div>

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
