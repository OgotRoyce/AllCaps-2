@extends('layouts.student')

<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
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

    .card-img {
        padding: 10px;
    }

    /* .card {
  background-color: transparent;
} */

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
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-user"></i> Profile </h5>
                    </div>
                    <div class="header-line"></div>
                    <div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row profile">
                    <div class="col-md-3">
                        <div class="profile-sidebar">
                            <div class="profile-userpic">
                                {{-- <img src="{{ asset('images/dp.png') }}" class="img-responsive" alt=""> --}}
                                <img class="img-responsive" src="{{ asset('pictures/'.( auth('student')->user()->photo ? auth('student')->user()->photo : 'pic.png')) }}"  />
                            </div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <h5 class="member-name">{{ auth('student')->user()->first_name }}
                                        {{ auth('student')->user()->last_name }}</h5>
                                </div>
                                <div class="profile-usertitle-group">
                                    <h6 class="member-group">
                                        <b>{{ auth('student')->user()->group_name }}</b></h6>
                                </div>
                                <div class="profile-usertitle-email">
                                    <h6 class="member-email mb-2 text-muted"><strong>Email:</strong>
                                        {{ auth('student')->user()->email }}</h6>
                                </div>

                            </div>
                        </div>
                    </div>

                        <div class="col-md-9">
                            <div class="profile-content">
                                <div class="profile-project-details">
                                    <h5 class="profile-project-head"><i class="fas fa-folder-open"></i> Projects </h5>
                                    <div class="header-line-2"></div>
                                    @foreach ($projects as $item)
                                    <div class="project-container">
                                        <div class="project-img">
                                            {{-- <img class="app-logo" src="{{ asset('public/images/' . $item->logo) }}"> --}}
                                            <img class="app-logo" src="{{ asset('pictures/'.($item->logo ? $item->logo : 'pic.png')) }}"  />
                                        </div>
                                        <div class="card-content">
                                            <h4 class="project-title">{{ $item->title }}</h4>
                                            <div class="project-subtitle">
                                                <p>{{ $item->description }}</p>
                                                <p style="font-size: 12px; color: #666;">Developed by
                                                    {{ auth('student')->user()->first_name }}
                                                    {{ auth('student')->user()->last_name }}</p>
                                                    <p style="font-size: 12px; color: #666;">Group: 
                                                        {{ auth('student')->user()->group_name }}
                                                      </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        @endsection
