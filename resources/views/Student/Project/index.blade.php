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

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        border-radius: 18px;
        height: auto;
    }

    .profile-content:hover {
        background: #fff;
        cursor: pointer;
        box-shadow: -2px 3px 12px #d1d1d1;
        transform: scale(1.02);
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
        margin-top: 10px;
        margin-left: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .project-img {
        margin-right: 20px;
    }

    .app-logo {
        max-height: 100px;
        object-fit: cover;
        border-radius: 999px;
        border-color: #c4bfbf !important;
        border: 1px solid;
    }

    .card-content {
        text-align: left;
        overflow: hidden;
        /* add this */
        flex-grow: 1;
    }

    /* .profile-project-details {
    display: flex;
    flex-direction: column;
    } */

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
        margin-bottom: 0;
    }

    /* styles for 404 */

    .page_404 {
        padding: 40px 0;
        background: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .page_404 img {
        width: 100%;
    }

    .four_zero_four_bg {
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 400px;
        background-position: center;

    }

    #create-project-btn {
        margin-top: 20px;
    }

    .four_zero_four_bg h1 {
        font-size: 80px;

    }

    .four_zero_four_bg h3 {
        font-size: 80px;
    }

    .link_404 {
        color: #fff !important;
        padding: 10px 20px;
        background: #39ac31;
        margin: 20px 0;
        display: inline-block;
    }

    .contant_box_404 {
        margin-top: -50px;
    }
</style>

@section('content')
    {{-- <div class="container-fluid">
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-folder-open"></i> My Projects </h5>
                    </div>

                    <div class="header-line"></div>
                    <div>
                    </div>
                </div>
            </div> --}}



    <div class="container-fluid">
        <div class="live-preview">
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="header mt-2"><i class="fas fa-folder-open"></i>My Projects </h5>
                @if (count($projects) == 0)
                  <a href="{{ route('create_project') }}">
                    <button type="button" class="btn btn-outline-danger float-right">+ Add Project</button>
                  </a>
                @else
                  <button type="button" class="btn btn-outline-danger float-right" disabled>+ Add Project</button>
                @endif
              </div>
              <div class="header-line"></div>
            </div>
          </div>
        </div>
      </div>
    @if (count($projects) == 0)
        <!-- display custom 404 page -->

        <body>
            <section class="page_404">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="col-sm-10 col-sm-offset-1  text-center">
                                <div class="four_zero_four_bg">
                                    <h1 class="text-center "><b>Oops...</b></h1>
                                </div>

                                <div class="contant_box_404">
                                    <h3 class="h2">Looks like you don't have a project yet.</h3>
                                    <!-- <p>The project you are looking for is not available! Create one.</p> -->
                                    <a href="{{ route('create_project') }}" id="create-project-btn"
                                        class="btn btn-danger">Create A Project</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </body>
    @else
        @foreach ($projects as $item)
            <div class="">
                <div class="live-preview container-fluid">
                    <div>
                        <a href="#">
                            <div class="profile-content">
                                <div class="profile-project-details">
                                    <div class="project-container">
                                        <div class="project-img">
                                            @if ($item->logo)
                                                {{-- <img class="app-logo" src="{{ asset('public/images/' . $item->logo) }}"> --}}
                                                <img class="app-logo" src="{{ asset('pictures/'.($item->logo ? $item->logo : 'pic.png')) }}"  />
                                            @else
                                                <img src="{{ asset('public/images/no_image.jpg') }}"
                                                    class="img-thumbnail default">
                                            @endif
                                        </div>
                                        <div class="card-content">
                                            <h4 class="project-title">{{ $item->title }}</h4>
                                            <div class="project-subtitle">
                                                <p>{{ $item->description }}</p>
                                                <p style="font-size: 12px; color: #666;">Developed by
                                                    {{ auth('student')->user()->first_name }}
                                                    {{ auth('student')->user()->last_name }}, <b>{{ $item->group_name }}</b>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        
    @endif
@endsection
