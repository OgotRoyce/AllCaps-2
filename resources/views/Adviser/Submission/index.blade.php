@extends('layouts.adviser')
<style>
    .header {
        font-family: 'Poppins', sans-serif;
        font-size: 32px;
        color: #f06548;
        display: flex;
        /* add this to enable flexbox */
        align-items: center;
        /* add this to center items vertically */
    }

    .header-2 {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        color: #525252;
        display: flex;
        /* add this to enable flexbox */
        align-items: center;
        /* add this to center items vertically */
    }

    .header-3 {
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        /* font-weight: 200; */
        font-weight: 700;
        color: #495057;
        display: flex;
        /* add this to enable flexbox */
        align-items: center;
        /* add this to center items vertically */
        margin-left: 30px;
    }

    .header i {
        margin-right: 10px;
        /* adjust this value to increase/decrease the space */
    }

    .header-line {
        height: 1px;
        background-color: #bfbfbf;
        margin-bottom: 20px;
    }

    .header-line-2 {
        height: 1px;
        background-color: #bfbfbf;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .back-btn {
        /* margin-bottom: 20px; */
    }

    .edit-btn {
        color: #c4bfbf !important;
        font-size: 1.5rem !important;
    }

    /* style of table */
    .table-card {
        /* margin-top: 40px; */
        margin: -1rem -1rem;
        background: #fff;
        border-radius: 10px;
    }


    thead {
        background-color: #f7f6f6;

    }

    .completed-tasks {
        margin-top: 40px;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="modal-header row align-items-center">
            <div class="col">
                <div class="d-flex align-items-center">
                    <a href="{{ route('adviser_task') }}">
                        <button type="button" class="btn back-btn btn-outline-danger">Back</button>
                    </a>
                    {{-- @foreach ($titles as $item)
                    <h5 class="header-3 mt-2 ml-3"> {{ $item }}</h5>
                    @endforeach --}}
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="header mt-2"><i class="fas fa-file me-2"></i> Submissions </h5>
        </div>
        <div class="header-line"></div>
        {{-- @if ($acts)
                <div class="row task">
                <div class="task-content">
                    <div class="task-detail-name">
                        <h5 class="task-detail-head">{{ $acts->title }}</h5>
                        <div class="due-date">
                            <p>
                                <i class="fas fa-clock me-1"></i>
                                <strong>Due Date:</strong>
                                {{ \Carbon\Carbon::parse($acts->due_date)->format('F d, Y') }}
                            </p>
                    </div>
                </div>
                </div>
            @endif --}}
        <div class="container-fluid">
            <div class="row table-card">
                <table class="table">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <th>Name</th>
                           {{--   <th>Group Name</th> --}}
                            <th>Date submitted</th>
                            {{-- <th>Status</th> --}}
                            {{-- <th>Task Name</th> --}}
                            <th class="col-sm-4">Attachment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($pending as $item)
                        <tbody>
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                {{--   <td>{{ $item->group_name }}</td>  --}}
                                <td>{{ $item->created_at }}</td>
                                {{-- <td>{{$item->status}}</td> --}}
                                {{-- <td>{{ $item->task }}</td> --}}
                                <td>
                                    {{-- <a href="{{ asset('file/' . $item->attachments) }}"
                                        target="_blank">{{ $item->attachments }}</a>

                                        <iframe src="{{ asset('file/' . $item->attachments) }}" frameborder="0" width="100%" height="500"></iframe> --}}

                                    @if (pathinfo($item->attachments, PATHINFO_EXTENSION) === 'docx')
                                        <a href="{{ asset('file/' . $item->attachments) }}" target="_blank">{{ $item->attachments }}</a>
                                    @else
                                        <iframe src="{{ asset('file/' . $item->attachments) }}" frameborder="0" width="100%" height="500"></iframe>
                                    @endif

                                    {{-- IF THE FILE IS .PDF, magbubukas lang sa new window, pero pag .docx, madodownload --}}
                                    {{-- <a class="btn btn-danger" href="#">View</a> --}}
                                </td>
                                <td>
                                    <a class="update-button"
                                        onclick="event.preventDefault(); TaskConfirmation('{{ $item->id }}', 'accept')">
                                        <button class="btn btn-outline-success">Accept</button>
                                    </a>
                                    <a class="update-button"
                                        onclick="event.preventDefault(); TaskConfirmation('{{ $item->id }}', 'reject')">
                                        <button class="btn btn-outline-danger">Reject</button>
                                    </a>
                                    <form id="update-form-{{ $item->id }}" action="" method="POST"
                                        class="d-none">
                                        {!! csrf_field() !!}
                                        @method('PUT')
                                        <input type="hidden" name="action" id="action-{{ $item->id }}"
                                            value="">
                                    </form>
                                </td>

                            </tr>
                        </tbody>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                </table>
            </div>
        </div>

        <div class="completed-tasks col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="header-2 mt-2"><i class="fas fa-clipboard-check" style="margin-right: 10px;"></i> Completed </h5>
            </div>
            <div class="header-line-2"></div>
            <div class="container-fluid">
                <div class="row table-card">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <th>Name</th>
                                {{--   <th>Group Name</th> --}}
                                <th>Date submitted</th>
                                {{-- <th>Status</th> --}}
                                {{-- <th>Task Name</th> --}}
                                <th class="col-sm-4">Attachment</th>
                                {{-- <th>Status</th> --}}
                            </tr>
                        </thead>
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($review as $reviewed)
                            <tbody>
                                <td>{{ $counter }}</td>
                                <td>{{ $reviewed->first_name }} {{ $reviewed->last_name }}</td>
                                {{--   <td>{{ $reviewed->group_name }}</td> --}}
                                <td>{{ $reviewed->updated_at }}</td>
                                {{-- <td>{{ $reviewed->task }}</td> --}}
                                <td>
                                    <a href="{{ asset('file/' . $reviewed->attachments) }}"
                                        target="_blank">{{ $reviewed->attachments }}</a>

                                </td>
                                {{-- <td>{{ $reviewed->status }}</td> --}}
                                </tr>
                            </tbody>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <script>
            function TaskConfirmation(taskId, action) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to ' + (action === 'accept' ? 'accept' : 'reject') + ' this task!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: (action === 'accept' ? 'Accept' : 'Reject')
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('action-' + taskId).value = action;
                        var form = document.getElementById('update-form-' + taskId);

                        // Set the form action dynamically based on the selected action
                        if (action === 'accept') {
                            form.action = "{{ route('accept_tasks', '') }}/" + taskId;
                        } else if (action === 'reject') {
                            form.action = "{{ route('reject_tasks', '') }}/" + taskId;
                        }

                        form.submit();
                    }
                });
            }
        </script>
    @endsection
