<table class="table table-striped">
  <tr>
    <th>Estudiante</th>
    <th>Respuesta</th>
    <th>Fecha</th>
    <th>Calificarción</th>
  <tr>
@foreach($activity->answers as $answer)
  <tr>
    <td>
      {{ $answer->user->name }}<br>
      <small>{{ $answer->user->email }}</small>
    </td>
    <td>
      <a href="#answer_{{ $answer->id }}" data-fancybox>Ver respuesta</a>
      <div id="answer_{{ $answer->id }}" style="display:none;">
        @if($answer->attached)
          <p>Adjunto: <a href="{{ $answer->attached }}" target="_blank"><i class="paperclip"></i> {{ $answer->attached }}</a></p>
        @endif
        {!! $answer->fullcontent !!}
      </div>
    </td>
    <td>{{ $answer->created_at }}</td>
    <td width="100">
      @if($answer->result)
        {{ $answer->result }}
      @else
      <form action="{{ url('/g/'.$activity->course->grade->slug.'/c/'.$activity->course->slug.'/activities/'.$activity->slug.'/score') }}" method="POST">
        {{ csrf_field() }}
        <div class="input-group input-group-sm mb-3">
          <input type="number" name="result" class="form-control form-control-sm" placeholder="4.5" min=1 max=5 step="0.1" required>
          <input type="hidden" name="answer_id" value="{{ $answer->id }}">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
        </div>
      </form>
      @endif
    </td>
  </tr>
@endforeach
</table>
