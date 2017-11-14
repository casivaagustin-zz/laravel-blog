@include('posts.input', ['field' => 'title', 'label' => 'Titulo', 'msg' => 'Requerido', 'errors' => $errors])
<div class="form-group">
  <label for="body">Cuerpo:</label>
  <textarea name="body" class="form-control @if($errors->get('body')) is-invalid @endif" >@if (!empty($post))){{ $post->body }} @elseif (!empty(old('body'))) {{ old('body') }} @endif </textarea>
  @if($errors->get('body'))
    <div class="invalid-feedback">
        Required.
    </div>
  @endif
</div>

<div class="form-group">
  <label for="section">Sección:</label>
  <select name="section" class="form-control @if($errors->get('section')) is-invalid @endif" >
    <option value=""></option>
    @foreach($sections as $section)
      <option value="{{ $section->id }}" @if ((!empty($post) && $section->id == $post->section_id) || (!empty(old('section')) && old('section') == $section->id)) selected="selected" @endif>
        {{ $section->section }}
      </option>
    @endforeach
  </select>
  @if($errors->get('section'))
    <div class="invalid-feedback">
        Required.
    </div>
  @endif
</div>

<div class="form-group">
  <div>Tags:</div>
  @foreach($tags as $tag)
    <label>
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="@if($errors->get('tags')) is-invalid @endif"
                  @if ((!empty($post) && $post->usesTag($tag)) || (!empty(old('tags')) && in_array($tag->id, old('tags')))) checked="checked" @endif>
        {{ $tag->tag }}
    </label>
  @endforeach
</div>