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
            <form action = "{{route('admin.mailings.update', $mailing->id)}}" method = "POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="posts">Пост для рассылки</label>
                    <select class="form-control posts"  name="posts[]" size="5">
                        @foreach($posts as $post)
                        <option @if($mailing->post_id == $post->id) selected @endif value="{{$post->id}}">{{$post->name}}</option>
                        @endforeach
                   </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
                <div class = "button-delete">
                    <form action = "{{route('admin.mailings.destroy', $mailing->id)}}" method = "POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </div>
        </div>
    </div>
@endsection