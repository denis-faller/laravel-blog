@extends('layouts.app')

@section('content')
    <div class="site-section bg-light">
      <div class="container">
        <div class="row align-items-stretch retro-layout-2">
          @if(isset($postsForMainPage[0][0]))
          <?php $cnt = 0?> 
          @foreach($postsForMainPage[0] as $item)
          @if($cnt == 0 || $cnt == 2 || $cnt == 3)
          <div class="col-md-4">
          @endif
            <a href="{{route('post.show', $item->url)}}" class="h-entry @if($cnt == 2)  img-5 h-100 @else @if($cnt == 0 || $cnt == 3) mb-30 @endif v-height @endif gradient" style="background-image: url('{{$item->preview_img}}');">
              
              <div class="text">
                <div class="post-categories mb-3">
                  @foreach($item->tags as $tag)
                  <span class="post-category" style = "background-color:{{$tag->color}}">{{$tag->name}}</span>
                  @endforeach
                </div> 
                <h2>{{$item->name}}</h2>
                <span class="date">{{date('M d, Y', strtotime($item->publish_time))}}</span>
              </div>
            </a>
          @if($cnt == 1 || $cnt == 2 || $cnt == (count($postsForMainPage[0])-1))
          </div>
          @endif
          <?php $cnt++;?>
          @endforeach
          @endif
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12">
            <h2>Recent Posts</h2>
          </div>
        </div>
        <div class="row">
            @if(isset($paginatePosts[0]))
            @foreach($paginatePosts as $post)
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

    <div class="site-section bg-light">
      <div class="container">

        <div class="row align-items-stretch retro-layout">
          @if(isset($postsForMainPage[1][0]))
          <?php $cnt = 0?> 
          @foreach($postsForMainPage[1] as $item)
          @if($cnt == 0)
          <div class="col-md-5 order-md-2">
          @elseif($cnt == 1)
          <div class="col-md-7">
          @endif
          @if($cnt == 2)
          <div class="two-col d-block d-md-flex">
          @endif
            <a href="{{route('post.show', $item->url)}}" class="hentry @if($cnt == 0) img-1 @else ($cnt == 1) img-2  @endif v-height @if($cnt == 0) h-100 @elseif($cnt == 1) mb30  @endif gradient @if($cnt == 3)  ml-auto @endif" style="background-image: url('{{$item->preview_img}}');">
            @foreach($item->tags as $tag)
            <span class="post-category text-white" style = "background-color:{{$tag->color}}">{{$tag->name}}</span>
            @endforeach
              <div class="text">
                <h2>{{$item->name}}</h2>
                <span>{{date('M d, Y', strtotime($item->publish_time))}}</span>
              </div>
            </a>
          @if($cnt == 0)
          </div>
          @elseif($cnt == (count($postsForMainPage[1])-1))
          </div></div>
          @endif
          <?php $cnt++;?>
          @endforeach
          @endif
        </div>
      </div>
    </div>


    @include('subscriber')
@endsection
