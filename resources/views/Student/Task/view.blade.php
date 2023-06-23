@@ -1,320 +0,0 @@
@extends('layouts.student')
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

    .header i {
        margin-right: 10px;
        /* adjust this value to increase/decrease the space */
    }

    .header-line {
        height: 1px;
        background-color: #bfbfbf;
        margin-top: 20px;
        margin-bottom: 20px;
    }


    .task-head {
        margin-top: 10px;
        font-size: 24px;
        margin-bottom: 8px;
    }

    .task-email {
        font-size: 0.8rem;
    }

    .file-upload-card {
        background-color: #f5f5f5 !important;
        /* change the background color */
        margin-left: 20px;
        margin-right: 20px;
    }

    /* .card {
  background-color: transparent;
} */

    .task {
        margin: 20px 0;
    }

    /* task sidebar */
    .task-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
        border-radius: 18px;
    }

    .task-userpic {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .task-userpic img {
        float: none;
        margin: 0 auto;
        width: 50%;
        border-radius: 999px;
        align-items: center;
        border-color: #ff6600 !important;
        border-width: 3px;
        /* add this to set the border width */
        border-style: solid;
        /* add this to set the border style */
    }


    .task-usertitle {
        text-align: center;
        margin-top: 20px;
        align-items: center;
        color: #212529;
    }

    .task-head {
        margin-top: 10px;
        font-size: 24px;
        margin-bottom: 8px;
        color: #212529;
        font-weight: bold;
    }

    .due-head {
        margin-top: 10px;
        font-size: 24px;
        margin-bottom: 8px;
        color: #212529;
        font-weight: bold;
    }

    .task-usertitle-name {
        margin-top: 20px;
        color: #212529;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .task-usertitle-subtitle {
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
        margin-left: 20px;
    }

    /* task Content */
    .task-content {
        padding: 20px;
        background: #fff;
        border-radius: 18px;
        height: auto;
    }

    .task-detail-name {
        margin-top: 20px;
        margin-bottom: 10px;
        margin-left: 20px;

    }

    .task-detail-head {
        color: #212529;
        font-size: 16px;
        font-weight: 600;
        margin-top: 10px;
        font-size: 30px;
        margin-bottom: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .task-detail-head:hover {
        color: #f06548;
    }

    .due-date {
        font-size: 1.2rem;
        /* add this to set the font size */
        margin-bottom: 10px;
    }

    .date-posted {
        font-size: 0.8rem;
        color: #878a99;
    }

    .task-details {
        font-size: 1.2rem;
        /* add this to set the font size */
        margin-bottom: 10px;
        margin-left: 20px;
        margin-right: 20px;
    }

    .task-attachments {
        margin-left: 20px;
    }

    .task-attachments-name {
        font-weight: bold;
        font-size: 0.8rem;
        color: #878a99;
    }

    .task-attachments-card {
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 10px;
        margin-top: 10px;
        margin-right: 20px;
    }

    .modal-footer {
        padding: 10px;
    }

    #attach-file-btn {
        width: calc(100% - 20px);
        /* subtracting 20px from the width to account for the padding */
    }

    .submit-btn {
        background-color: #f5f5f5 !important;
        align-items: center;
        font-weight: 600 !important;
        font-size: 12px;
    }

    .file-btn {
        margin-bottom: 10px;
    }

    .validation-error {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 9999;
        margin-bottom: 10px;
    }
</style>

@section('content')
    @if ($acts)
        <div class="container-fluid">
            <div class="row task">
                <div class="col-md-3">
                    <div class="task-sidebar">
                        <a href="{{ route('task_student') }}" style="margin-left: 20px;">
                            <button type="button" class="btn btn-outline-danger">Back</button>
                        </a>
                        @if (\Carbon\Carbon::parse($acts->due_date)->isPast())
                            <span class="due-head" style="color: #e24f4c; margin-left: 11rem;">Late</span>
                        @endif
                        <div class="task-usertitle-name">
                            <h5 class="task-head">
                                My Work
                            </h5>
                        </div>

                        <div class="header-line flex-grow-1 ml-3"></div>
                        <div class="task-usertitle-subtitle">
                            <h6 class="member-email mb-2">Files Uploaded</h6>
                        </div>
                        <div class="card file-upload-card">
                            <div class="card-body" id="file-name">
                                @foreach ($accout as $accouts)
                                    @if ($accouts->attachments)
                                        @foreach (explode(',', $accouts->attachments) as $attachment)
                                            <a href="{{ asset('file/' . $attachment) }}"
                                                download>{{ $attachment }}</a><br>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="header-line flex-grow-1 ml-3"></div>

                        <div class="modal-footer">

                            @if ($errors->has('attachments'))
                                <div class="alert alert-danger validation-error">
                                    {{ $errors->first('attachments') }}
                                </div>
                            @endif

                            <form action="{{ route('submit_task') }}" method="POST" class="flex-grow-1 ml-3"
                                enctype="multipart/form-data">
                                {!! csrf_field() !!}

                                <input type="text" name="output_id" hidden
                                    value="{{ $accout->isNotEmpty() ? $accout[0]->id : '' }}">
                                <input type="text" name="activity_code" hidden value="{{ $acts->id }}">
                                <input type="text" name="student_id" hidden
                                    value="{{ auth('student')->user()->account_code }}">
                                <input type="text" name="first_name" hidden
                                    value="{{ auth('student')->user()->first_name }}">
                                <input type="text" name="last_name" hidden
                                    value="{{ auth('student')->user()->last_name }}">
                                <input type="text" name="adviser_id" hidden
                                    value="{{ auth('student')->user()->adviser_id }}">
                                <input type="text" name="task_code" hidden value="{{ $acts->task_code }}">
                                <input type="text" name="title" hidden value="{{ $acts->title }}">
                                <input type="text" name="description" hidden value="{{ $acts->description }}">
                                <input type="date" name="due_date" hidden value="{{ $acts->due_date }}">
                                {{-- <p> {{$acts->due_date}}</p> --}}
                                <input type="file" name="attachments[]" multiple hidden id="file-input">

                                @foreach ($accout as $accouts)
                                    @if ($accouts->attachments)
                                        @if ($accouts->status == 'Rejected')
                                            <button type="submit" class="btn btn-danger w-100"
                                                id="attach-file-btn">Resubmit</button>
                                        @else
                                            <button type="submit" class="btn submit-btn w-100 disabled"
                                                id="attach-file-btn">Already Submitted</button>
                                        @endif
                                    @endif
                                @endforeach

                                @if ($accout->isEmpty())
                                    <button type="button" class="btn file-btn btn-outline-danger w-100"
                                        id="attach-file-btn"><i class="fas fa-plus"></i> Attach File</button>
                                    <button type="submit" class="btn btn-danger w-100" id="attach-file-btn">Submit</button>
                                @endif

                            </form>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#attach-file-btn').click(function() {
                                        $('#file-input').click();
                                    });

                                    $('#file-input').change(function() {
                                        var fileInput = $(this);
                                        var fileName = fileInput.val().split('\\').pop();
                                        $('#file-name').text(fileName);

                                        // Check if the button should be changed to "Submit"
                                        var resubmitButton = $('#attach-file-btn');
                                        if (resubmitButton.text() === 'Resubmit' && fileInput[0].files.length > 0) {
                                            resubmitButton.text('Submit');
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="task-content">
                        <div class="task-detail-name">
                            <h5 class="task-detail-head">{{ $acts->title }}</h5>
                            <div class="due-date">
                                <p><i class="fas fa-clock" style="margin-right: 5px;"></i><strong>Due Date:</strong>
                                    {{ \Carbon\Carbon::parse($acts->due_date)->format('F d, Y') }}</p>
                            </div>
                            <div class="date-posted">
                                <p><i class="task-icon fas fa-flag" style="margin-right: 5px;"></i><strong>Date
                                        Posted:</strong> {{ $acts->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                        <div class="header-line"></div>
                        <div class="task-details">
                            <p>{{ $acts->description }}</p>
                        </div>
                        <div class="task-attachments">
                            <h6 class="task-attachments-name"><i class="fas fa-paperclip"
                                    style="margin-right: 5px;"></i><strong>Attachments</strong></h6>
                            <div class="task-attachments-card">
                                <div class="card-body ">
                                    <a href="{{ asset('file/' . $acts->attachments) }}"
                                        download>{{ $acts->attachments }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-line"></div>
                    </div>
                </div>
            </div>

        </div>
    @endif
@endsection
