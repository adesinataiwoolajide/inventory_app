@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @can('employee-create')
                            <li class="breadcrumb-item"><a href="{{route('employee.create')}}">Add Employee</a></li>
                        @endcan    
                        @can('employee-restore')
                            <li class="breadcrumb-item"><a href="{{route('employee.restore')}}">Restore Deleted Employees</a></li>
                            
                        @endcan
                        <li class="breadcrumb-item active" aria-current="page">Saved Employees</li>
                    </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add 
                            New Employee Details</div>
	            		<div class="card-body">
	            			<form action="{{route('employee.save')}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-3">
                                        <label>Full Name</label>
                                        <input type="text" name="full_name" class="form-control form-control-rounded" 
                                        value="{{ old('full_name') }}" required placeholder="Enter The employee Name">
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('full_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('full_name') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-3">
                                        <label>E-Mail</label>
                                        <input type="email" name="email" class="form-control 
                                        form-control-rounded" required value="{{ old('email') }}" placeholder="Enter The Employee Email">
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
                                    <div class="col-sm-3">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone_number" class="form-control 
                                        form-control-rounded" required placeholder="Enter The Phone Number" value="{{ old('phone_number') }}">
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('phone_number'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('phone_number') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Contract Type</label>
                                        <select name="contract_type" required class="form-control form-control-rounded">
                                            <option value="">-- Contract Type --</option>
                                            {{-- <option value=""> </option> --}}
                                            <option value="Temporary Staff">Temporary Staff </option>
                                            <option value="Permanant Staff">Permanent Staff </option>
                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('contract_type'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('contract_type') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Ware House</label>
                                        <select name="ware_house_id" required class="form-control form-control-rounded">
                                            <option value="">-- Select Ware House --</option>
                                            {{-- <option value=""> </option> --}}
                                            @if(auth()->user()->hasRole('Administrator') 
                                                OR auth()->user()->hasRole('Admin')){
                                                @foreach ($warehouse as $warehouses)
                                                    <option value="{{$warehouses->ware_house_id}}">{{$warehouses->name}} </option>
                                                @endforeach
                                                
                                            @else
                                                <option value="{{$inv->ware_house_id}}">{{$inv->name}} </option>
                                            @endif
                                            
                                            
                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('ware_house_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('ware_house_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Category</label>
                                        <select name="role" required class="form-control form-control-rounded">
                                            
                                            
                                            <option value="">-- Role --</option>
                                            {{-- <option value="{{old('role') }}">{{old('role')}} </option> --}}
                                            <option value="Accountant">Accountant </option>
                                            <option value="Admin">Admin </option>
                                            <option value="Administrator">Administrator </option>
                                            <option value="Editor">Editor </option>
                                            <option value="Receptionist">Receptionist </option>
                                            <option value="Staff">Staff </option>
                                            
                                        </select>
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
                                        <label>Address</label>
                                        <textarea class="form-control form-control-rounded" required 
                                        placeholder="Enter The Address" name="address">{{old('address')}}</textarea>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('address'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('address') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>
                                    

                                    
					                <div class="col-sm-12" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">ADD THE 
                                            EMPLOYEE </button>
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
                        @if(auth()->user()->hasRole('Administrator') 
                            OR auth()->user()->hasRole('Admin')){
                            @if(count($employee) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty In All Ware House
                                </div> 

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> List of All Employees In All Ware House</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th> Name</th>
                                                    <th>Phone</th>
                                                    <th> Email </th>
                                                    <th>Type </th>
                                                    <th>Ware House </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    
                                                    <th> Name</th>
                                                    <th>Phone</th>
                                                    <th> Email </th>
                                                    <th>Type </th>
                                                    <th>Ware House </th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($employee as $employees)
                                                    <tr>
                                                        
                                                        <td>{{$employees->full_name}}</td> 
                                                        <td>{{$employees->phone_number}}</td> 
                                                        <td>{{$employees->email}}</td> 
                                                        <td>{{$employees->contract_type}}</td> 
                                                        <td>{{$employees->warehouse->name}}</td> 
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
                                                                auth()->user()->hasRole('Admin')))
                                                            {{-- @can('employee-delete') --}}
                                                                <a href="{{route('employee.delete', $employees->employee_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
                                                            @endif
                                                            @can('employee-edit')
                                                                <a href="{{route('employee.edit', $employees->employee_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @else
                            @if(count($emp) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty in {{$inv->name}} Ware House
                                </div>

                            @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Saved Employees in {{$inv->name}}</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th> Name</th>
                                                    <th>Phone</th>
                                                    <th> Email </th>
                                                    <th>Type </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    
                                                    <th> Name</th>
                                                    <th>Phone</th>
                                                    <th> Email </th>
                                                    <th>Type </th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($emp as $employees)
                                                    <tr>
                                                        
                                                        <td>{{$employees->full_name}}</td> 
                                                        <td>{{$employees->phone_number}}</td> 
                                                        <td>{{$employees->email}}</td> 
                                                        <td>{{$employees->contract_type}}</td> 
                                                        <td>{{$employees->warehouse->name}}</td> 
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
                                                                auth()->user()->hasRole('Admin')))
                                                            {{-- @can('employee-delete') --}}
                                                                <a href="{{route('employee.delete', $employees->employee_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
                                                            @endif
                                                            @can('employee-edit')
                                                                <a href="{{route('employee.edit', $employees->employee_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>


    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection