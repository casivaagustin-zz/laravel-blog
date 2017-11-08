<div class="form-group">
  <label for="title">Titulo:</label>
  <input type="text" name="title" class="form-control" @if (!empty($post)) value="{{ $post->title }}" @endif/>
</div>

<div class="form-group">
  <label for="body">Cuerpo:</label>
  <textarea name="body" class="form-control" >@if (!empty($post)){{ $post->body }} @endif</textarea>
</div>

<div class="form-group">
  <label for="section">Sección:</label>
  <select name="section" class="form-control" >
    <option value=""></option>
    @foreach($sections as $section)
      <option value="{{ $section->id }}" @if (!empty($post) && $section->id == $post->section_id) selected="selected" @endif>
        {{ $section->section }}
      </option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <div>Tags:</div>
  @foreach($tags as $tag)
    <label>
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                  @if (!empty($post) && $post->usesTag($tag)) checked="checked" @endif>
        {{ $tag->tag }}
    </label>
  @endforeach
</div>