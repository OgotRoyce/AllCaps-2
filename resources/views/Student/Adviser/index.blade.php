@extends('layouts.student')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>

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
        margin-bottom: 10px;
    }

    :root {
        --bg-clr: #d97b9d;
        --primary: #ff6600;
        --white: #fff;
        --text-clr: #1a1819;
        --sub-text-clr: #c6c6c6;
        --sub-bg-clr: #f7f5fa;
        --btn-hover-clr: #f06548;
        --border-clr: #eaeaea;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;

    }

    body {
        background: #fff;
        font-size: 14px;
    }

    .wrapper {
        height: 100vh;
        display: flex;
        /* justify-content: center; */
        align-items: center;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .wrapper-fluid {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .user_select_wrap {
        background: #e8e8ed;
        /* max-width: 750px; */
        width: 100%;
        /* change this from "fit-content, calc(33.33% - 40px)" to "100%" */
        padding: 18px 12px 42px 14px;
        border-radius: 18px;
        margin-top: 20px;
        transition: .3s ease;
        margin: 0 0 28px 0;
        /* modified */
        margin-left: auto;
        /* add this to center the wrapper horizontally */
        margin-right: auto;
        /* add this to center the wrapper horizontally */
    }



    .user_select_wrap .title p {
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        color: #3f3f3f;
        margin-bottom: 20px;
        margin-top: 20px;
    }

    .user_select {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .user_item {
        display: flex;
    flex-direction: column;
    justify-content: space-between;
        border-radius: 18px;
        background: #fff;
        padding: 14px 12px 10px 14px;
        margin: 0 0 28px 0;
        /* modified */
        width: fit-content, calc(33.33% - 40px);
        transition: .3s ease;
        margin-right: 20px;
        /* added */
    }

    .user_item input {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: block;
        cursor: pointer
    }

    .user_item .info {
        display: flex;
        align-items: center;
    }

    .user_item .info .name-role {
        display: flex;
        flex-direction: column;
        margin-left: 10px;
    }

    .user_item .info .name-role .name {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: -1px;
        color:#1a1819;
    }

    .user_item .info .name-role .role {
        color: var(--sub-text-clr);
        font-size: 18px;
    }

    .user_item .info .name-role .count {
        color: #1a1819;
        font-size: 14px;
    }

    .user_item .info img {
        margin-right: 5px;
        border-radius: 50%;
    }

    .user_item .checkmark {
        opacity: 0;
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        background: var(--primary);
        border-radius: 50%;
        transition: 0.5s ease;
        cursor: pointer;

    }

    .user_item .checkmark:before {
        content: "";
        position: absolute;
        top: 6px;
        left: 5px;
        width: 6px;
        height: 2px;
        border: 2px solid;
        border-color: transparent transparent var(--white) var(--white);
        transform: rotate(-45deg);

    }

    .user_select_wrap button {
        border: 0;
        background: var(--primary);
        color: var(--white);
        margin-top: 20px;
        border-radius: 3px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.5s ease;
        margin-left: auto;
    }

    .user_select_wrap button:hover {
        background: var(--btn-hover-clr);
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        transform: scale(1.01); */
    }

    .user_item.active {
        background: var(--white);
        box-shadow: 0 0 6px 2px rgba(0, 0, 0, .1);
        border-color: #ff6600 !important;
        border-width: 2px;
        /* add this to set the border width */
        border-style: solid;
        /* add this to set the border style */
    }

    .user_item.active input:checked~.checkmark {
        opacity: 1;
    }

    .avatar {
        transition: .3s ease;
        width: 72px;
        height: 72px;
        object-fit: cover;
    }

    .avatar:hover {
        transform: scale(1.2) rotate(22deg);
    }


    .user_item:hover {
        background: #fff;
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
    }

    .adviser-content {
        padding: 20px;
        background: #fff;
        border-radius: 18px;
        height: auto;
        margin-bottom: 20px;
    }

    .adviser-advdetails-head {
        color: #f06548;
        font-size: 30px;
        font-weight: 600;
        font-size: 30px;
        margin-bottom: 10px;
        margin-left: 20px;
    }

    .advdetails-container {
        margin-top: 10px;
        margin-left: 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .advdetails-container-2 {
        margin-top: 10px;
        margin-left: 20px;
        flex-direction: row;
        align-items: center;
    }

    
    .advdetails-img {
        margin-right: 20px;
    }

    .adv-thumbnail {
        height: 100px;
        width: 100px;
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
        margin-top: 20px;
        margin-bottom: 20px;
    }

    /* .adviser-advdetails-details {
    display: flex;
    flex-direction: column;
    } */

    .advdetails-title {
        margin-top: 0px;
        font-weight: 700;
        font-size: 24px !important;
    }

    .advdetails-title a {
        color: #000;
        text-decoration: none !important;
    }

    .advdetails-title a:hover {
        color: #f06548;
        text-decoration: none !important;
    }

    .advdetails-subtitle .adv-program{
        font-size: 18px;
        color: #424242;
        margin-top: 1px;
        margin-bottom: 5px;
    }

    .advdetails-subtitle .adv-email{
        font-size: 14px;
        color: #999;
        margin-top: 5px;
        margin-bottom: 0;
    }

    .no-application {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

    .no-application h1 {
        font-size: 60px;
        margin-bottom: 20px;
        font-style: italic;
    }

    .no-application h3 {
        font-size: 24px;
    }

</style>
@section('content')
    <div class="container-fluid">
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-users"></i> Adviser
                            {{-- <span class="badge badge-secondary"><span style="font-weight: 300; color: #bfbfbf;">List of
                                    advisers</span> --}}
                        </h5>
                    </div>
                    <div class="header-line"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="live-preview container-fluid">
                    <div class="adviser-content">
                        <h5 class="adviser-advdetails-head"><i class="fas fa-user"></i> My Adviser </h5>
                        <div class="header-line"></div>
                        @if ($myadviser && $myadviser->id == auth('student')->user()->adviser_id && auth('student')->user()->status == 'accepted')
                        
                        <div class="advdetails-container"> 
                            <div class="advdetails-img">
                                {{-- @if ($item->logo) --}}
                                    {{-- <img class="app-logo" src="{{ asset('public/images/' . $item->logo) }}"> --}}
                                    {{-- <img class="app-logo" src="{{ asset('pictures/'.($item->logo ? $item->logo : 'pic.png')) }}"  />
                                @else --}}
                                {{-- <img class="adv-thumbnail" src="{{ asset('/images/no_image.jpg') }}"> --}}
                                {{-- @endif --}}
                                <img class="adv-thumbnail" src="{{ asset('pictures/'.($myadviser->photo ? $myadviser->photo : 'pic.png')) }}"  />
                            </div>
                            <div class="card-content">
                                <h4 class="advdetails-title">{{$myadviser->first_name}} {{$myadviser->last_name}}</h4>
                                <div class="advdetails-subtitle">
                                    <p class="adv-program">{{$myadviser->program}}</p>
                                    <p class="adv-email">{{$myadviser->email}}</b>
                                        <p class="adv-email text-success">Accepted</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @elseif ($myadviser && $myadviser->id == auth('student')->user()->adviser_id && auth('student')->user()->status == 'pending')

                        <div class="advdetails-container"> 
                            <div class="advdetails-img">
                                {{-- @if ($item->logo) --}}
                                    {{-- <img class="app-logo" src="{{ asset('public/images/' . $item->logo) }}"> --}}
                                    {{-- <img class="app-logo" src="{{ asset('pictures/'.($item->logo ? $item->logo : 'pic.png')) }}"  />
                                @else --}}
                                {{-- <img class="adv-thumbnail" src="{{ asset('/images/no_image.jpg') }}"> --}}
                                {{-- @endif --}}
                                <img class="adv-thumbnail" src="{{ asset('pictures/'.($myadviser->photo ? $myadviser->photo : 'pic.png')) }}"  />
                            </div>
                            <div class="card-content">
                                <h4 class="advdetails-title">{{$myadviser->first_name}} {{$myadviser->last_name}}</h4>
                                <div class="advdetails-subtitle">
                                    <p class="adv-program">{{$myadviser->program}}</p>
                                    <p class="adv-email">{{$myadviser->email}}</b>
                                        <p class="adv-email text-warning">Waiting for approval</b>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @elseif ($myadviser && $myadviser->id == auth('student')->user()->adviser_id && auth('student')->user()->status == 'declined')

                        <div class="advdetails-container-2">
                            <div class="no-application">
                                <h1 class="text-center"><b>Sorry...</b></h1>
                                <h3 class="text-subtitle">You request was declined.</h3>
                                <p>Select one from the advisers below.</p>
                            </div>
                        </div>

                        @else

                    <div class="advdetails-container-2">
                        <div class="no-application">
                            <h1 class="text-center"><b>Oops...</b></h1>
                            <h3 class="text-subtitle">You don't have an Adviser yet.</h3>
                            <p>Select one from the advisers below.</p>
                        </div>
                    </div>
                @endif

                    </div>
        </div>
    </div>

    <div class="wrapper-fluid">

        @if (auth('student')->user()->adviser_id && auth('student')->user()->status != 'accepted' )

        <div class="user_select">
            @foreach ($advisers as $item)
                <div class="col-md-4 col-lg-3">
                    <div class="user_item">
                        <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation('{{ $item->id }}')">
                            <span class="checkmark"></span>
                            <div class="info">
                                <img class="avatar" src="{{ asset('pictures/' . ($item->photo ? $item->photo : 'pic.png')) }}" />
                                <div class="name-role">
                                    <p class="name">{{ $item->first_name }} {{ $item->last_name }}</p>
                                    <p class="role">{{ $item->program }}</p>
                                    <p class="count">Advisees: <b><span style="color: #f39100;">{{ $item->counter }}/10</span></b></p>
                                </div>
                            </div>
                        </a>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('choose_adviser', $item->id) }}" method="POST" class="d-none">
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @endif

        @if (auth('student')->user()->adviser_id )

        @else
            <div class="user_select_wrap">
                <div class="title">
                    <p>Select your Project Adviser</p>
                </div> 
                
                <div class="user_select">
                    @foreach ($advisers as $item)
                        <div class="col-md-4 col-lg-3">
                            <div class="user_item">
                                <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation('{{ $item->id }}')">
                                    <span class="checkmark"></span>
                                    <div class="info">
                                        <img class="avatar" src="{{ asset('pictures/' . ($item->photo ? $item->photo : 'pic.png')) }}" />
                                        <div class="name-role">
                                            <p class="name">{{ $item->first_name }} {{ $item->last_name }}</p>
                                            <p class="role">{{ $item->program }}</p>
                                            <p class="count">Advisees: <b><span style="color: #f39100;">{{ $item->counter }}/10</span></b></p>
                                        </div>
                                    </div>
                                </a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('choose_adviser', $item->id) }}" method="POST" class="d-none">
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
 

            <script>
                function DeleteTaskConfirmation(taskId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you want to select this adviser?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + taskId).submit();
                        }
                    });
                }
            </script>

        </div>
    </div>
@endsection
<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var user_items = document.querySelectorAll(".user_item");
        var selected_item;
        user_items.forEach(function(item) {
            item.addEventListener("click", function() {
                if (selected_item != null) {
                    // unselect previously selected item
                    selected_item.classList.remove("active");
                    selected_item.children[0].checked = false;
                }
                // select new item and update selected_item variable
                item.classList.add("active");
                item.children[0].checked = true;
                selected_item = item;
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var user_items = $(".user_item");
        var selected_item;

        user_items.on("click", function() {
            if (selected_item != null) {
                // Unselect previously selected item
                selected_item.removeClass("active");
                selected_item.children("input").prop("checked", false);
            }

            // Select new item and update selected_item variable
            $(this).addClass("active");
            $(this).children("input").prop("checked", true);
            selected_item = $(this);
        });

        $("#choose-adviser-btn").on("click", function() {
            // Get the selected advisers
            var selectedAdvisers = $(".user_item.active");
            // Check if at least one adviser is selected
            if (selectedAdvisers.length > 0) {
                // Show confirmation dialog
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'Do you want to select this adviser?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, show success message
                        $.ajax({
                                url: '/student/student_adviser/update_adviser',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    adviser_id:
                                }
                            })
                            .done(function() {

                            })
                            .fail(function() {

                            })
                        Swal.fire({
                            icon: 'success',
                            title: 'Adviser selected!',
                            text: 'You have successfully selected your adviser.'
                        });
                    }
                });
            } else {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'No adviser selected!',
                    text: 'Please select one adviser.'
                });
            }
        });
    });
</script>
