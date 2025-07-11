@extends('layouts.app')
@section('title')
Edit Student
@endsection()

@section('content')
<x-full-layout>
    <h1 style="color: black">Edit a Student</h1>
    <form action="{{ route('students.edit')}}" method="POST" style="color: black">
    @csrf
    @method('PUT')
        <input type="hidden" name="id" id="id" value="{{ $posts->id }}">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $posts->name}}" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="{{ $posts->type}}" required>
        </div>
        <button type="submit" class="btn btn-primary">
            Edit Student
        </button>
        <a href="{{ route('dashoard') }}" style="color: black">Go to index</a>
    </form>
</x-full-layout>
@endsection