@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Все посты сайта</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Название</th>
      <th scope="col">Урл</th>
      <th scope="col">Время публикации</th>
    </tr>
  </thead>
  <tbody>
      @foreach($posts as $post)
    <tr>
      <td><a href = "{{route('admin.posts.show', $post->id)}}">{{$post->id}}</a></td>
      <td>{{$post->name}}</td>
      <td>{{$post->url}}</td>
      <td>{{$post->publish_time}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.posts.create')}}'">Создать новый пост</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginatePosts[0]))
                {{ $paginatePosts->links('admin.posts.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection