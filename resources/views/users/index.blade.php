@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Все пользователи сайта</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Роль</th>
      <th scope="col">Имя</th>
      <th scope="col">Описание</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
      @foreach($users as $user)
    <tr>
      <td><a href = "{{route('users.show', $user->id)}}">{{$user->id}}</a></td>
      <td>
        @foreach($user->roles as $role)
            {{$role->name}}
        @endforeach
      </td>
      <td>{{$user->name}}</td>
      <td>{{$user->description}}</td>
      <td>{{$user->email}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateUsers[0]))
                {{ $paginateUsers->links('users.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection