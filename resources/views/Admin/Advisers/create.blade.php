@extends('layouts.admin')

<style>

.task-head {
        /* color: #f06548; */
        color: #fbfbf;
        font-size: 32px;
        font-weight: 300;
        margin-top: 10px;
        margin-left: 20px;
    }

    .header-line {
        height: 1px;
        background-color: #bfbfbf;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
@section('content')

<div class="modal-header">
        <div class="col">
            <a href="{{ route('adviser') }}">
                <button type="button" class="btn btn-outline-danger">Back</button>
            </a>
        </div>
        <div class="col text-end">
            <h5 class="task-head mt-2">Add Adviser</h5>
        </div>
    </div>

    <div class="header-line"></div>
            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
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
                    <label for="exampleFormControlInput1" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1" value="{{ old('first_name') }}" >
                </div>
                <div class="">
                    <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1" value="{{ old('last_name') }}" >
                </div>
                <div class="">
                    <label for="formFile" class="form-label">Email</label>
                    <input type="email" name="email"  class="form-control" value="{{ old('email') }}" id="exampleFormControlInput1">
                </div>
                <div class="">
                    <label for="exampleFormControlInput1" class="form-label">Program</label>
                    <select id="inputState" class="form-control form-select" name="program">
                        <option></option>
                        <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                        <option value="BSCS" {{ old('program') == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                        <option value="BSEMC" {{ old('program') == 'BSEMC' ? 'selected' : '' }}>BSEMC</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="formFile" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password"  class="form-control" id="exampleFormControlInput1">
                      <button type="button" class="btn btn-outline-danger" id="show-password-toggle">Show Password</button>
                    </div>
                  </div>

                    <!-- ito yung picture upload function, place holder lang muna  -->
                <div class="">
                    <label for="formFile" class="form-label">Select Profile Photo:</label>
                    <input type="file" name="photo" step="any" class="form-control">
                </div>

                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-danger w-100">Create</button>
                </div>
            </form>

            <script>
                const showPasswordToggle = document.getElementById('show-password-toggle');
                const passwordField = document.getElementsByName('password')[0];
                
                showPasswordToggle.addEventListener('click', function () {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    this.textContent = type === 'password' ? 'Show Password' : 'Hide Password';
                });
            </script>
            
@endsection