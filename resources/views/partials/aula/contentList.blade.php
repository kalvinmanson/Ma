<a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}" title="{{ $content->name }}" class="list-group-item">
  <span class="badge bg-secondary text-white p-1 float-right"><i class="fa fa-question-circle"></i> {{ $content->activities->count() }}</span>
  <span class="badge bg-secondary text-white p-1 mr-1 float-right"><i class="fa fa-comments"></i> {{ $content->topics->count() }}</span>
  <h4>
    {{ $content->name }}
  </h4>
  <p><small class="text-muted">{{ $content->description }}</small></p>
</a>
