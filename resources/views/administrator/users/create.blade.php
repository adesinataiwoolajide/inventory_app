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
                        <a href="{{route('user.create')}}">Add User</a>
                    </li>
                    @if(auth()->user()->hasRole('Administrator'))
                        <li class="breadcrumb-item"><a href="{{route('user.restore')}}">Restore Deleted Users</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">List of Saved Users </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add A User</div>
                    <div class="card-body">
                        @include('partials._message')
                        <form action="{{route('user.save')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            <div class="form-group row ">
                                <div class="col-sm-4">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control form-control-rounded" required 
                                    placeholder="Enter The Full Name" value="{{ old('name') }}">
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
                                        <option value="{{ old('role') }}"> -- Select The Role -- </option>
                                        <option value=""> </option>
                                        @foreach($user_roles as $list_roles)
                                            <option value="{{$list_roles->name}}"> {{$list_roles->name}}  </option> 
                                        @endforeach
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
                                    <input type="email" name="email" required placeholder="Please Enter The E-Mail" 
                                    class="form-control form-control-rounded" value="{{ old('email') }}">
                            
                                    <span style="color: red">** This Field is Required **</span>
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
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <label>Repeat Password</label>
                                    <input type="password" name="password_confirmation" required placeholder="Please Re-Enter The Password" 
                                    class="form-control form-control-rounded" value="{{ old('password_confirmation') }}">
                                    
                                    <span style="color: red">** This Field is Required **</span>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <div class="alert-icon contrast-alert">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="alert-message">
                                                <span><strong>Error!</strong> {{ $errors->first('password_confirmation') }} !</span>
                                            </div>
                                        </div>
                                    @endif  
                                </div>
                                
                                
                                
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="border:none">
                                        ADD THE USER</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(count($user) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i> 
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Saved Users</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Opt</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Opt</th>
                                        </tr>
                                    </ttfoothead>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($user as $users)
                                        <tr>
                                        
                                            
                                            <td>{{$users->name}}</td> 
                                            <td>{{$users->email}}</td> 
                                            <td>{{$users->roles()->first()->name}}</td> 
                                            <td>
                                                @if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                <a href="{{route('user.delete', $users->user_id)}}" class="btn btn-danger" onclick="return(confirmToDelete());">
                                                <i class="fa fa-trash-o"></i>
                                                Delete</a>
                                                @endif
                                                <a href="{{route('user.edit', $users->user_id)}}" class="btn btn-success" onclick="return(confirmToEdit());">
                                                    <i class="fa fa-pencil"></i> 
                                                Edit</a>  
                                            </td>
                                            
                                        </tr><?php $y++; ?>
                                    @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>


<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
@endsection