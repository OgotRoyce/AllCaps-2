@extends('layouts.admin')

<style>
 .form-label{
    font-family: 'Poppins', sans-serif;
        font-size: 32px;
        color: #525252;
        display: flex;
        /* add this to enable flexbox */
        align-items: center;
        /* add this to center items vertically */
        margin-bottom: 20px;
 }
</style>

@section('content')

    <div class="modal-header">
        <a href="{{ route('students_admin') }}">
            <button type="button" class="btn btn-outline-danger">Back</button>
        </a>
    </div>

    <form action="{{ route('students.import') }}" method="post" enctype="multipart/form-data" class="row g-3">
        {!! csrf_field() !!}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="">
            <label for="formFile" class="form-label"><i class="fas fa-file-upload" style="margin-left: 20px; margin-right: 20px;"></i>Upload Students</label>
            <input type="file" name="file" accept=".xls, .xlsx" step=any class="form-control">
        </div>

        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-danger w-100">Upload</button>
        </div>
    </form>

    <script>
        const showPasswordToggle = document.getElementById('show-password-toggle');
        const passwordField = document.getElementsByName('password')[0];

        showPasswordToggle.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show Password' : 'Hide Password';
        });
    </script>
@endsection
{{-- <div class="">
            <label for="exampleFormControlInput1" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1"
                value="{{ old('first_name') }}">
        </div>
        <div class="">
            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1"
                value="{{ old('last_name') }}">
        </div>
        <div class="">
            <label for="formFile" class="form-label">Email</label>
            <input type="email" name="email" step="any" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="formFile" class="form-label">Password</label>
            <div class="input-group">
              <input type="password" name="password"  class="form-control" id="exampleFormControlInput1">
              <button type="button" class="btn btn-outline-danger" id="show-password-toggle">Show Password</button>
            </div>
          </div> --}}
