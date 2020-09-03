<?php use Blog\Http\Controllers\PostController; ?>
@extends('layouts.app')

@section('content')
   <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{$post->img}}');">
      <div class="container">
        <div class="row same-height justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="post-entry text-center">
              @foreach($post->tags as $tag)      
              <span class="post-category text-white mb-3" style = "background-color:{{$tag->color}}">{{$tag->name}}</span>
              @endforeach
              <h1 class="mb-4"><a href="#">{{$post->name}}</a></h1>
              <div class="post-meta align-items-center text-center">
                <figure class="author-figure mb-0 mr-3 d-inline-block"><img src="{{$post->author->img}}" alt="Image" class="img-fluid"></figure>
                <span class="d-inline-block mt-1">By {{$post->author->name}}</span>
                <span>&nbsp;-&nbsp; {{date('M d, Y', strtotime($post->publish_time))}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="post-content-body">
            {!!$post->text!!} 
            </div>

            
            <div class="pt-5">
              <p>Categories:  
                  <a href="{{route("category.show", $post->categories->url)}}">{{$post->categories->name}}</a>, 
                  Tags: 
                  @foreach($post->tags as $tag)
                  @if($loop->last)
                  <a href="{{route("tags.show", $tag->url)}}">#{{$tag->name}}</a>
                  @else
                  <a href="{{route("tags.show", $tag->url)}}">#{{$tag->name}}</a>,
                  @endif
                  @endforeach
              </p>
            </div>
              
              


            <div class="pt-5">
              <h3 class="mb-5">{{$countComments}} Comments</h3>
              <ul class="comment-list">
                @if(isset($commentsAr[0]))
                    @foreach($commentsAr[0] as $comment)
                        <li class="comment">
                          <div class="vcard">
                            @if(isset($comment->author))
                                <img src="{{$comment->author->img}}" alt="{{$comment->author->name}}">
                            @endif
                          </div>
                          <div class="comment-body">
                            @if(isset($comment->author)) 
                                <h3>{{$comment->author->name}}</h3>
                            @else
                                <h3>{{$comment->name}}</h3>
                            @endif
                            <div class="meta">{{date('M d, Y at H:i', strtotime($comment->created_at))}}</div>
                            <p>{{$comment->message}}</p>
                            <p><a href="#" class="reply rounded">Reply</a></p>
                          </div>
                        </li>
                        <?php PostController::nestedComment($comment->id, $commentsAr); ?> 
                    @endforeach
                @endif
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="#" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
            <div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="{{$post->author->img}}" alt="{{$post->author->name}}" class="img-fluid mb-5">
                <div class="bio-body">
                  <h2>{{$post->author->name}}</h2>
                  <p class="mb-4">{{$post->author->description}}</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded px-4 py-2">Read my bio</a></p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Popular Posts</h3>
              <div class="post-entry-sidebar">
                <ul>
                    @foreach($popularPosts as $popularPost)
                    <li>
                        <a href="{{route("post.show", $popularPost->url)}}">
                          <img src="{{$popularPost->preview_img}}" alt="{{$popularPost->name}}" class="mr-4">
                          <div class="text">
                            <h4>{{$popularPost->name}}</h4>
                            <div class="post-meta">
                              <span class="mr-2">{{date('M d, Y', strtotime($popularPost->publish_time))}}</span>
                            </div>
                          </div>
                        </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Categories</h3>
              <ul class="categories">
                @foreach($categories as $category)
                <li><a href="{{route('category.show', $category->url)}}">{{$category->name}} <span>({{$category->total}})</span></a></li>
                @endforeach
              </ul>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Tags</h3>
              <ul class="tags">
                @foreach($tags as $tag)
                <li><a href="{{route('tags.show', $tag->url)}}">{{$tag->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <div class="site-section bg-light">
      <div class="container">

        <div class="row mb-5">
          <div class="col-12">
            <h2>More Related Posts</h2>
          </div>
        </div>

        <div class="row align-items-stretch retro-layout">
          @if(isset($relatedPosts[0]))
          <?php $cnt = 0?> 
          @foreach($relatedPosts as $item)
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
          @elseif($cnt == (count($relatedPosts)-1))
          </div></div>
          @endif
          <?php $cnt++;?>
          @endforeach
          @endif
        </div>

      </div>
    </div>


    <div class="site-section bg-lightx">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-md-5">
            <div class="subscribe-1 ">
              <h2>Subscribe to our newsletter</h2>
              <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
              <form action="#" class="d-flex">
                <input type="text" class="form-control" placeholder="Enter your email address">
                <input type="submit" class="btn btn-primary" value="Subscribe">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
