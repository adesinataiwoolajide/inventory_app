@extends('layouts.app')

@section('content')
    
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('user.restore')}}">Restore Deleted Users</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{route('user.create')}}">Add User</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">List of Deleted Users </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('partials._message')
                <div class="card">
                    @if(count($user) ==0)
                        <div class="card-header" align="center" style="color: red"><i class="fa fa-table"></i> 
                            The List is Empty
                        </div>

                    @else
                        <div class="card-header"><i class="fa fa-table"></i> List of Deleted Users</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                    </ttfoothead>
                                    <tbody><?php
                                        $y=1; ?>
                                        @foreach($user as $users)
                                        <tr>
                                        
                                            <td>{{$y}}
                                                @if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                <a href="{{route('user.undelete', $users->user_id)}}"
                                                    onclick="return(confirmToRestore());" class="btn btn-success">
                                                    <i class="fa fa-trash-o"></i>Restore
                                                </a> 
                                                @endif
                                            </td>
                                            <td>{{$users->name}}</td> 
                                            <td>{{$users->email}}</td> 
                                            <td>{{$users->role}}</td> 
                                            
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