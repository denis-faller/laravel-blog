@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Нижнее меню сайта</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Название пункта меню</th>
      <th scope="col">Урл</th>
      <th scope="col">Значение сортировки</th>
    </tr>
  </thead>
  <tbody>
      @foreach($itemsMenu as $item)
    <tr>
      <td><a href = "{{route('admin.footer.menu.show', $item->id)}}">{{$item->id}}</a></td>
      <td>{{$item->name}}</td>
      <td>{{$item->url}}</td>
      <td>{{$item->sort}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.footer.menu.create')}}'">Создать новый пункт меню</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateFooterMenu[0]))
                {{ $paginateFooterMenu->links('admin.footer.menu.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection