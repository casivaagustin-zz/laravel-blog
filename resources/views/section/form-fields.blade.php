<div class="form-group">
  <label for="title">Section:</label>
  <input type="text" name="section" class="form-control" @if (!empty($section)) value="{{ $section->section }}" @endif/>
</div>