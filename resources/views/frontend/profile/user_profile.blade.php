@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
             @include('frontend.common.user_sidebar')
            {{-- end col --}}
            <div class="col-md-2"></div>
            {{-- end col --}}
            <div class="col-md-6">
                <div class="card">
                    <h3 class='text-center'><span class='text-danger'>Hi..</span> <strong>{{Auth::user()->name}}</strong> Update Your Profile</h3>
                    <div class="card-body">
                        <form action="{{route('user.profile.store')}}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Name<span></span></label>
                                <input type="text" name='name' value='{{$user->name}}' class="form-control unicase-form-control text-input">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address<span></span></label>
                                <input type="email" name='email' value='{{$user->email}}' class="form-control unicase-form-control text-input">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Phone Number<span></span></label>
                                <input type="text" name='phone' value='{{$user->phone}}' class="form-control unicase-form-control text-input">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">User Image<span></span></label>
                                <input type="file" name='profile_photo_path' value='{{$user->phone}}' class="form-control unicase-form-control text-input">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- end col --}}
        </div>  
        {{-- end row --}}
    </div>
</div>

@endsection