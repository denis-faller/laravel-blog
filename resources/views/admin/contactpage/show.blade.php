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
            <form action = "{{route('admin.contactpage.update', $contactPage->id)}}" method = "POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="title_text">Вверхний текст</label>
                        <textarea name = "title_text" class="textarea">{{$contactPage->title_text}}</textarea>
                    </div>  
                    <div class="form-group">     
                        <label for="title_img">Картинка из верхнего текста</label>
                        <img class="form-control img-blog" src = "{{$contactPage->title_img}}" />
                        <input class="form-control" name = "title_img" type="file">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <input class="form-control" name = "address" type = "text" value = "{{$contactPage->address}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input class="form-control" name = "phone" type = "text" value = "{{$contactPage->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name = "email" type = "email" value = "{{$contactPage->email}}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
        </div>
    </div>
@endsection