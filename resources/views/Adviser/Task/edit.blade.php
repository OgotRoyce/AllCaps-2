@extends('layouts.adviser')

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
            <a href="{{ route('view_tasks', ['id' => $acts->id] ) }}">
                <button type="button" class="btn btn-outline-danger">Back</button>
            </a>
        </div>
        <div class="col text-end">
            <h5 class="task-head mt-2">Edit a Task</h5>
        </div>
    </div>

    <div class="header-line"></div>
    <form action="{{ route('update_adviser_acts', ['id' => $acts->id]) }}" method="post" enctype="multipart/form-data"
        class="row g-3">
        {!! csrf_field() !!}
        @method('PUT')
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
                value="{{ $acts->title ?? old('title') }}">
        </div>
        <div class="">
            <label for="formFile" class="form-label">Description</label>
            <input type="text" name="description" class="form-control"
                value="{{ $acts->description ?? old('description') }}" id="exampleFormControlInput1">
        </div>
        <div class="form-group" style="margin-top: 10px">
            <label for="inputState">Due Date:</label>
            <input type="date" class="form-control" name="due_date" value="{{ $acts->due_date ?? old('due_date') }}">
        </div>

        <div class="">
            <label for="formFile" class="form-label">Attachments:</label>
            @if($acts->attachments)
                <input type="file" name="attachments[]" multiple class="form-control">
                <p>Current File: {{ $acts->attachments }}</p>
            @else
                <input type="file" name="attachments[]" multiple class="form-control" value="{{ old('attachments') }}">
            @endif
        </div>
        
        
        
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-danger w-100">Save changes</button>
        </div>
    </form>


@endsection
