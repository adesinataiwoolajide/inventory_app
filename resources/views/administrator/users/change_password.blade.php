@extends('layouts.app')

@section('content')
    
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>

                    <li class="breadcrumb-item">
                        <a href="{{route('change.pasword')}}">Change Password</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('user.profile')}}">My Profile</a>
                    </li>
                   
                    <li class="breadcrumb-item active" aria-current="page">User Profile </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>{{$use->name}} Please Change Your Password Below</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('update.password', $use->user_id)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="form-group row ">
                                <div class="col-sm-4">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required 
                                    placeholder="Enter The Full Name" value="{{$use->name}}">
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('name') }} !</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-sm-4">
                                    <label>Password</label>
                                    <input type="password" name="password" required placeholder="Please Enter The Password" 
                                    class="form-control form-control-rounded"
                                    required>
                                    
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('password') }} !</span>
                                            </div>
                                        </div>
                                    @endif  
                                </div>
                                <div class="col-sm-4">
                                    <label>Repeat Password</label>
                                    <input type="password" name="password_confirmation" required placeholder="Please Re-Enter The Password" 
                                    class="form-control form-control-rounded" value="{{ old('password_confirmation') }}">
                                    
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('password') }} !</span>
                                            </div>
                                        </div>
                                    @endif  
                                </div>
                                <input type="hidden" name="email" value="{{$use->email}}">
                                <input type="hidden" name="role" value="{{$use->roles()->first()->name}}">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE YOUR PASSWORD</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection