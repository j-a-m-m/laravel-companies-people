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
          <td>First Name</td>
          <td>Last Name</td>
          <td>Email</td>
          <td>Notes</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->notes_count}}</td>
            <td class="text-center">
                <a href="{{ route('users.show', $user->id)}}" class="btn btn-primary btn-sm"">Show</a>
                @if (Route::has('login'))
                  @auth
                    <a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                    <form action="{{ route('users.destroy', $user->id)}}" method="post" style="display: inline-block">
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
            <a href="{{ route('users.create')}}" class="btn btn-info btn-lg float-right"">Create</a>
        @else
            <p class="float-right lead">Please login to create, edit and delete users.</p>  
        @endauth
    @endif
<div>
@endsection