@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Все категории сайта</span>
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
      <th scope="col">Описание</th>
    </tr>
  </thead>
  <tbody>
      @foreach($categories as $category)
    <tr>
      <td><a href = "{{route('category.admin.show', $category->id)}}">{{$category->id}}</a></td>
      <td>{{$category->name}}</td>
      <td>{{$category->url}}</td>
      <td>{{$category->description}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('category.create')}}'">Создать новую категорию</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateCategories[0]))
                {{ $paginateCategories->links('categories.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection