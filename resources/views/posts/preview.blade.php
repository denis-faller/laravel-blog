<div class="col-lg-4 mb-4">
    <div class="entry2">
      <a href="/{{$post->categories->url}}/{{$post->url}}"><img src="{{$post->preview_img}}" alt="Image" class="img-fluid rounded"></a>
      <div class="excerpt">
      @foreach($post->tags as $tag)    
      <span class="post-category text-white mb-3" style = "background-color:{{$tag->color}}">{{$tag->name}}</span>
      @endforeach
      <h2><a href="/{{$post->categories->url}}/{{$post->url}}">{{$post->name}}</a></h2>
      <div class="post-meta align-items-center text-left clearfix">
        <figure class="author-figure mb-0 mr-3 float-left"><img src="{{$post->author->img}}" alt="Image" class="img-fluid"></figure>
        <span class="d-inline-block mt-1">By <a href="/users/{{$post->author->name}}">{{$post->author->name}}</a></span>
        <span>&nbsp;-&nbsp; {{date('M d, Y', strtotime($post->publish_time))}}</span>
      </div>

        <p>{{substr(strip_tags($post->text), 0, 100)}} ...</p>
        <p><a href="/{{$post->categories->url}}/{{$post->url}}">Read More</a></p>
      </div>
    </div>
</div>