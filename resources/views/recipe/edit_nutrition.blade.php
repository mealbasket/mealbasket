<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/nutrition')}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Nutrition</label>
    <div id="rn-holder" class="offset-md-3 col-md-6">
      @foreach($recipe->Nutrition as $rn)
      <div id="rn[{{$loop->index}}]" class="py-1" style="border-bottom: 1px solid black;">
        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][name]">Name</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="nutrition" name="rn[{{$loop->index}}][name]" value="{{$rn->name}}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][unit]">Unit</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="units" name="rn[{{$loop->index}}][unit]" value="{{$rn->pivot->Unit->unit_short}}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[{{$loop->index}}][amount]">Amount</label>
          <div class="col-md-9">
            <input class="form-control" type="text" name="rn[{{$loop->index}}][amount]" value="{{$rn->pivot->value}}" required>
          </div>
        </div>

        <a class="btn btn-danger" style="color: white" onclick="deleteItem('rn[{{$loop->index}}]')"><i class="fas fa-minus" href="" role="button"></i></a>
      </div>
      @endforeach
    </div>
    <a class="btn btn-success" style="color: white" id="addNutrition" data-count="{{count($recipe->Nutrition)}}" onclick="addItem(this.getAttribute('data-count'))"><i class="fas fa-plus" href="" role="button"></i></a>
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


@section('pagespecificscripts')
@parent
<script>
    function deleteItem(id) {
      document.getElementById(id).remove();
    }
    function addItem(id) {
      var rawhtml=`<div id="rn[itemNumber]" class="py-1" style="border-bottom: 1px solid black;">
        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[itemNumber][name]">Name</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="nutrition" name="rn[itemNumber][name]" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[itemNumber][unit]">Unit</label>
          <div class="col-md-9">
            <input class="form-control" type="text" list="units" name="rn[itemNumber][unit]" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rn[itemNumber][amount]">Amount</label>
          <div class="col-md-9">
            <input class="form-control" type="text" name="rn[itemNumber][amount]" required>
          </div>
        </div>
        <a class="btn btn-danger" style="color: white" onclick="deleteItem('rn[itemNumber]')"><i class="fas fa-minus" href="" role="button"></i></a>
      </div>`;
      rawhtml = rawhtml.replace(new RegExp('itemNumber', "g"), id);
      var holder = document.getElementById('rn-holder');
      holder.innerHTML += rawhtml;
      document.getElementById('addNutrition').setAttribute( "data-count", +id + 1);
    }
</script>
@endsection