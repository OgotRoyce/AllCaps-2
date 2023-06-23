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
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .back-btn {}


    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
        border-radius: 18px;
    }

    .profile-userpic {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .profile-userpic img {
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


    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
        align-items: center;
    }

    .member-name {
        margin-top: 10px;
        font-size: 24px;
        margin-bottom: 8px;
        color: #212529;
        font-weight: bold;
    }

    .member-group {
        font-size: 18px;
    }

    .member-email {
        font-size: 0.8rem;
    }

    .profile-usertitle-name {
        text-transform: uppercase;
        margin-top: 10px;
        color: #212529;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
        font-weight: bold;
    }

    .profile-usertitle-group {
        color: #5b9bd1;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-usertitle-email {
        color: #212529;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        border-radius: 18px;
        height: auto;
    }

    .profile-project-head {
        color: #f06548;
        font-size: 32px;
        font-weight: 600;
        margin-top: 10px;
        font-size: 30px;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .project-container {
        margin-top: 20px;
        margin-left: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .project-img {
        margin-right: 20px;
    }

    .app-logo {
        max-height: 70px;
        object-fit: cover;
        border-radius: 999px;
        border-color: #c4bfbf;
        border: 1px solid;
    }

    .card-content {
        text-align: left;
        overflow: hidden;
        /* add this */
        flex-grow: 1;
    }


    .project-title {
        margin-top: 0px;
        font-weight: 700;
        font-size: 24px !important;
    }

    .project-title a {
        color: #000;
        text-decoration: none !important;
    }

    .project-title a:hover {
        color: #f06548;
        text-decoration: none !important;
    }

    .project-subtitle {
        font-size: 14px;
        color: #999;
        margin-top: 1 px;
    }
</style>

@section('content')
    <div class="container-fluid">

        <div class="modal-header row align-items-center">
            <div class="col">
                <a href="{{ route('advisoree') }}">
                    <button type="button" class="btn back-btn btn-outline-danger">Back</button>
                </a>
            </div>
        </div>

        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-user"></i>Advisee</h5>
                        <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation()">
                            <i class="fas fa-user-slash" style="color: #8a8a8a; font-size: 28px; margin-right: 20px;"></i>
                        </a>
                    </div>
                    <div class="header-line"></div>

                </div>
            </div>

            <div class="container-fluid">
                <div class="row profile">
                    <div class="col-md-3">
                        <div class="profile-sidebar">
                            <div class="profile-userpic">
                                {{-- <img src="{{ asset('/images/no_image.jpg') }}"  /> --}}
                                <img class="avatar"
                                    src="{{ asset('pictures/' . ($students->photo ? $students->photo : 'pic.png')) }}" />

                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <h5 class="member-name">{{ $students->first_name }} {{ $students->last_name }}</h5>
                                </div>
                                <div class="profile-usertitle-group">
                                    <h6 class="member-group">
                                        <b>{{ $students->group_name }}</b>
                                    </h6>
                                </div>
                                <div class="profile-usertitle-email">
                                    <h6 class="member-email mb-2 text-muted"><strong>Email:</strong>
                                        {{ $students->email }}</h6>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="profile-content">
                            <div class="profile-project-details">
                                <h5 class="profile-project-head"><i class="fas fa-folder-open"></i> Project </h5>
                                <div class="header-line-2"></div>
                                {{-- @foreach ($projects as $item) --}}
                                <div class="project-container">
                                    @if ($projects)
                                        <div class="project-img">
                                            {{-- <img class="app-logo" src="{{ asset('/images/no_image.jpg') }}"  /> --}}
                                            <img class="app-logo"
                                                src="{{ asset('pictures/' . ($projects->logo ? $projects->logo : 'pic.png')) }}" />
                                        </div>
                                        <div class="card-content">
                                            <h4 class="project-title">{{ $projects->title }}</h4>
                                            <div class="project-subtitle">
                                                <p>{{ $projects->description }}</p>
                                                <p style="font-size: 12px; color: #666;">Developed by
                                                    <b>{{ $projects->group_name }}</b>
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <p>No project found.</p>
                                    @endif

                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="delete-form" action="{{ route('delete_advisoree', $students->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endsection

        <script>
            function DeleteTaskConfirmation() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to remove this student as your advisee!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
