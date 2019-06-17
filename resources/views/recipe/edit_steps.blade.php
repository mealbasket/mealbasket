<form class="justify-content-center" action="{{url('/recipes/'.$recipe->id.'/steps')}}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Steps</label>
    <div class="offset-md-3 col-md-6">
      @foreach($recipe->Steps as $rs)
      <input class="form-control" type="text" name="rs[{{$loop->index}}][id]" value="{{$rs->id}}"><!--Recipe step number-->
      <input class="form-control" type="text" name="rs[{{$loop->index}}][text]" value="{{$rs->text}}">
      <img src="{{ $rs->getImageUrl() }}" style="height: 150px; width: auto;">
      <input class="form-control" type="file" name="rs[{{$loop->index}}][photo]"/>
      @endforeach
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Update Steps</button>
</form>