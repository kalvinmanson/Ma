<a href="/g/{{ $content->course->grade->slug }}/c/{{ $content->course->slug }}/contents/{{ $content->slug }}" title="{{ $content->name }}" class="list-group-item">
  <div class="bmd-list-group-col">
    <p class="list-group-item-heading">{{ $content->name }}</p>
    <p class="list-group-item-text">
      <i class="fa fa-question-circle m-0"></i> {{ $content->activities->count() }} - 
      <i class="fa fa-comments"></i> {{ $content->topics->count() }} |
      {{ $content->description }}<br>
    </p>
  </div>
</a>
