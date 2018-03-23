<form method="POST" action="{{ url('/g/'.$course->grade->slug.'/c/'.$course->slug.'/post') }}">
  {{ csrf_field() }}
  <div class="form-group">
      <textarea type="text" name="name" id="name" class="form-control" placeholder="Escribe tu mensaje de entre 30 y 250 caracteres..." required></textarea>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-primary btn-sm">Publicar</button>
  </div>
</form>
