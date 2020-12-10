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
            <form action = "{{route('admin.social.link.store')}}" method = "POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Название соц. сети</label>
                    <input class="form-control" name = "name" type = "text">
                </div>
                <div class="form-group">     
                    <label for="href">Ссылка</label>
                     <input class="form-control" name = "href" type = "text">
                </div>
                <div class="form-group">
                    <label for="sort">Значение сортировки</label>
                    <input class="form-control" name = "sort" type = "text">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection