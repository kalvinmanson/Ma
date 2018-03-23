<p class="px-3">
  <small class="text-muted"><i class="fa fa-user"></i> {{ $post->user->name }} <i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</small><br>
  {{ $post->name }}
</p>
