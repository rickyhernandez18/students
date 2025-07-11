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
    <h1 style="color: black">Create a User</h1>
    <form action="{{ route('users.add')}}" method="POST" enctype="multipart/form-data" style="color: black">
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="email" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control" id="role">
                <option value="" disabled selected> -- Select Role --</option>
                <option value="Admin">Admin</option>
                <option value="Customer">Customer</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo" required>
        </div>
        <button type="submit" class="btn btn-primary">
            Add User
        </button>
        <a href="{{ route('users.index') }}" style="color: black">Go to index</a>
    </form>
</x-full-layout>
@endsection