<form id ="form" class="" action='{{route("admin.destinationtype.add")}}' method="post" enctype="multipart/form-data">
  <!-- @csrf -->
  <div class="form-floating mb-3 col-md-12">
    <input type="text" class="form-control" name="inputName" id="name" placeholder="Place Name" value="{{$data->name ?? ''}}">
    <label for="floatingInput">Type Name</label>
  </div>
  <div class="mb-3">
    <input type="submit" class="btn btn-primary float-end" name="" value="Save">
  </div>
</form>
