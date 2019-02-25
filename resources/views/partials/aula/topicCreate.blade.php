<button type="button" class="btn btn-primary btn-sm btn-raised float-right" data-toggle="modal" data-target="#topicCreate">
  <i class="fa fa-plus"></i> Nuevo tema
</button>
@section('modal')
  <div class="modal fade" id="topicCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo tema al foro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/forum') }}">
          <div class="modal-body">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="name">Titulo</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Escribe el titulo de tu duda o comentario" value="{{ old('name') ? old('name') : '' }}">
            </div>
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

            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="content_id" value="{{ $content_id or 0 }}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Publicar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
