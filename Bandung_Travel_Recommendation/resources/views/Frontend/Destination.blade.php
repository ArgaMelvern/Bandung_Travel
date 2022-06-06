@extends('Frontend.layouts.app')
@section('assets_css')
<link rel="stylesheet" href="{{asset('css/destination.css')}}">
<link rel="stylesheet" href="{{asset('css/animation.css')}}">
@endsection
@section('content')

<div class="row justify-content-start">
    <div class="col-3">
        <div class="side_category">
            <div id="progression" class="card mb-4">
                <div class="card-header text-center">Activity</div>
                <div class="card-body">
                    <div class="row">
                        <div id="side-step" class="col-md-4">
                            <div id="stepper4" class="bs-stepper vertical linear">
                                <div class="bs-stepper-header" role="tablist">
                                    <div id="stepper1" class="step active" data-target="#test-vl-1">
                                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger1" aria-controls="test-vl-1" aria-selected="true">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Pilih Destinasi</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div id="stepper2" class="step" data-target="#test-vl-2">
                                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger2" aria-controls="test-vl-2" aria-selected="true">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Checkout</span>
                                        </button>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div id="stepper3" class="step" data-target="#test-vl-3">
                                        <button type="button" class="step-trigger" role="tab" id="stepper4trigger3" aria-controls="test-vl-3" aria-selected="true">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Berhasil</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="list-dest" class="container">
                                @foreach($activity as $act)
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <h5>{{$act->name}}</h5>
                                            <button type="button" id="btn-delete-activity" class="btn-close" aria-label="Close" data-id="{{$act->id}}"></button>
                                        </li>
                                    </ul>
                                @endforeach
                            </div>
                            <div id="button-checkout">
                                <div class="btn_view">
                                    <a id="next-btn" onclick="show_hide();" href="#" class="btn btn-primary">Next</a>
                                    <a id="back-btn" onclick="revert();" href="#" class="btn btn-primary" style="display: none;">Reset</a>
                                    <a id="check-btn" onclick="show_hide();" href="#" class="btn btn-primary" style="display: none;">Checkout</a>
                                    <a id="save-btn" onclick="show_hide();" href="#" class="btn btn-primary" style="display: none;">Save</a>
                                    <p id="msg-success" href="#" style="color: green; display: none; text-decoration : none;">Berhasil disimpan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <section id="section_box">
            <div id="dest-selection" class="container" style="position: relative; bottom: 20px;">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Search Result</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="container-fluid">
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-1">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </button>
                            <ul class="dropdown-menu">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Alam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Taman Hiburan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Sejarah
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Alam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Taman Hiburan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Sejarah
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By
                            </button>
                            <ul class="dropdown-menu">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                A-Z
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Best Rating
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Favorite
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Random
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Random
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    @foreach($destinations->data as $destination)
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img class="image_src" src="{{asset('img/destination/'.$destination->image_name)}}" style="object-fit:cover">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <h4 class="card-title">{{$destination->name}}</h4>
                                                    <p class="card-text">Alamat : {{$destination->alamat}}</p>
                                                    <p>{{Str::limit($destination->description, 150)}}</p>
                                                    <p class="card-text"><small class="text-muted">{{$destination->updated_at}}</small></p>
                                                    <div id="button-dest" class="row">
                                                        <div class="col-md-11 btn_view">
                                                            <button href="#" id="btn-view" class="btn btn-primary" data-id="{{$destination->id}}">View More</button>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn-close" style="position: relative; left: 27px; bottom: 10px;" aria-label="Close"></button>
                                                    <div class="col-md-1 btn_view" style="padding-top:150px">
                                                        <a href="#" id="btn-add-activity" data-name="{{$destination->name}}" data-id="{{$destination->id}}" class="btn btn-primary">+</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
<nav aria-label="Page-navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

@endsection
@section('assets_js')
<script>
    function show_hide() {
        var next = document.getElementById("next-btn");
        var back = document.getElementById('back-btn')
        var check = document.getElementById("check-btn");
        var save = document.getElementById("save-btn");
        var msg = document.getElementById("msg-success")
        var active2 = document.getElementById("stepper2");
        var active3 = document.getElementById("stepper3");
        if (save.style.display === "none") {
            if (check.style.display === "none") {
                check.style.display = "inline-block";
                back.style.display = "inline-block"
                next.style.display = "none"
                active2.classList.add("active");
            } else {
                save.style.display = "inline-block"
                check.style.display = "none"
                active3.classList.add("active");
            }
        } else {
            msg.style.display = "inline-block"
            back.style.display = "none"
            save.style.display = "none"
        }

    }

    function revert() {
        var next = document.getElementById("next-btn");
        var back = document.getElementById('back-btn')
        var check = document.getElementById("check-btn");
        var save = document.getElementById("save-btn");
        var msg = document.getElementById("msg-success")
        var active2 = document.getElementById("stepper2");
        var active3 = document.getElementById("stepper3");
        if (active3.classList.contains("active")){
            active2.classList.remove("active");
            active3.classList.remove("active");
            back.style.display = "none"
            next.style.display = "inline-block"
            save.style.display = "none"
        }
        else{
            active2.classList.remove("active");
            check.style.display = "none"
            back.style.display = "none"
            next.style.display = "inline-block"
        }
    }

function addActivity(id, activity_name){
   document.getElementById("list-dest").innerHTML+=
  '<ul class="list-group"><li class="list-group-item d-flex justify-content-between align-items-center"><h5>'+activity_name+'</h5><button type="button" id="btn-delete-activity" class="btn-close" data-id="'+id+'" aria-label="Close"></button></li> </ul>'
}

$(function() {
    $(document).ready(function(){

    }).on('click', "#btn-view", function(){
      let id = $(this).data('id');
      let dialog = bootbox.dialog({
        size:'xl',
        message: '<center><div class="preloader"><div class="spinner-layer pl-red"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></center>'
      });

      dialog.init(function(e){
        let req = new XMLHttpRequest();
        req.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200) {
            dialog.find('.modal-content > .modal-body').html(this.responseText);
          }
        };
        req.open("GET", '{{url("destination/view")}}/'+id, true);
        req.send();
      });
    }).on('click', '#btn-add-activity', function(){
      let id = $(this).data('id'),
          name = $(this).data('name');
      $.ajax({
        url:"{{route('add.activity','')}}/"+id,
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data:{
          id:id,
        },
        success: function(response){
          alert('success');
          addActivity(id,name);
        },
        error: function(message){
          alert(JSON.stringify(message));
        },
      })

    }).on('click', '#btn-delete-activity', function(){
      let id = $(this).data('id');
      $.ajax({
        url:"{{route('delete.activity','')}}/"+id,
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data:{
          id:id,
        },
        success: function(response){
          alert('success');

        },
      })
    })
});
</script>

@endsection
