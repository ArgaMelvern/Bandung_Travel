<form id ="form" class="" action='{{route("admin.destination.add")}}' method="post" enctype="multipart/form-data">
  <!-- @csrf -->
  <div class="form-floating mb-3 col-md-12">
    <input type="text" class="form-control" name="inputName" id="name" placeholder="Place Name" value="{{$data->name ?? ''}}">
    <label for="floatingInput">Place Name</label>
  </div>
  <div class="form-floating mb-3 col-md-12">
    <textarea class="form-control" name="inputDescription" id="description" placeholder="Description" rows="10" style="height:100%;">{{$data->description ?? ''}}</textarea>
    <label for="floatingInput">Description</label>
  </div>
  <div class="form-floating mb-3 col-md-12">
    <input type="text" class="form-control" name="inputAlamat" id="address" placeholder="Address" value="{{$data->alamat ?? ''}}">
    <label for="floatingInput">Address</label>
  </div>
  <div class="form-floating mb-3 col-md-12">
    <input type="number" step="0.1" class="form-control" name="inputRate" id="rate" placeholder="Address" value="{{$data->rate ?? ''}}">
    <label for="floatingInput">Rate</label>
  </div>
  <select name="inputTypePlaceId" class="form-select mb-3 col-md-12" aria-label="Default select example">
    <option>Open this select menu</option>
    @foreach($destination_types as $destination_type)
      <option value="{{$destination_type->id}}" {{$data != null && $destination_type->id == $data->type_place_id ? 'selected' : ''}}>{{$destination_type->name}}</option>
    @endforeach
  </select>
  <div class="row">
    <div class="form-floating mb-3 col-md-6">
      <input type="text" class="form-control" name="inputLatitude" id="latitude" placeholder="Address" value="{{$data->latitude ?? ''}}">
      <label for="floatingInput">Latitude</label>
    </div>
    <div class="form-floating mb-3 col-md-6">
      <input type="text" class="form-control" name="inputLongitude" id="longitude" placeholder="Address" value="{{$data->longitude ?? ''}}">
      <label for="floatingInput">longitude</label>
    </div>
  </div>
  <div class="mb-3 col-md-12">
    <label for="formFile" class="form-label">Image</label>
    <input class="form-control" accept="image/*" type='file' name="inputImage" id="imgInp" onchange="loadFile(event)"/>
    <div class="mt-3">
      <img id="preview-img" src="{{$data == null ? '#' : asset('/img/destination/'.$data->image_name.'')}}" alt="your image" style="width:100%" onerror="this.style.display='none'"/>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary float-end" name="" value="Save">
  </div>
</form>

<script type="text/javascript">
  // var loadFile = function(event) {
  //   var output = document.getElementById('preview-img');
  //   output.src = URL.createObjectURL(event.target.files[0]);
  //   output.onload = function() {
  //     URL.revokeObjectURL(output.src)
  //   }
  // };
</script>
