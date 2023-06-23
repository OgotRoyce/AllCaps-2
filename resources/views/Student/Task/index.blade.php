@extends('layouts.student')
<style>
    .header {
        font-family: 'Poppins', sans-serif;
        font-size: 32px;
        color: #f06548;
        display: flex;
        align-items: center;
    }

    .header i {
        margin-right: 10px;
    }

    .header-line {
        height: 1px;
        background-color: #bfbfbf;
        margin-bottom: 20px;
    }

    :root {
        --bg: transparent;
        --text: #2e2e2f;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        color: var(--text);
    }

    .app {
        background-color: var(--bg);
        width: 100%;
    }

    h1 {
        font-size: 30px;
    }

    .project {
        padding: 10px;
        display: inline-block;
        background: #fff;
        width: 100%;
    }

    .project-info {
        padding: 2rem 0;
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
    }

    .project-tasks {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        /* Add this line */
        margin-bottom: 1rem;
        width: 100%;
        grid-column-gap: 1.5rem;
        margin-left: 1rem;
        border-bottom: 1px solid;
        border-image: linear-gradient(to right, transparent, #34495e, transparent) 1;
    }


    .task-img {
        margin-right: 0.5rem;
        font-size: 3rem;
        color: #ff6600;
        margin-top: -1rem;
    }

    .project-column {

        &-heading {
            margin-bottom: 1rem;
            display;
            justify-content: space-between;

            &__title {
                font-size: 14px;
            }
        }
    }

    .project-column-header {
        margin-bottom: 1rem;
        justify-content: space-between;
    }

    .project-column-header__title {
        color: #212529;
        font-weight: 600;
        font-size: 18px;
    }

    .project-column-header__link:hover {
        text-decoration: underline;
    }

    .project-column-header__link {
        cursor: pointer;
    }

    .status {
        margin-left: auto;
        font-style: italic;
        font-size: 16px;
        color: #f39100;
        margin-right: 3rem;
    }

    .status-done {
        margin-left: auto;
        font-style: italic;
        font-size: 16px;
        color: #45b565;
        margin-right: 3rem;
    }

    .status-warning {
        margin-left: auto;
        font-style: italic;
        font-size: 16px;
        color: #ff0000;
        margin-right: 3rem;
    }

    .task-stats {
        display: flex;
        align-items: center;
    }

    .task-icon {
        margin-right: 5px;
    }

    date {
        margin-right: 25px;
    }

    .task-icon,
    date {
        color: #c4bfbf;
    }

    .task-file {
        margin-right: 5px;
    }

    .task-file-count {
        margin-right: 25px;
        color: #c4bfbf;
    }

    .task-file,
    .task-file-count {
        color: #c4bfbf !important;
    }

    /* accordion list */

    .accordion {
        width: 100%;
        max-width: 100%;
        margin: 2rem auto;
    }

    .accordion-item {
        background-color: #fff;
        color: #111;
        margin: 1rem 0;
        border-radius: 0.5rem;
        width: 100%;
    }

    .accordion-item-header {
        padding: 0.5rem 3rem 0.5rem 1rem;
        min-height: 3.5rem;
        line-height: 1.25rem;
        display: flex;
        align-items: center;
        position: relative;
        cursor: pointer;
        color: #212529;
        font-weight: 700;
        font-size: 20px;
        margin-left: 1rem;
    }

    .accordion-item-header::after {
        content: "\002B";
        font-size: 2rem;
        position: absolute;
        right: 1rem;
    }

    .accordion-item-header.active::after {
        content: "\2212";
    }

    .accordion-item-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        width: 100%;
    }

    .accordion-item-body-content {
        padding: 10px;
        border-top: 1px solid;
        border-image: linear-gradient(to right, transparent, #34495e, transparent) 1;
    }

    .accordion-img {
        margin-right: 1rem;
        font-size: 20px;
        color: #424242;
    }

    @media(max-width:767px) {
        html {
            font-size: 14px;
        }
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-list"></i> Tasks
                            <span class="badge badge-secondary"><span style="font-weight: 300; color: #bfbfbf;">List of
                                    complete and pending tasks</span>
                        </h5>
                    </div>
                    <div class="header-line"></div>

                    @foreach ($tasks as $task)
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-item-header">
                                    <div class="left-content">
                                        <i class="accordion-img fas fa-folder-open"></i>
                                        <!-- Task Title -->
                                        {{ $task->task }}
                                    </div>
                                    {{-- <div class="right-content">

                                    <i class="accordion-img fas fa-pencil-alt" style="color: #DD6B55" data-bs-target="#exampleModalToggle-{{ $task->id }}" data-bs-toggle="modal"></i>

                                    <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation()">
                                    <i class="accordion-img fas fa-trash"  style="color: #DD6B55" ></i>
                                    </a>
                                        <form id="delete-form" action="{{ route('delete_tasks',$task->task_code) }}" method="POST" class="d-none">
                                            {!! csrf_field() !!}
                                            @method('DELETE')
                                        </form>
                                </div> --}}

                                </div>


                                <div class="accordion-item-body">
                                    <div class="accordion-item-body-content">
                                        <div class='app'>
                                            <main class='project'>
                                                @foreach ($acts as $act)
                                                    @if ($act->task_code === $task->task_code)
                                                        <div class='project-tasks'>
                                                            <a href="{{ route('view_student_tasks', $act->id) }}"
                                                                class="project-column-header__link">
                                                                <i class="task-img fas fa-clipboard-list"></i>
                                                                <div class='project-column'>
                                                                    <h2 class='project-column-header__title'>
                                                                        {{ $act->title }}</h2>
                                                            </a>

                                                            <div class='task'>
                                                                <p>Due Date:
                                                                    {{ \Carbon\Carbon::parse($act->due_date)->format('F d, Y') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $submissionFound = false;
                                                            $reviewFound = false;
                                                        @endphp
                                                        @foreach ($outputs as $output)
                                                            @if ($act->id == $output->activity_code && $output->status == 'pending')
                                                                <div class='status'>
                                                                    <p>Submitted </p>
                                                                </div>

                                                                @php
                                                                    $submissionFound = true;
                                                                    break;
                                                                @endphp

                                                                <!-- Exit the loop after finding a match -->
                                                            @elseif($act->id == $output->activity_code && $output->status == 'Accepted')
                                                                <div class='status-done'>
                                                                    <p>{{ $output->status }} by the Project Adviser</p>
                                                                </div>
                                                                @php
                                                                    $reviewFound = true;
                                                                    break;
                                                                @endphp
                                                            @elseif($act->id == $output->activity_code && $output->status == 'Rejected')
                                                                <div class='status-warning'>
                                                                    <p>{{ $output->status }} by the Project Adviser</p>
                                                                </div>
                                                                @php
                                                                    $reviewFound = true;
                                                                    break;
                                                                @endphp

                                                                <!-- Exit the loop after finding a match -->
                                                            @endif
                                                        @endforeach

                                                        @if (!$submissionFound && !$reviewFound)
                                                            <!-- Check if it's the last iteration of the loop -->
                                                            <div class='status-warning'>
                                                                <p>No Submission</p>
                                                            </div>
                                                        @endif


                                        </div>
                    @endif
                    @endforeach

                    </main>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    <script>
        const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

        accordionItemHeaders.forEach(accordionItemHeader => {
            accordionItemHeader.addEventListener("click", event => {

                // Uncomment in case you only want to allow for the display of only one collapsed item at a time!

                // const currentlyActiveAccordionItemHeader = document.querySelector(".accordion-item-header.active");
                // if(currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader!==accordionItemHeader) {
                //   currentlyActiveAccordionItemHeader.classList.toggle("active");
                //   currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
                // }

                accordionItemHeader.classList.toggle("active");
                const accordionItemBody = accordionItemHeader.nextElementSibling;
                if (accordionItemHeader.classList.contains("active")) {
                    accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
                } else {
                    accordionItemBody.style.maxHeight = 0;
                }

            });
        });
    </script>
@endsection
