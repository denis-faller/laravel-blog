@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Рассылки</span>
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
      <th scope="col">Время отправки</th>
    </tr>
  </thead>
  <tbody>
      @foreach($mailings as $mailing)
    <tr>
      <td><a href = "{{route('admin.mailings.show', $mailing->id)}}">{{$mailing->id}}</a></td>
      <td>{{$mailing->post->name}}</td>
      <td>{{$mailing->send_time}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.mailings.create')}}'">Создать новую рассылку</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateMailings[0]))
                {{ $paginateMailings->links('admin.mailings.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection