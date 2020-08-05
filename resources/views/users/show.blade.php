@extends('layout')

@section('content')

<div class="card push-top">
  <div class="card-header">
    {{$user->first_name}} {{$user-> last_name}}
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <small>E-Mail:  {{$user->email}}</small>
  </div>
</div>

<div class="card push-top">
  <div class="card-header">
    Notes
  </div>

  <div class="container">
    @foreach ($user->notes as $note)
    <div class="row">
      <div class="col-auto mr-auto">
        {{$note->message}}
      </div>
      <hr>
      @if (Route::has('login'))
        @auth
          <div class="col-auto">
            <form action="{{ route('users.destroyNote', [$note->id, $user->id])}}" method="post" style="display: inline-block">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
            </form>
          </div>
        @endauth
      @endif
    </div>
    @endforeach
  </div>
</div>

<div class="card push-top">
  <div class="card-header">
    Add a Note
  </div>
  <form method="post" action="{{ route('users.storeNote', $user->id) }}">
    <div class="form-group">
        @csrf
        <input type="text" class="form-control" name="message" placeholder="Message..."/>
    </div>
    <button type="submit" class="btn btn-primary float-right">Add Note</button>
  </form>
</div>


@endsection