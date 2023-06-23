@extends('layouts.admin')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>

<style>
.my-btn {
  background-color : #e83f33 !important;
  color: #fff !important;
  border-color: #e83f33 !important;
}
</style>

@section('content')

    <div class="modal-header d-flex justify-content-between align-items-center">
        <a href="{{ route('students_admin') }}">
            <button type="button" class="btn btn-outline-danger">Back</button>
        </a>

        <a href="{{ route('delete-member', $members->customer_id) }}" class="btn my-btn btn-outline-danger" onclick="event.preventDefault(); Swal.fire({
          title: 'Are you sure?',
          text: 'You will not be able to recover this member!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e83f33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById('delete-form-{{ $members->customer_id }}').submit();
          }
        });"><i class="fas fa-trash-alt fa-fw"></i>Delete</a>
        
        <form id="delete-form-{{ $members->customer_id }}" action="{{ route('delete-member', $members->customer_id) }}" method="post" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <div class="modal-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('update-member', $members->customer_id) }}" method="post" enctype="multipart/form-data"
            class="row g-3">
            {!! csrf_field() !!}
            @method('PUT')
            <div class="">
                <label for="exampleFormControlInput1" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1"
                    value="{{ $members->first_name }}">
            </div>
            <div class="">
                <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1"
                    value="{{ $members->last_name }}">
            </div>
            <!-- <div class="">
                <label for="exampleFormControlInput1" class="form-label">Mobile Number</label>
                <input type="number" name="mobile_number" class="form-control" id="exampleFormControlInput1"
                    value="{{ $members->mobile_number }}">
            </div> -->
            <div class="">
                <label for="formFile" class="form-label">Email</label>
                <input type="email" name="email" step="any" class="form-control" value="{{ $members->email }}">
            </div>
            {{-- <div class="">
                    <label for="formFile" class="form-label">Password</label>
                    <input type="password" name="password" step="any" class="form-control" >
                </div> --}}
            <div class="">
                <label for="formFile" class="form-label">Profile Photo</label>
                <input type="file" name="photo" step="any" class="form-control">
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-outline-danger w-100">Update</button>
            </div>
        </form>

    @endsection
