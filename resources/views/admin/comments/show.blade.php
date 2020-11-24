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
            <form action = "{{route('admin.comments.update', $comment->id)}}" method = "POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <div class="form-group">
                    <label for="posts">Пост к которому относиться комментарий</label>
                    <select class="form-control post-comment-update"  name="posts[]" size="5">
                        @foreach($posts as $post)
                        <option @if($post->id == $comment->post_id) selected @endif value="{{$post->id}}">{{$post->name}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <label for="parent_comments">Родительский комментарий</label>
                    <select class="form-control parent-comment"  name="parent_comments[]" size="10">
                        @foreach($commentsOnPost as $commentOnPost)
                        <option @if($commentOnPost->id == $comment->parent_id) selected @endif value="{{$commentOnPost->id}}">{{$commentOnPost->message}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">     
                    <label for="message">Текст комментария</label>
                    <textarea class="form-control" name = "message">{{$comment->message}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
            <div class = "button-delete">
                <form action = "{{route('admin.comments.destroy', $comment->id)}}" method = "POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
        </div>
  </div>
@endsection