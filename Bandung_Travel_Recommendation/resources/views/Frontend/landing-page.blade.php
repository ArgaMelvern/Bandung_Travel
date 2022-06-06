
@extends('Frontend.layouts.app')
@section('assets_css')
  <link rel="stylesheet" href="{{asset('css/landing-page.css')}}">
  <link rel="stylesheet" href="{{asset('css/animation.css')}}">
@endsection
@section('content')

<!-- ================================================= BANNER ================================================== -->
  <div class="carousel slide carousel-fade overflow-hidden hero" data-bs-ride="carousel">
    <div class="banner p-0 m-0">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
          <img src="{{asset('img/ismail-hamzah-7od8rzWvUVU-unsplash.jpg')}}" alt="Los Angeles" class="d-block" style="width:100%">
          <div class="carousel-content">
            <span class="caption-1">VISIT <br/> BANDUNG</span>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <img src="{{asset('img/uji-kanggo-gumilang-xRixrjLL2W0-unsplash.jpg')}}" alt="Chicago" class="d-block" style="width:100%">
          <div class="carousel-content" style="text-align:center">
            <span class="caption-2">DISCOVER THE BEST OF<br/> BANDUNG</span>
          </div>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <img src="{{asset('img/rifqi-ali-ridho-1ftrPzqRMTo-unsplash.jpg')}}" alt="New York" class="d-block" style="width:100%">
          <div class="carousel-content" style="text-align:right">
            <span class="caption-3">VISIT <br/> BANDUNG</span>
          </div>
        </div>
      </div>

      <a href="{{route('search')}}" type="button" name="button" class="btn banner-btn">FIND MORE</a>
    </div>
  </div>

<div class="container">

</div>
<div style="height:500vh"></div>
<div class="content-parallax">
    <!-- ================================================== CONTENT 3 =============================================================== -->
  <div class="container-content-3">
      <div class="text-center">
        <h1 class="content-caption-3"data-aos="fade-down" data-aos-offset="100">DISCOVER OUR COLLECTION</h1>
      </div>
      <div class="container">
        <div class="row content-3">
          @foreach(array_slice($destinationTypes->data,0, 4) as $destinationType)
          <div class="col-md-3 scroll-element" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="{{200*($loop->index+1)}}" data-aos-duration="1000" data-aos-offset="100">
            <div class="card text-white text-center">
              <img src="{{asset('img/'.$destinationType->name.'.jpg')}}" class="card-img" alt="...">
              <div class="card-img-overlay d-flex align-items-center">
                <div class="row w-100">
                  <div class="col-md-12 text-center">
                    <h2 class="card-title" align="center">{{$destinationType->name}}</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>

    <!-- ============================================= CONTENT 1 =============================================================== -->
    <div style="background:url({{asset('img/dapiki-moto-RAL3lZU3j0E-unsplash.jpg')}}); background-attachment:fixed; background-size:cover; z-index:-100;" >
      <div style="background: rgba(54, 54, 54, 0.75); background-size:cover;position:relative;overflow:hidden">
        <div class="container content-1">
          <div class="row d-flex align-content-center">
          <div class="col-md-4" data-aos="fade-right" data-aos-offset="500">
            <span class="content-caption-1 text-white">Exploring the City of Bandung and Beyond</span>
          </div>
          <div class="col-md-7 offset-md-1 align-self-center" style="height:100%"  data-aos="fade-up" data-aos-offset="500">
            <div class="content-carousel">
              @foreach($destinations->data as $destination)
              <div class="card">
                <img src="{{asset('img/destination/'.$destination->image_name)}}" class="card-img-top" alt="..." style="height: 156px;">
                <div class="card-body" style="height:150px">
                  <h5 class="card-title">{{$destination->name}}</h5>
                  <p class="card-text">{{Str::limit($destination->description, 50)}}</p>
                </div>
                <div class="card-footer">
                  <i class="bi bi-eye"></i>&nbsp;<span>{{$destination->view}}</span>
                  <div class="float-end">
                    {{-- <button type="button" name="button" id="btn-save" class="btn btn-success" data-id="{{$destination->id}}">Lihat</button> --}}
                    <!-- <button type="button" name="button" id="btn-save" class="btn btn-success" data-id="{{$destination->id}}">Simpan</button> -->
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="row">
              <div class="col-md-12">
                <a href="{{route('search')}}" type="button" name="button" class="btn btn-outline-light btn-rounded mt-5" style="float:right; width:100%; padding: 10px 50px;">Find More</a>
              </div>
            </div>
          </div>
        </div>
        <div class="container content-2 mt-5">
          <div class="row d-flex align-content-center">
            <div class="col-md-8 align-self-center" data-aos="fade-up" data-aos-offset="500">
              <div class="content-carousel">
                @foreach($hotels->data as $hotel)
                <div class="card">
                  <img src="{{asset('img/destination/'.$hotel->image_name)}}" class="card-img-top" alt="..." style="height: 156px;">
                  <div class="card-body" style="height:150px">
                    <h5 class="card-title">{{$hotel->name}}</h5>
                    <p class="card-text">{{Str::limit($hotel->description, 50)}}</p>
                  </div>
                  <div class="card-footer">
                    <i class="bi bi-eye"></i>&nbsp;<span>{{$hotel->view}}</span>
                    <div class="float-end">
                      {{-- <button type="button" name="button" class="btn btn-success" data-id="{{$destination->id}}">Lihat</button> --}}
                      <!-- <button type="button" name="button" class="btn btn-success" data-id="{{$destination->id}}">Simpan</button> -->
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="row">
                <div class="col-md-12">
                  <a href="{{route('search')}}" type="button" name="button" class="btn btn-outline-light btn-rounded mt-5" style="float:right; width:100%; padding: 10px 50px;">Find More</a>
                </div>
              </div>
            </div>
            <div class="col-md-3 offset-md-1" data-aos="fade-right" data-aos-offset="500">
              <span class="content-caption-1 text-white">Dream the Night Away</span>
            </div>
          </div>

        </div>
      </div>
      </div>
      <!-- ====================================================== CONTENT 2 ================================================================= -->
    </div>

    <!-- =============================================== GET THE APP =============================================================== -->
    <div class="w-100 mt-5 p-5" style="min-height:200px">
      <div class="container">
          <div class="row d-flex align-content-center">
          <div class="offset-md-2 col-md-3 d-flex align-content-center ">
            <img src="{{asset('img/pngwing.com.png')}}" alt="" width="350">
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <div class="container">
              <!-- <h1>Get the APP Today</h1> -->
              <h1>Coming Soon in Playstore</h1>
              <h1>Bandung Travel Recommendation</h1>
              <p>Unduh aplikasi dari</p>
              <img src="{{asset('img/playstore_icon.png')}}" alt="" width="300">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- =============================================== OUR TEAM =============================================================== -->
    <div class="container" style="margin-bottom:100px; margin-top:100px">
      <div class="row text-center mb-5">
        <h1 class="white">Meet Our team</h1>
      </div><br />

      <div class="row">

        <div class="col-md-3 col-sm-6">
          <div class="card team-card text-center">
            <div class="team-img-container">
              <img class="card-img-top team-img" src="{{asset('img/1-min.jpg')}}" alt="Card image">
            </div>
            <div class="card-body">
              <h4 class="card-title">Moch. Nuval Rizaldi</h4>
              <p class="card-text">1301194482</p>
              <a href="https://github.com/Muvazana" class="btn btn-primary team-social-media"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/moch-nauval-rizaldi-nasril-681924195/" class="btn btn-primary team-social-media"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card team-card text-center">
            <div class="team-img-container">
              <img class="card-img-top team-img" src="{{asset('img/1-min.jpg')}}" alt="Card image">
            </div>
            <div class="card-body">
              <h4 class="card-title">Arga Melvern</h4>
              <p class="card-text">1301194055</p>
              <a href="https://github.com/ArgaMelvern" class="btn btn-primary team-social-media"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/argamelvern/" class="btn btn-primary team-social-media"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card team-card text-center">
            <div class="team-img-container">
              <img class="card-img-top team-img" src="{{asset('img/1-min.jpg')}}" alt="Card image">
            </div>
            <div class="card-body">
              <h4 class="card-title">Mohammad Akbar Fauzy</h4>
              <p class="card-text">1301194133</p>
              <a href="https://github.com/AkbarFauzy" class="btn btn-primary team-social-media"><i class="bi bi-github"></i></a>
              <a href="#https://linkedin.com/in/akbarfauzy/" class="btn btn-primary team-social-media"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="card team-card text-center">
            <div class="team-img-container">
              <img class="card-img-top team-img" src="{{asset('img/1-min.jpg')}}" alt="Card image">
            </div>
            <div class="card-body">
              <h4 class="card-title">Jane Raihan</h4>
              <p class="card-text">1301194240</p>
              <a href="https://github.com/janerhn" class="btn btn-primary team-social-media"><i class="bi bi-github"></i></a>
              <a href="https://www.linkedin.com/in/jane-raihan-3b7b301bb/" class="btn btn-primary team-social-media"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>


      </div>
    </div>

  </div>
@endsection

@section('assets_js')
  <script src="{{asset('js/landing-page.js')}}"></script>
  <script src="{{asset('js/animation.js')}}"></script>
@endsection
