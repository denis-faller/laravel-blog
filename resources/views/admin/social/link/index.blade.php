@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Социальные ссылки</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Название соц. сети</th>
      <th scope="col">Ссылка</th>
      <th scope="col">Значение сортировки</th>
    </tr>
  </thead>
  <tbody>
      @foreach($itemsLinks as $link)
    <tr>
      <td><a href = "{{route('admin.social.link.show', $link->id)}}">{{$link->id}}</a></td>
      <td>{{$link->name}}</td>
      <td>{{$link->href}}</td>
      <td>{{$link->sort}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.social.link.create')}}'">Создать новую социальную ссылку</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateSocialLink[0]))
                {{ $paginateSocialLink->links('admin.social.link.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection