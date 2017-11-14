<div class="form-group">
  <label for="title">{{ $label }}:</label>
  <input type="text" name=" title" class="form-control @if($errors->get($field)) is-invalid @endif" value="@if (!empty($post)) {{ $post->title }} @elseif (!empty(old($field))) {{ old($field) }} @endif" />
    @if($errors->get($field))
    <div class="invalid-feedback">
       {{ empty($msg) ? '' : $msg }}
    </div>
    @endif
</div>