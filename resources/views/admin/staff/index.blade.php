@extends('layouts.admin')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Сотрудники</span>
          </div>
        </div>
      </div>
    </div>


 <div class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Фио</th>
      <th scope="col">Описание</th>
    </tr>
  </thead>
  <tbody>
      @foreach($staff as $employee)
    <tr>
      <td><a href = "{{route('admin.staff.show', $employee->id)}}">{{$employee->id}}</a></td>
      <td>{{$employee->name}}</td>
      <td>{{substr($employee->description, 0, 100)}}...</td>
    </tr>
    @endforeach
  </tbody>
</table>
<button  class="btn btn-primary" onclick = "window.location.href = '{{route('admin.staff.create')}}'">Создать нового сотрудника</button>
  </div>
    <div class="site-section bg-white">
      <div class="container">
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginateStaff[0]))
                {{ $paginateStaff->links('admin.staff.paginator') }}
                @endif
            </div>
          </div>
      </div>
     </div>
    </div>
@endsection