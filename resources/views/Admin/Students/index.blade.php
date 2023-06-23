@extends('layouts.admin')

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

    .btn-primary {
        background-color: #f06548;
    }

    .btn i {
        border-radius: 50%;
        padding: 6px;
    }

    .square-btn {
        width: 35px;
        height: 35px;
        padding: 0 !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .square-btn i {
        font-size: 16px;
        line-height: 1;
    }

    .d-flex>.d-inline-block:first-child {
        margin-right: 5px;
    }

    .d-flex>.d-inline-block:last-child {
        margin-left: 5px;
    }

    .my-btn {
        background-color: #e9ebec !important;
        border-color: #e9ebec !important;
    }

    .my-btn i {
        color: #424242;
    }

    /* search input */
    #accordion_search_bar_container {
    position: relative;
        /* &:after { 
            content: '\e003';
            font-family: Glyphicons Halflings;
            width: 18px;
            height: 18px;
            position: absolute;
            right: 10px;
            bottom: 10px; 
        }   */

        #accordion_search_bar {
            display: block;
            margin: 10px auto;
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #c4bfbf;
            border-radius: 25px;
            outline: 0;
        }
    }


    .cards-container {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .profile-card {
        border-radius: 18px;
        background: #fff;
        padding: 18px 12px 42px 14px;
        margin: 0 0 28px 0; /* modified */
        width: fit-content, calc(33.33% - 40px);
        transition: .3s ease;
    }

    .profile-card:hover {
        background: #fff;
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
    }

    .avatar {
        transition: .3s ease;
        width: 72px;
        object-fit: cover;
    }

    .avatar:hover {
        transform: scale(1.2) rotate(22deg);
    }

    .name {
        color: #25272a;
        font-weight: 900;
        position: relative;
        margin-top: -64px;
        font-size: 14px;
        margin-left: 84px;
        margin-right: 36px;
        max-width: 210px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
    }

    .profile-card .name {
        /* existing rules */
        font-size: 18px;
        margin-bottom: 8px;
    }

    .profile-card .group {
        font-size: 15px;
        font-weight: 500;
        color:#25272a;
        margin-left: 84px;
        margin-right: 20px;
        margin-bottom: 8px;
    }

    .profile-card .email {
        font-size: 12px;
        color: #777;
        margin-left: 84px;
        margin-right: 20px;
    }

    .profile-card .avatar {
        border-radius: 999px;
        width: 72px;
        padding: 10px;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="live-preview">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="header mt-2"><i class="fas fa-users"></i> Students
                            <span class="badge badge-secondary"><span style="font-weight: 300; color: #bfbfbf;">List of
                                    students</span>
                        </h5>
                            {{-- <a href="{{ route('create_student') }}">
                              <button type="button" style="width:100%" class="btn btn-outline-danger float-right">+ Add Student</button>
                            </a> --}}
                    </div>
                    <div class="header-line"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="accordion_search_bar_container">
      <input type="search" 
         id="accordion_search_bar" 
         placeholder="Search"/>
         <div style="position: absolute; right: 10px; top: 10px;"><i class="fas fa-search"></i></div>

  </div>
    
    <div class="row cards-container">
    @php
        $sorted_students = $students->sortBy('last_name')->values()->all();
    @endphp
    @foreach ($sorted_students as $item)
        <div class="col-md-4 col-lg-3">
            <a href="{{ route('view_student', $item->id) }}">
            <div class="profile-card">
                {{-- <img class="avatar" src="{{ asset('images/pic.png') }}" alt="Avatar" /> --}}
                <img class="avatar" src="{{ asset('pictures/'.($item->photo ? $item->photo : 'pic.png')) }}"  />

                <div class="name">{{ $item->last_name }}, {{ $item->first_name }}</div>
                <div class="group"><b>Group:</b> {{ $item->group_name }}</div>
                <div class="email">{{ $item->email }}</div>
            </div>
        </a>
        </div>
    @endforeach
</div>

    </div>
    

    <!-- ./ cards-container -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#accordion_search_bar').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.profile-card').filter(function() {
                var match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) {
                    $(this).prependTo('.cards-container');
                }
            });
        });
    });
</script>


