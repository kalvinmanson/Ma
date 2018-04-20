
<form method="POST" action="{{ url('/g/'.$topic->course->grade->slug.'/c/'.$topic->course->slug.'/forum/'.$topic->slug.'/reply') }}">
  {{ csrf_field() }}
  <div class="form-group">
    <textarea name="fullcontent" id="fullcontent" class="form-control">{{ old('fullcontent') ? old('fullcontent') : '' }}</textarea>
    <script type="text/javascript">
      var editor = CKEDITOR.replace('fullcontent', {
        toolbarGroups: [
          '/',																// Line break - next group will be placed in new line.
          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
          { name: 'links' },
          { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
          { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
          { name: 'insert' }
        ]
      });
    </script>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-primary btn-sm">Enviar respuesta</button>
  </div>
</form>
