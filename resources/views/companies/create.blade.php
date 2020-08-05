@extends('layout')

@section('content')
<div class="card push-top">
  <div class="card-header">
    Add Company
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
      <form method="post" action="{{ route('companies.store') }}">
          <div class="form-group">
              @csrf 
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <button type="submit" class="btn btn-block btn-info">Create Company</button>
      </form>
  </div>
</div>
@endsection