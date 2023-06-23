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

    .header i {
        margin-right: 10px;
        /* adjust this value to increase/decrease the space */
    }

    .header-line {
        height: 1px;
        background-color: #bfbfbf;
        margin-bottom: 10px;
    }

    .back-btn {
        /* margin-bottom: 20px; */
    }

    .advisee-card {
        border-radius: 18px;
        background: #fff;
        padding: 18px 12px 42px 14px;
        margin: 0 0 28px 0;
        /* modified */
        width: fit-content, calc(33.33% - 40px);
        transition: .3s ease;
        border: 1px solid #bfbfbf;
        margin-top: 20px;
    }

    .advisee-card:hover {
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
        font-weight: 900;
        position: relative;
        margin-top: -64px;
        font-size: 14px;
        margin-left: 84px;
        margin-right: 36px;
    }

    .advisee-card .name {
        /* existing rules */
        font-size: 18px;
        margin-bottom: 8px;
    }

    .advisee-card .adv-role {
        font-size: 16px;
        color: #3f3f3f;
        margin-left: 84px;
        margin-bottom: 8px;
    }

    .advisee-card .email {
      font-size: 14px;
      color: #777;
      margin-left: 84px;
    }

    .advisee-card .group {
        font-size: 15px;
        font-weight: 500;
        color:#25272a;
        margin-left: 84px;
        margin-right: 20px;
        margin-bottom: 8px;
    }


    .advisee-card .avatar {
        border-radius: 999px;
        width: 72px;
        padding: 10px;
    }

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
        margin-bottom: 20px;
        float: left;
        /* add this */
        margin-right: 40px;
        /* add this */
        margin-left: 20px;
    }

    .profile-userpic img {
        object-fit: cover;
        float: none;
        margin: 0 auto;
        width: 150px;
        height: 150px;
        border-radius: 999px;
        align-items: center;
        border-color: #ff6600 !important;
        border-width: 3px;
        /* add this to set the border width */
        border-style: solid;
        /* add this to set the border style */
    }


    .profile-usertitle {
        margin-top: 20px;
        overflow: hidden;
        /* add this */

    }

    .profile-usertitle-name {
        margin-top: 10px;
        color: #212529;
        font-size: 36px;
        font-weight: 900;
        margin-bottom: 7px;
        white-space: nowrap;
        /* add this */
        overflow: hidden;
        /* add this */
        text-overflow: ellipsis;
        /* add this */
    }

    .profile-usertitle-email {
        font-size: 20px;
        color: #777;
    }

    /* advisee */

    .advisee {
        margin: 20px 0;
    }

    /* advisee sidebar */
    .advisee-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
        border-radius: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        /* add this */
        flex-direction: column;
        /* add this */
    }


    /* advisee Content */
    .advisee-content {
        padding: 20px;
        background: #fff;
        border-radius: 18px;
        height: auto;
    }

    .advisee-project-head {
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

    .card-content {
        text-align: left;
        overflow: hidden;
        /* add this */
        flex-grow: 1;
    }

    /* graph */

    .advisee-head {
        color: #f06548;
        font-size: 24px;
        font-weight: 600;
        position: absolute;
        /* add this */
        top: 0;
        left: 0;
        right: 0;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .circle-graph {
        width: 11.25rem;
        height: 11.25rem;
        border-radius: 50%;
        background-color: #8a8a8a;
        position: relative;
        margin-top: 50px;
        margin-bottom: 20px;
        /* remove margin-top */
    }

    .circle-graph.gt-50 {
        background-color: #f06548;
    }

    .circle-graph-progress {
        content: "";
        position: absolute;
        border-radius: 50%;
        left: calc(50% - 5.625rem);
        top: calc(50% - 5.625rem);
        width: 11.25rem;
        height: 11.25rem;
        /* clip: rect(0, 11.25rem, 11.25rem, 5.625rem); */
        clip: rect(0, 0, 0, 0);
        /* add this */
    }

    .circle-graph-progress .circle-graph-progress-fill {
        content: "";
        position: absolute;
        border-radius: 50%;
        left: calc(50% - 5.625rem);
        top: calc(50% - 5.625rem);
        width: 11.25rem;
        height: 11.25rem;
        clip: rect(0, 5.625rem, 11.25rem, 0);
        background: #f06548;
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg);
    }

    .gt-50 .circle-graph-progress {
        clip: rect(0, 5.625rem, 11.25rem, 0);
    }

    .gt-50 .circle-graph-progress .circle-graph-progress-fill {
        clip: rect(0, 11.25rem, 11.25rem, 5.625rem);
        background: #8a8a8a;
    }

    .circle-graph-percents {
        content: "";
        position: absolute;
        border-radius: 50%;
        left: calc(50% - 7.75862rem/2);
        top: calc(50% - 7.75862rem/2);
        width: 7.75862rem;
        height: 7.75862rem;
        background: #e6e6e6;
        text-align: center;
        display: table;
        z-index: 4;
    }

    .circle-graph-percents .circle-graph-percents-number {
        display: block;
        font-size: 2.5rem;
        font-weight: bold;
        color: #f06548;
    }

    .circle-graph-percents .circle-graph-percents-units {
        display: block;
        font-size: 1rem;
        font-weight: bold;
    }

    .circle-graph-percents-wrapper {
        display: table-cell;
        vertical-align: middle;
        line-height: 0;
    }

    .circle-graph-percents-wrapper span {
        line-height: 1;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="modal-header row align-items-center">
            <div class="col">
                <a href="{{ route('adviser') }}">
                    <button type="button" class="btn back-btn btn-outline-danger">Back</button>
                </a>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="header mt-2"><i class="fas fa-user"></i> Adviser Profile </h5>
                </div>
                <div class="header-line"></div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row profile">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        {{-- <img src="{{ asset('images/dp.png') }}" class="img-responsive" alt=""> --}}
                        <img class="img-responsive"
                            src="{{ asset('pictures/' . ($adviser->photo ? $adviser->photo : 'pic.png')) }}" />
                    </div>
                    <div class="profile-usertitle">
                        <div>
                            <h5 class="profile-usertitle-name">{{ $adviser->first_name }}
                                {{ $adviser->last_name }}</h5>
                        </div>
                        <div>
                            <h6 class="profile-usertitle-email"><strong>Email:</strong>
                                {{ $adviser->email }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row advisee">
                <div class="col-md-3">
                    <div class="advisee-sidebar">
                        <div class="advisee-head">
                            <h5>Slots taken under your Advisory</h5>
                        </div>

                        <div class="circle-graph" data-circle-graph data-percent="{{ $studentsCount * 10 }}">
                            <div class="circle-graph-progress">
                                <div class="circle-graph-progress-fill"></div>
                            </div>
                            <div class="circle-graph-percents">
                                <div class="circle-graph-percents-wrapper">
                                    <span class="circle-graph-percents-number">{{ $studentsCount }}</span>
                                    <span class="circle-graph-percents-units">of 10</span>
                                </div>
                            </div>
                        </div>
                        @push('scripts')
                            <script>
                                // Fetch students count and update the circle graph
                                function fetchStudentsCount() {
                                    $.ajax({
                                        url: "{{ route('adviser.students.count', $adviser->id) }}",
                                        method: 'GET',
                                        success: function(response) {
                                            var studentsCount = response.count;
                                            var circleGraph = $('[data-circle-graph]');
                                            var studentsCountElement = $('#studentsCount');

                                            studentsCountElement.text(studentsCount);
                                            var percentage = (studentsCount / 10) * 100;
                                            circleGraph.attr('data-percent', percentage);
                                        }
                                    });
                                }

                                // Fetch students count when the page loads
                                $(document).ready(function() {
                                    fetchStudentsCount();
                                });
                            </script>
                        @endpush
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="advisee-content">
                        <div class="advisee-project-details">
                            <h5 class="advisee-project-head"><i class="fas fa-users"></i> List of Advisee</h5>
                            <div class="header-line"></div>
                            <div class="row cards-container">
                                @foreach ($students as $item)
                                <div class="col-md-6 col-lg-6 mb-4">
                                    {{-- <a href="{{ route('view_advisee', $item->id) }}"> --}}
                                        <div class="advisee-card">
                                            {{-- <img class="avatar" src="{{ asset('images/' . $item->photo) }}"
                                                alt="Avatar" /> --}}
                                                <img class="avatar" src="{{ asset('pictures/'.($item->photo ? $item->photo : 'pic.png')) }}"  />
                                            <div class="name">{{ $item->first_name }} {{ $item->last_name }}</div>
                                            <div class="group">Group: <b>{{$item->group_name}}</b></div>  
                                            <div class="email">{{ $item->email }}</div>
                                        </div>
                                    
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
