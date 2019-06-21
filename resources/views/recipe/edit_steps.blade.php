<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/steps')}}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Steps</label>
    <div class="offset-md-3 col-md-8">
      @foreach($recipe->Steps as $rs)
      <div id="rs[{{$loop->index}}]" class="py-1" style="border-bottom: 1px solid black;">
        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rs[{{$loop->index}}][id]">Step</label>
          <div class="col-md-9">
            <input class="form-control" type="number" name="rs[{{$loop->index}}][id]" value="{{$rs->id}}"><!--Recipe step number-->
          </div>
        </div>

        <div class="form-group row">
          <label class="col-for-label col-md-3" for="rs[{{$loop->index}}][text]">Description</label>
          <div class="col-md-9">
            <textarea class="form-control" type="text" name="rs[{{$loop->index}}][text]" col="50" rows="3">{{$rs->text}}</textarea>
          </div>
        </div>


      <div class="form-group row">
        <label class="col-md-4" for="rs[{{$loop->index}}][photo]">Image</label>
        <div class="col-md-8">
          <img class="py-2 my-2" src="{{ $rs->getImageUrl() }}" style="height: 150px; width: auto;">
        </div>
        <div class="col-md-12">
          <input class="form-control" type="file" name="rs[{{$loop->index}}][photo]"/>
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
  </div>
  <button type="submit" class="btn btn-primary">Update Steps</button>
</form>
