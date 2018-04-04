@if($activity->answers->where('user_id', Auth::user()->id)->count() > 0)
@else
<form method="POST" action="{{ url('/g/'.$activity->course->grade->slug.'/c/'.$activity->course->slug.'/activity/'.$activity->slug.'/answer') }}">
  {{ csrf_field() }}
  <div class="form-group">
      <label for="attached">Adjuntar Archivo</label>
      <input type="text" class="form-control ckfile" id="attached" name="attached" readonly placeholder="/picture/of/this/content" value="{{ old('attached') ? old('attached') : '' }}">
  </div>
  <div class="form-group">
    <textarea name="fullcontent" id="fullcontent" class="form-control">{{ old('fullcontent') ? old('fullcontent') : '' }}</textarea>
    <script type="text/javascript">
        var editor = CKEDITOR.replace('fullcontent');
    </script>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-primary btn-sm">Enviar respuesta</button>
  </div>
</form>
@endif
