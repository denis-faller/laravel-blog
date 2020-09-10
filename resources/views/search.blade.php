@extends('layouts.app')

@section('content')
    <div class="py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <span>Страница поиска по запросу "{{$query}}"</span>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="site-section bg-white">
      <div class="container">
          @if(isset($posts[0])) 
            @foreach($posts as $post)
              <div class="row"><a href = "{{$post->url}}">{{$post->name}}</a></div>
            @endforeach
          @else
                <p>Посты не найдены</p>
          @endif
        <div class="row text-center pt-5 border-top">
          <div class="col-md-12">
            <div class="custom-pagination">
                @if(isset($paginatePosts[0]))
                {{ $paginatePosts->appends(request()->query())->links('posts.paginator') }}
                @endif
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection