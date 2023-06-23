@extends('layouts.adviser')
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

    .project-tasks-delete {
        display: flex;
        align-items: center;
        margin-left: auto;
        margin-right: 10px;
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

    .accordion-item-header {
        display: flex;
        justify-content: space-between;
    }

    .left-content {
        flex-grow: 1;
    }

    .right-content {
        text-align: right;
    }

    .logout-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    @media(max-width:767px) {
        html {
            font-size: 14px;
        }
    }

    .input-group-form {
        margin-right: 1rem;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-list"></i> Tasks
                        </h5>


                        {{-- <form action="{{ route('add_new_task')}}" method="post">
    {!! csrf_field() !!}
<div class="input-group mb-3">
    <input type="text" class="form-control input-group-form" placeholder="New Task" aria-label="Recipient's username" aria-describedby="basic-addon2" name="task" required>
        <span >
        <button type="submit" style="width:100%" class="btn btn-outline-danger float-right input-group-text" >+ Create New Task</button>
    </span>
  </div>
</form> --}}
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

                    <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation('{{ $task->id }}')">
                        <i class="accordion-img fas fa-trash" style="color: #DD6B55"></i>
                    </a>
                    <form id="delete-form-{{ $task->id }}" action="{{ route('delete_adviser_tasks', $task->task_code) }}" method="POST" class="d-none">
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
                                                            <a href="{{ route('view_adviser_tasks', $act->id) }}"
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
                                                        {{-- <div class="project-tasks-delete">
                                                            <a class="delete-button"
                                                                onclick="event.preventDefault(); DeleteActivityConfirmation('{{ $act->id }}')">
                                                                <i class="accordion-img fas fa-trash"
                                                                    style="color: #8a8a8a"></i>
                                                            </a>
                                                            <form id="delete-acts-{{ $act->id }}"
                                                                action="{{ route('delete_adviser_acts', $act->id) }}"
                                                                method="POST" class="d-none">
                                                                {!! csrf_field() !!}
                                                                @method('DELETE')
                                                            </form>
                                                        </div> --}}
                                        </div>
                    @endif
                    @endforeach

                    {{-- <a href="{{ route('create_adviser_tasks', $task->id) }}">
                        <button type="button" style="width:100%"
                            class="btn btn-outline-danger float-right input-group-text">+ Add Activity</button>
                    </a> --}}
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

    @foreach ($tasks as $task)
        <!-- Modal -->
        <div class="modal fade" id="exampleModalToggle-{{ $task->id }}" aria-hidden="true"
            aria-labelledby="exampleModalToggleLabel-{{ $task->id }}" tabindex="-1">
            <!-- Modal Content -->
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel-{{ $task->id }}">Update Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('update_tasks', $task->id) }}" method="POST">
                            {!! csrf_field() !!}
                            @method('PUT')

                            <div class="mb-3">
                                <label for="taskInput-{{ $task->id }}" class="form-label">Task</label>
                                <input type="text" class="form-control" id="taskInput-{{ $task->id }}" name="task"
                                    value="{{ $task->task }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        function DeleteActivityConfirmation(actId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete the activity.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-acts-' + actId).submit();
                }
            });
        }
    </script>

    <script>
        function DeleteTaskConfirmation(taskId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete the task.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + taskId).submit();
                }
            });
        }
    </script>

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
