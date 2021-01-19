@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>{{$title}}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-white">
        <div class="container">
            @include('common.errors')
            <form action = "{{route('admin.site.update', $site->id)}}" method = "POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Название сайта</label>
                        <input class="form-control" name = "name" type = "text" value = "{{$site->name}}">
                    </div>
                    <div class="form-group">
                        <label for="footer_text">Нижний текст</label>
                        <input class="form-control" name = "footer_text" type = "text" value = "{{$site->footer_text}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
        </div>
    </div>
@endsection