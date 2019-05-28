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
                        <a href="{{route('user.profile')}}">My Profile</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('change.pasword')}}">Change Password</a>
                    </li>
                   
                    <li class="breadcrumb-item active" aria-current="page">User Profile </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>{{$use->name}} Please Preview Your Details Below</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('profile.update', $use->user_id)}}" method="POST" enctype="multipart/form-data">
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
                                    <label>Staff Role</label>
                                    <select class="form-control form-control-rounded" name="role" required>
                                        <option value="{{$use->roles()->first()->name}}">{{$use->roles()->first()->name}} </option>
                                        
                                    <select>
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('role'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('role') }} !</span>
                                            </div>
                                        </div>
                                    @endif  

                                </div>
                                <div class="col-sm-4">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" value="{{$use->email}}" required placeholder="Please Enter The E-Mail" 
                                    class="form-control form-control-rounded" readonly>
                            
                                    <span style="color: pink">** This Field is Readonly **</span>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('email') }} !</span>
                                            </div>
                                        </div>
                                    @endif  
                                </div>
                                
                                
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        UPDATE YOUR DETAILS</button>
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