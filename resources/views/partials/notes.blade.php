<div class="card push-top">
  <div class="card-header">
    Notes
  </div>

  <ul class="list-group list-group-flush">
    @foreach ($notes as $note)
      <li class="list-group-item">{{$note->message}}</li>
    @endforeach
  </ul>
</div>