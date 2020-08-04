@extends('layout')

@section('content')

<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>

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

@include('partials.notes')

<div class="card push-top">
  <div class="card-header">
    Add a Note
  </div>
  <form method="post" action="{{ route('users.storeNote', $user->id) }}">
    <div class="form-group">
        @csrf
        <input type="text" class="form-control" name="message" placeholder="Message..."/>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Add Note</button>
    </div>
  </form>
</div>


@endsection