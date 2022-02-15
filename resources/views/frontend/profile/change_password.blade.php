@extends('frontend.main_master')
@section('content')
{{-- @php
$user = DB::table('users')->where('id', Atuh::user()->id)->first();
@endphp --}}
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.profile.user_profile')
            {{-- end col --}}
            <div class="col-md-2"></div>
            {{-- end col --}}
            <div class="col-md-6">
                <div class="card">
                    <h3 class='text-center'><span class='text-danger'>Change Your Password</h3>
                    <div class="card-body">
                        <form action="{{route('user.password.update')}}" method='POST'>
                            @csrf
                            <div class="form-group">
                                <h5>Current Password <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" id="current_password" name="oldpassword" class="form-control" required="" data-validation-required-message="This field is required"></div>
                            </div>

                            <div class="form-group">
                                <h5>New Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"></div>
                            </div>
                            <div class="form-group">
                                <h5>Confirm Password<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type='password' id="password_confirmation" type="password_confirmation" name="password_confirmation" class="form-control" required="" data-validation-required-message="This field is required"></div>
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