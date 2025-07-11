@extends('layouts.app')
@section('title')
Home
@endsection()


@section('content')
<x-full-layout>
@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>  
@endif
    <h1 style="color: black">User</h1>
      <a href="{{ route('users.add.form')}}" class="btn btn-success">Add Users</a>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Photo</th>
            <th scope="col">Created Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <th>{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td>
                    <img src="{{ asset('storage/uploads/'.$user->photo) }}" 
                    width="50" height="50" class="rounded-circle">
              </td>
              <td>{{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y, g A') }}</td>
              <td>
                <a href="{{ route('users.edit.form',$user->id)}}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger delete-btn" data-id="{{ $user->id}}">Delete</button>
                
              </td>
          </tr>  
          @endforeach

            
        
        </tbody>
      </table>
</x-full-layout>

@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');

        Swal.fire({
          title: 'Are you sure?',
          text: "This action cannot be undone!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            fetch(`/users/delete/${userId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              }
            })
            .then(response => response.json())
            .then(data => {
              Swal.fire('Deleted!', data.success, 'success')
              .then(() => window.location.reload());
            })
            .catch(error => {
              Swal.fire('Error', 'Something went wrong!', 'error');
            });
          }
        });
      });
    });
  });
</script>