@extends('layouts.app')
@section('title')
Home
@endsection()


@section('content')
<x-full-layout>
@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>  
@endif
    <h1 style="color: black">Welcome to the Students Module</h1>
      <p class="lead">Homepage</p>
      <a href="{{ route('students.view')}}" class="btn btn-success">Add Students</a>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Created Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <th>{{ $post->id }}</th>
              <td>{{ $post->name }}</td>
              <td>{{ $post->type }}</td>
              <td>{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y, g A') }}</td>
              <td>
                <a href="{{ route('students.edit.form',$post->id)}}" class="btn btn-warning">Edit</a>
                <form action="{{ route('students.delete',$post->id)}}" method="POST" class="d-inline delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">
                      Delete
                  </button>
                </form>
                
              </td>
          </tr>  
          @endforeach

            
        
        </tbody>
      </table>
    </x-full-layout>
      {{-- <h1>{{ $users->name}}</h1>
      <p>{{ $users->email}}</p> --}}
      {{-- <br/><br/>
      <x-alert type="info" >
        Message
      </x-alert>
      <br/><br/>

      <x-button type='success'>
        Yes
      </x-button>
      <x-button type='danger'>
        No
      </x-button>
      <br/><br/>
      <x-card>
        <x-slot:header>
          Card Title
        </x-slot>
        <x-slot:name>
          John
        </x-slot>
        <x-slot:text>
          Grade 1
        </x-slot>
          Body
      </x-card> --}}
      

@endsection

