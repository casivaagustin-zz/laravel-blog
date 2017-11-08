<div class="card mb-3">
  <div class="card-body">
    <h3 class="card-title mb-1">
      <a href="{{ route('post.show', [$post->id]) }}">
        {{ $post->title }}
      </a>
    </h3>
    <div class="body mb-1">
      {{ Str::words($post->body, 20, '...') }}
    </div>
    <div class="date mb-1">
      <strong>Fecha:</strong> {{ $post->created_at }}
    </div>
    <div class="footer">
      <span class="section">
        <span class="label"><strong>Seccion:</strong></span>
        <a href="{{ route('section.show', [$post->section()->id]) }}" class="card-link">
          {{ $post->section()->section }}
        </a>
      </span>
      <span class="tags">
        <span class="label"><strong>Tags:</strong></span>
        @foreach ($post->tags() as $tags)
          <a href="{{ route('tag.show', [$tags->id]) }}" class="card-link">
            {{ $tags->tag }}
          </a>
        @endforeach
      </span>
    </div>
  </div>
</div>
