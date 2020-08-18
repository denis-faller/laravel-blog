@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Tag</span>
            <h3>{{$tag->name}}</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-white">
      <div class="container">
        <div class="row">
          @if(isset($posts[0])) 
            @foreach($posts as $post)
              @include('posts.preview')
            @endforeach
          @endif
        </div>
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginatePosts[0]))
                {{ $paginatePosts->links('posts.paginator') }}
                @endif
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
