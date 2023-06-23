@extends('layouts.student')

@section('content')

    <div class="modal-header">
        <a href="{{ route('project') }}">
            <button type="button" class="btn btn-outline-danger">Back</button>
        </a>
    </div>
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
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                value="{{ old('title') }}">
        </div>
        <div class="">
            <label for="formFile" class="form-label">Description</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}"
                id="exampleFormControlInput1">
        </div>
        <div class="">
            <label for="exampleFormControlInput1" class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control" id="exampleFormControlInput1"
                value="{{ old('group_name') }}">
        </div>
        <div class="">
            <label for="formFile" class="form-label">Attach your System's Logo</label>
            <input type="file" name="logo" step="any" class="form-control">
        </div>


        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-danger w-100">Create Project</button>
        </div>
    </form>

@endsection
