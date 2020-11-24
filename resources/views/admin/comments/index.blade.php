@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Все комментарии сайта</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Id поста</th>
      <th scope="col">Сообщение</th>
    </tr>
  </thead>
  <tbody>
      @foreach($comments as $comment)
    <tr>
      <td><a href = "{{route('admin.comments.show', $comment->id)}}">{{$comment->id}}</a></td>
      <td>{{$comment->post_id}}</td>
      <td>{{substr($comment->message, 0, 100)}}...</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.comments.create')}}'">Создать новый комментарий</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateComments[0]))
                {{ $paginateComments->links('admin.comments.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection