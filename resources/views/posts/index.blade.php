<div class="posts">
  @foreach ($posts as $post)
    <div class="post">
      <h2 class="title">
        <a href="/post/{{ $post->id }}">
          {{ $post->title }}
        </a>
      </h2>
    </div>
  @endforeach
</div>