@extends('layout')

@section('content')

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>Name</td>
          <td>UUID</td>
          <td>Notes</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{$company->name}}</td>
            <td>{{$company->uuid}}</td>
            <td>{{$company->notes_count}}</td>
            <td class="text-center">
                <a href="{{ route('companies.show', $company->uuid)}}" class="btn btn-primary btn-sm"">Show</a>
                @if (Route::has('login'))
                  @auth
                    <a href="{{ route('companies.edit', $company->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                    <form action="{{ route('companies.destroy', $company->id)}}" method="post" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                    </form>
                  @endauth
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  @if (Route::has('login'))
          @auth
              <a href="{{ route('companies.create')}}" class="btn btn-info btn-lg float-right"">Create</a>
          @else
              <p class="float-right lead">Please login to create, edit and delete companies.</p>  
          @endauth
  @endif
<div>
@endsection