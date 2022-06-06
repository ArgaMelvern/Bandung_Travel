<section>
    <div class="container py-4">
        <div class="row">
            <h3 class="modal-title" id="modal-title" style="position: relative; bottom:10px;">{{$data->name}}</h3>
            <a href="#" style="text-decoration: none; color:black;">Alamat : {{$data->alamat}}</a>
            <a href="#" style="text-decoration: none; position:relative; top: 20px;"><small class="text-muted">{{$data->place_types->name}}</small></a>
        </div>
        <hr style="width:100%; position:relative; top:13px">
    </div>
    <div id="container-img" class="container py-4" style="position:relative; bottom:25px;">
        <div class="row">
            <div id="img-modal">
                <img src="{{asset('img/destination/'.$data->image_name)}}" class="d-block w-100" style="border-radius: 10px;">
            </div>
        </div>
        <hr style="width:100%; position:relative; top:20px">
    </div>
    <div id="container-info" class="container py-4" style="position:relative; bottom:25px;">
        <div class="row">
            <div class="col-md-3" style="border-right: 0.5px solid #d3d3d3;">
                <div style="padding-left: 50px; padding-top: 8vh;">
                    <span style="position: relative; bottom:10px;">
                        <img src="{{asset('img/star.png')}}" id="star-img-info"> <a style="position: relative; left:5px; top:4px; font-size:20px;">{{$data->rate}} Rating</a>
                    </span>
                    <p class="card-text" style="position: relative;left: 35px; bottom: 0px"><small class="text-muted">({{$data->view}} views)</small></p>
                </div>
            </div>
            <div class="col-md-9">
                <div style="padding-left: 10px;">
                    <h3>Description</h3>
                    <p>{{$data->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
        <hr style="width:100%; position:relative; bottom:10px">
            <div class="tab-content" style="text-align-last:justify;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</section>
