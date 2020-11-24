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
            <form action = "{{route('admin.comments.store')}}" method = "POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="posts">Пост к которому относиться комментарий</label>
                    <select class="form-control post-comment"  name="posts[]" size="5">
                        @foreach($posts as $post)
                        <option value="{{$post->id}}">{{$post->name}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <label for="parent_comments">Родительский комментарий</label>
                    <select class="form-control parent-comment"  name="parent_comments[]" size="10">
                   </select>
                </div>
                <div class="form-group">     
                    <label for="message">Текст комментария</label>
                    <textarea class="form-control" name = "message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection