@extends('layouts.app')
@section('title')
Add Student
@endsection()

@section('content')
<x-full-layout>
    <h1 style="color: black">Create a Student</h1>
    <form action="{{ route('students.add')}}" method="POST" style="color: black">
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" required>
        </div>
        <button type="submit" class="btn btn-primary">
            Add Student
        </button>
        <a href="{{ route('dashboard') }}" style="color: black">Go to index</a>
    </form>
</x-full-layout>
@endsection