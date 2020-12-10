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
            <form action = "{{route('admin.social.link.update', $socialLink->id)}}" method = "POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Название соц. сети</label>
                    <input class="form-control" name = "name" type = "text" value = "{{$socialLink->name}}">
                </div>  
                <div class="form-group">
                    <label for="href">Ссылка</label>
                    <input class="form-control" name = "href" type = "text" value = "{{$socialLink->href}}">
                </div>
                <div class="form-group">
                    <label for="sort">Сортировка</label>
                    <input class="form-control" name = "sort" type = "text" value = "{{$socialLink->sort}}">
                </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
                <div class = "button-delete">
                    <form action = "{{route('admin.social.link.destroy', $socialLink->id)}}" method = "POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </div>
        </div>
    </div>
@endsection