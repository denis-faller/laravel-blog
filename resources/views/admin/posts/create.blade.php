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
            <form action = "{{route('admin.posts.store')}}" method = "POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Категория поста</label>
                    <select class="form-control"  name="categories[]" size="3">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <label for="name">Теги поста</label>
                    <select class="form-control"  name="tags[]" size="3" multiple>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                   </select>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="main_page" value="1"> Главная страница
                </div>    
                <div class="form-group">
                    <label for="name">Название</label>
                    <input class="form-control" name = "name" type = "text">
                </div>
                <div class="form-group">     
                    <label for="url">Урл</label>
                     <input class="form-control" name = "url" type = "text">
                </div>
                <div class="form-group">     
                    <label for="preview">Превью</label>
                    <input class="form-control" name = "preview" type="file">
                </div>
                <div class="form-group">     
                    <label for="image">Заглавное изображение</label>
                    <input class="form-control" name = "image" type="file">
                </div>
                <div class="form-group">     
                    <label for="text">Текст поста</label>
                    <textarea name = "text" id="textarea"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
        </div>
  </div>
@endsection