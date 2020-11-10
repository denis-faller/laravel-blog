@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Все теги сайта</span>
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
      <th scope="col">Цвет</th>
    </tr>
  </thead>
  <tbody>
      @foreach($tags as $tag)
    <tr>
      <td><a href = "{{route('admin.tags.show', $tag->id)}}">{{$tag->id}}</a></td>
      <td>{{$tag->name}}</td>
      <td>{{$tag->url}}</td>
      <td>{{$tag->color}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.tags.create')}}'">Создать новый тег</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateTags[0]))
                {{ $paginateTags->links('admin.tags.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection