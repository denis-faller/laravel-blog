@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Подписчики</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
      @foreach($subscribers as $subscriber)
    <tr>
      <td><a href = "{{route('admin.subscribers.show', $subscriber->id)}}">{{$subscriber->id}}</a></td>
      <td>{{$subscriber->email}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.subscribers.create')}}'">Создать нового подписчика</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateSubscribers[0]))
                {{ $paginateSubscribers->links('admin.subscribers.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection