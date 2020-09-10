@extends('layouts.app')

@section('content')
<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{$aboutPage->title_img}}');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              {!!$aboutPage->title_text!!}
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6 order-md-2">
            <img src="{{$aboutPage->after_title_img}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-5 mr-auto order-md-1">
            {!!$aboutPage->after_title_text!!}
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-5 text-center">
            {!!$aboutPage->team_title_text!!}
          </div>
        </div>
        <div class="row">
            @foreach($staff as $employee)
          <div class="col-md-6 col-lg-4 mb-5 text-center">
            <img src="{{$employee->img}}" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
            <h2 class="mb-3 h5">{{$employee->name}}</h2>
            <p>{{$employee->description}}</p>

            <p class="mt-5">
              <a href="{{$employee->facebook == ""?'#':$employee->facebook}}" class="p-3"><span class="icon-facebook"></span></a>
              <a href="{{$employee->instagram == ""?'#':$employee->instagram}}" class="p-3"><span class="icon-instagram"></span></a>
              <a href="{{$employee->twitter == ""?'#':$employee->twitter}}" class="p-3"><span class="icon-twitter"></span></a>
            </p>
          </div>
            @endforeach
        </div>
      </div>
    </div>
    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="{{$aboutPage->after_team_img}}" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-5 ml-auto">
            {!!$aboutPage->after_team_text!!}
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="site-section bg-white">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <div class="subscribe-1 ">
              <h2>Subscribe to our newsletter</h2>
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
               @include('common.errors')
              <form action="{{route('subscriber.store')}}" method ="POST" class="d-flex">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name = "email" type="email" class="form-control" placeholder="Enter your email address">
                <input type="submit" class="btn btn-primary" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection