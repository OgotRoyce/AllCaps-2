@extends('layouts.student')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ route('profile') }}">
                <button type="button" class="btn btn-outline-danger" >Back</button>
            </a>
            <img class="card-img" src="{{ asset('images/dp.png') }}" style="display:block; margin-right:auto; margin-left:auto; width: 100px">

            <form action="{{route('profile-update',$profile->customer_id)}}" method="post">
                {!! csrf_field() !!}
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">First Name:</label>
                    <input type="text" value="{{$profile->first_name}}" name="first_name" class="form-control">

                <div class="mb-3">
                    <label class="form-label">Last Name:</label>
                    <input type="text" value="{{$profile->last_name}}" name="last_name" class="form-control">
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Mobile Number:</label>
                    <input type="number" value="{{$profile->mobile_number}}" name="mobile_number" class="form-control">
                </div> -->

                <fieldset disabled="disabled">
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">Email:</label>
                        <input type="email" value="{{$profile->email}}" name="email" id="disabledTextInput" class="form-control">
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
