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
            <form action = "{{route('admin.subscribers.update', $subscriber->id)}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name = "email" type = "text" value = "{{$subscriber->email}}">
                </div>  
                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
                <div class = "button-delete">
                    <form action = "{{route('admin.subscribers.destroy', $subscriber->id)}}" method = "POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </div>
        </div>
    </div>
@endsection