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
    {{$company->name}}
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
    <small>UUID:  {{$company->uuid}}</small>
  </div>
</div>

<div class="card push-top">
  <div class="card-header">
    Notes
  </div>

  <div class="container">
    @foreach ($notes as $note)
    <div class="row">
      <div class="col-auto mr-auto">
        {{$note->message}}
      </div>
      <hr>
      <div class="col-auto">
        <form action="{{ route('companies.destroyNote', [$company->uuid, $note->id])}}" method="post" style="display: inline-block">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="card push-top">
  <div class="card-header">
    Add a Note
  </div>
  <form method="post" action="{{ route('companies.storeNote', $company->uuid) }}">
    <div class="form-group">
        @csrf
        <input type="text" class="form-control" name="message" placeholder="Message..."/>
    </div>
    <input type="hidden" value="{{$company->id}}" name="company_id" />
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Add Note</button>
    </div>
  </form>
</div>


@endsection