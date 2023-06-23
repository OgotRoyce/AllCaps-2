@extends('layouts.admin')
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

<style>
.header {
  font-family: 'Poppins', sans-serif;
  font-size: 32px;
  color: #f06548;
  display: flex; /* add this to enable flexbox */
  align-items: center; /* add this to center items vertically */
}

.header i {
  margin-right: 10px; /* adjust this value to increase/decrease the space */
}

.header-line {
  height: 1px;
  background-color: #bfbfbf;
  margin-bottom: 20px;
}

    .cards-container {
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        flex-direction: row;
    }

    .profile-card {
        position: relative;
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
        height: 72px;
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
    
.profile-card .name {
  /* existing rules */
  font-size: 18px;
  margin-bottom: 8px;
  color:#2c2a29;
}
.profile-card .adv-role {
  font-size: 16px;
  color: #3f3f3f;
  margin-left: 84px;
  margin-bottom: 8px;
}

.profile-card .email {
  font-size: 14px;
  color: #777;
  margin-left: 84px;
  max-width: 210px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.profile-card .avatar {
  border-radius: 999px;
  width: 72px;
  padding: 10px;
}

.right-content {
    position: absolute;
    top: 0;
    right: 0;
    padding: 20px;
}

.right-content i {
    font-size: 16px;
}


</style>


@section('content')
<!-- <div class="container">
<div class="live-preview">
<div>
<div class="row">
    <div class="col-lg-12">
    <div class="row">
            <div class="col-10">
                <h5 class="header mt-2">Adviser</h5> 
            </div>
            <div class="col-2">
        <a href="{{ route('create_adviser') }}">
            <button type="button" style="width:100%" class="btn btn-primary">
                + Add Adviser
            </button>
        </a>

        </div>
    </div> -->


    <div class="container-fluid">
        <div class="live-preview">
        <div class="row">
            <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                    <h5 class="header mt-2"><i class="fas fa-users"></i> Advisers 
                    <span class="badge badge-secondary"><span style="font-weight: 300; color: #bfbfbf;">({{ count($adviser) }} Advisers)</span>
                </h5>

                    <a href="{{ route('create_adviser') }}">
                <button type="button" style="width:100%" class="btn btn-outline-danger float-right">+ Add Adviser</button>
                </a>
            </div>
                <div class="header-line"></div>
            </div>
            </div>
        </div>
    </div>


    <div class="row cards-container">
        @foreach ($adviser as $item)
            <div class="col-md-4 col-lg-3">
                <div class="profile-card">
                {{-- <img class="avatar" src="{{ asset('images/pic.png') }}" alt="Avatar" /> --}}
                <a href="{{ route('view_adviser', $item->id) }}" >
                <img class="avatar" src="{{ asset('pictures/'.($item->photo ? $item->photo : 'pic.png')) }}"  />
                    <div class="name">{{ $item->first_name }} {{ $item->last_name }}</div>
                </a>
                    <div class="adv-role">{{ $item->program }}</div>
                    <div class="email">{{ $item->email }}</div>


                    <div class="right-content">  

                        {{-- <i class="accordion-img fas fa-pencil-alt" style="color: rgb(48, 133, 214)" data-bs-target="#exampleModalToggle-{{$item->id}}" data-bs-toggle="modal"></i> --}}
                
                        <a class="delete-button" onclick="event.preventDefault(); DeleteTaskConfirmation('{{ $item->id }}')">
                        <i class="accordion-img fas fa-trash"  style="color: #8a8a8a" ></i>
                        </a>             
                            <form id="delete-form-{{ $item->id }}" action="{{ route('delete_adviser',$item->id) }}" method="POST" class="d-none">
                                {!! csrf_field() !!}
                                @method('DELETE')
                            </form>
                 
                    </div>
                    
                </div>
                
            </div>
      @endforeach

    </div>
        <!-- Button trigger modal -->
</div>
<!-- end row -->
</div>
</div>
</div>

<script>
    function DeleteTaskConfirmation(adviserID) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this adviser!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-'+adviserID).submit();
            }
        });
    }
</script>

@endsection
