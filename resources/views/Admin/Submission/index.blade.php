@extends('layouts.admin')
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
        margin-bottom: 30px;
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
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
    }

    .status-label {
        display: inline-block;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 4px;
    }

    .status-accepted {
        background-color: #28a745;
        text-transform: uppercase;
        color: #fff;
    }

    .status-rejected {
        background-color: #dc3545;
        color: #fff;
        text-transform: uppercase;
    }

    .status-pending {
        background-color: #ffc107;
        color: #212529;
        text-transform: uppercase;
    }

    .submit-score-btn {
        font-size: 12px;
        width: 35px;
        height: 35px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-wrap: wrap !important;
        padding: 0;
    }

    .score-input {
        width: 70px !important;
        height: 35px !important;
    }

    .score-value {
        font-weight: bold !important;
    }


    thead {
        background-color: #f7f6f6;

    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="modal-header row align-items-center">
            <div class="col">
                <div class="d-flex align-items-center">
                    <a href="{{ route('tasks_admin') }}">
                        <button type="button" class="btn back-btn btn-outline-danger">Back</button>
                    </a>
                    @foreach ($titles as $item)
                        <h5 class="header-2 mt-2 ml-3"> {{ $item }}</h5>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="d-flex align-items-center">
                <h5 class="header mt-2"><i class="fas fa-file me-2"></i> Submissions </h5>
            </div>
            <div class="header-line"></div>

            <div class="container-fluid">
                <div class="row table-card">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                {{--   <th>Group Name</th> --}}
                                <th>Date submitted</th>
                                {{-- <th>Task Name</th> --}}
                                <th>Status</th>
                                <th class="col-sm-4">Attachment</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($acts as $item)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    {{--  <td>{{ $item->group_name}}</td>  --}}
                                    <td>{{ $item->created_at }}</td>
                                    {{-- <td>{{ $item->task }}</td> --}}

                                    <td>
                                        <span
                                            class="status-label
                                                @if ($item->status == 'Accepted') status-accepted
                                                @elseif ($item->status == 'Rejected')
                                                    status-rejected
                                                @elseif ($item->status == 'pending')
                                                    status-pending @endif
                                            ">
                                            {{ $item->status }}
                                        </span>
                                    </td>



                                    {{-- <td>
                                        <a href="{{ asset('file/' . $item->attachments) }}"
                                            download>{{ $item->attachments }}</a>
                                    </td> --}}
                                    <td>
                                        <a href="{{ asset('file/' . $item->attachments) }}"
                                            target="_blank">{{ $item->attachments }}</a>
                                        {{-- IF THE FILE IS .PDF, magbubukas lang sa new window, pero pag .docx, madodownload --}}
                                    </td>

                                    {{-- <td contenteditable="true">{{ $item->score }}</td> --}}
                                    <td>
                                        @if ($item->score_submitted)
                                            <span class="score-value">{{ $item->score }}</span>
                                        @else
                                            <form class="score-form"
                                                action="{{ route('submitScore', ['act' => $item->id]) }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" name="score" oninput="validateInput(this)"
                                                        class="form-control score-input" placeholder="Enter score" required>
                                                    <button type="submit" class="btn btn-danger btn-sm submit-score-btn"><i
                                                            class="fas fa-check"></i></button>
                                                </div>
                                            </form>
                                        @endif

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
        </div>
    </div>
    <script>
        function validateInput(input) {
            input.value = input.value.replace(/\D/g, '');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.submit-score-btn').on('click', function(event) {
                event.preventDefault();
                var scoreForm = $(this).closest('.score-form');
                var scoreInput = scoreForm.find('.score-input');
                var score = scoreInput.val();
                var actId = scoreForm.data('act-id');

                // Make an AJAX request to submit the score
                $.ajax({
                    url: scoreForm.attr('action'),
                    method: 'POST',
                    data: {
                        score: score
                    },
                    success: function(response) {
                        console.log('Score submitted successfully!');
                        scoreInput.prop('disabled', true);
                        scoreForm.find('.submit-score-btn').prop('disabled', true).text(
                            'Submitted');
                        scoreForm.find('.edit-score-btn').show();
                    },
                    error: function(xhr) {
                        console.log('Error submitting score:', xhr.responseText);
                    }
                });
            });

            $('.edit-score-btn').on('click', function() {
                var scoreElement = $(this).siblings('.score-value');
                var editScoreForm = $(this).siblings('.edit-score-form');

                scoreElement.hide();
                $(this).hide();
                editScoreForm.show();
                editScoreForm.find('.score-input').focus();
            });

            $('.edit-score-form').on('submit', function(event) {
                event.preventDefault();
                var editScoreForm = $(this);
                var scoreInput = editScoreForm.find('.score-input');
                var score = scoreInput.val();
                var actId = editScoreForm.data('act-id');

                // Make an AJAX request to update the score
                $.ajax({
                    url: editScoreForm.attr('action'),
                    method: 'POST',
                    data: {
                        _method: 'PATCH',
                        score: score
                    },
                    success: function(response) {
                        console.log('Score updated successfully!');
                        scoreInput.prop('disabled', true);
                        editScoreForm.find('.submit-score-btn').prop('disabled', true).text(
                            'Saved');
                        editScoreForm.hide();
                        editScoreForm.siblings('.score-value').text(score).show();
                        editScoreForm.siblings('.edit-score-btn').show();
                    },
                    error: function(xhr) {
                        console.log('Error updating score:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
