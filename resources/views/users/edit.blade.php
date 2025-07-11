@extends('layouts.app')
@section('title')
Add User
@endsection()

@section('content')
<x-full-layout>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>    
@endif

    <h1 style="color: black">Edit User</h1>
    <form style="color: black" action="{{ route('users.edit',$user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" value="{{ old('name',$user->name) }}" name="name" id="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Email</label>
            <input type="text" class="form-control" value="{{ old('email',$user->email) }}" name="email" id="email" placeholder="email" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control" id="role">
                <option value="" disabled selected> -- Select Role --</option>
                <option value="Admin" {{ old('role',$user->role) == 'Admin' ? 'selected' : '' }} >Admin</option>
                <option value="Customer" {{ old('role',$user->role) == 'Customer' ? 'selected' : '' }}>Customer</option>
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div> --}}
        <div class="mb-3">
            <label for="photo" class="form-label">Photo (Optional)</label><br>
            @if($user->photo)
                <img src="{{ asset('storage/uploads/'.$user->photo) }}" width="80" class="mb-2">
            @endif
            <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo">
        </div>
        <button type="submit" class="btn btn-primary">
            Update User
        </button>
        <a href="{{ route('users.index') }}">Go to index</a>
    </form>
</x-full-layout>
@endsection