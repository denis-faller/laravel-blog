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
            <form action = "{{route('admin.aboutpage.update', $aboutPage->id)}}" method = "POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="title_text">Вверхний текст</label>
                        <textarea name = "title_text" class="textarea">{{$aboutPage->title_text}}</textarea>
                    </div>  
                    <div class="form-group">     
                        <label for="title_img">Картинка из верхнего текста</label>
                        <img class="form-control img-blog" src = "{{$aboutPage->title_img}}" />
                        <input class="form-control" name = "title_img" type="file">
                    </div>
                    <div class="form-group">     
                        <label for="after_title_text">Текст после верхнего</label>
                        <textarea name = "after_title_text" class="textarea">{{$aboutPage->after_title_text}}</textarea>
                    </div>
                    <div class="form-group">     
                        <label for="after_title_img">Картинка из текста после верхнего</label>
                        <img class="form-control img-blog" src = "{{$aboutPage->after_title_img}}" />
                        <input class="form-control" name = "after_title_img" type="file">
                    </div>
                    <div class="form-group">     
                        <label for="team_title_text">Текст о команде</label>
                        <textarea name = "team_title_text" class="textarea">{{$aboutPage->team_title_text}}</textarea>
                    </div>
                    <div class="form-group">     
                        <label for="after_team_text">Текст после блока команда</label>
                        <textarea name = "after_team_text" class="textarea">{{$aboutPage->after_team_text}}</textarea>
                    </div>
                    <div class="form-group">     
                        <label for="after_team_img">Картинка после блока команда</label>
                        <img class="form-control img-blog" src = "{{$aboutPage->after_team_img}}" />
                        <input class="form-control" name = "after_team_img" type="file">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
        </div>
    </div>
@endsection