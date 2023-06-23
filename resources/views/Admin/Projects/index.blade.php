<!-- @extends('layouts.admin') -->

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
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .img-card {
        border-radius: 18px;
        background: #fff;
        padding: 18px 12px 42px 14px;
        margin: 0 0 28px 0; /* modified */
        width: fit-content, calc(33.33% - 40px);
        transition: .3s ease;
    }

    .img-card:hover {
        background: #fff;
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
    }

    .app-logo {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border: 1px solid;
    padding: 5px;
    border-radius: 999px;
    border-color: #c4bfbf;
    transition: .3s ease;
    
    }


    .app-logo:hover {
        transform: scale(1.2) rotate(22deg);
    }
    .img-card .app-logo {
        transition: .3s ease;
        width: 72px;
        border-radius: 999px;
        padding: 10px;
        
    }

    .img-card .name {
    /* existing rules */
    font-size: 18px;
    margin-bottom: 8px;
    }

    .name {
        font-weight: 900;
        position: relative;
        margin-top: -64px;
        font-size: 14px;
        margin-left: 84px;
        margin-right: 36px;
    }

    .img-card .description {
    font-size: 16px;
    color: #3f3f3f;
    margin-left: 84px;
    margin-bottom: 8px;
    }

        .img-card .group {
    font-size: 14px;
    color: #777;
    margin-left: 84px;
    margin-bottom: 8px;
    }


    .img-card .developer {
    font-size: 14px;
    color: #777;
    margin-left: 84px;
    }

</style>

@section('content')
<div class="container-fluid">
  <div class="live-preview">
    <div>
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="header mt-2"><i class="fas fa-users"></i> Projects
              <span class="badge badge-secondary"><span style="font-weight: 300; color: #bfbfbf;">List of projects</span></span>
            </h5>
          </div>
          <div class="header-line"></div>
        </div>
      </div>
        <div class="row cards-container">
            @foreach ($projects as $item)
                <div class="col-md-4 col-lg-3">
                    <div class="img-card">
                    {{-- <img class="app-logo" src="{{ asset('public/images/' . $item->logo) }}"> --}}
                        <img class="app-logo" src="{{ asset('pictures/'.($item->logo ? $item->logo : 'pic.png')) }}"  />
                        <div class="name">{{ $item->title }}</div>
                        <div class="description">{{ $item->description }}</div>
                        <div class="group"><b>Developed by {{ $item->group_name }}</b></div>
                        <div class="developer">{{ $item->user?->first_name }} {{ $item->user?->last_name }}</div>
                        <a href="#" class="stretched-link"></a>
                    </div>       
                </div>
            @endforeach
        </div>
    </div>
  </div>
</div>

@endsection
