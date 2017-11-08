<div class="form-group">
  <label for="title">Tag:</label>
  <input type="text" name="tag" class="form-control" @if (!empty($tag)) value="{{ $tag->tag }}" @endif/>
</div>