@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
				    	<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('supplier.create')}}">Add Supplier</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                            <li class="breadcrumb-item"><a href="{{route('supplier.restore')}}">Restore Deleted Suppliers</a></li>
                        @endif
			            <li class="breadcrumb-item active" aria-current="page">Saved Product Suppliers</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add 
                            New Product supplier Details</div>
	            		<div class="card-body">
	            			<form action="{{route('supplier.save')}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-3">
                                        <label>Supplier Name</label>
					                    <input type="text" name="name" class="form-control form-control-rounded" value="{{ old('name') }}" required placeholder="Enter The Supplier Name">
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
                                    
                                    <div class="col-sm-3">
                                        <label>Phone One</label>
                                        <input type="number" name="phone_one" class="form-control form-control-rounded" value="{{ old('phone_one') }}" required placeholder="Enter The Phone One">
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('phone_one'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('phone_one') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Phone Two</label>
                                        <input type="number" name="phone_two" class="form-control form-control-rounded" 
                                        placeholder="Enter The Phone Two" value="{{ old('phone_two') }}">
                                        <span style="color: green">** This Field is Optional **</span>
                                            @if ($errors->has('phone_two'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('phone_two') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-3">
                                        <label>E-Mail</label>
                                        <input type="email" name="email" class="form-control form-control-rounded" required 
                                        placeholder="Enter The E-mail" value="{{ old('email') }}">
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
                                        <label>State</label>
                                        <select class="form-control form-control-rounded" name="state" required>
                                            <option value=""> -- Select The State -- </option>
                                            <option value="{{ old('state') }}"> {{ old('state') }} </option>
                                            {{-- <option value=""> </option> --}}
                                            <option value="Abuja FCT">Abuja FCT</option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="Jigawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Kano">Kano</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kogi">Kogi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nassarawa">Nassarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Yobe">Yobe</option>
                                            <option value="Zamfara">Zamfara</option>
                                                
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('state'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('state') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-3">
                                        <label>City</label>
                                        <input type="text" name="city" class="form-control form-control-rounded" required 
                                        placeholder="Enter The City" value="{{ old('city') }}"">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('city'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('city') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Country</label>
                                        <select class="form-control form-control-rounded" name="country" required>
                                            <option value=""> -- Select The Country -- </option>
                                            <option value="{{ old('country') }}"> {{ old('country') }} </option>
                                            <option value=""> </option>
                                            <option value="Nigeria"> Nigeria</option>
                                            <option value="Others"> Others</option>
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('country'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('country') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Address</label>
                                        <textarea class="form-control form-control-rounded" required name="address" 
                                        placeholder="Enter The Supplier Address">{{old('address') }}</textarea>
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
                                            SUPPLIER </button>
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
		          		@if(count($supplier) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Saved Product Suppliers</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
                                               
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                                <th> Address </th>
                                                <th>Options </th>
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
                                                
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                                <th>Options </th>
												
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($supplier as $suppliers)
							                    <tr>
                                                    
							                        <td>{{$suppliers->name}}</td> 
                                                    <td>{{$suppliers->phone_one. " ". $suppliers->phone_two}}</td> 
                                                    <td>{{$suppliers->email}}</td> 
                                                    <td>{{$suppliers->address . " ". $suppliers->city. " ".
                                                        $suppliers->state. " ". $suppliers->country}}</td> 
                                                    
                                                    <td>
                                                        @if(auth()->user()->hasRole('Administrator') OR(
                                                            auth()->user()->hasRole('Admin')))
                                                            <a href="{{route('supplier.delete', $suppliers->supplier_id)}}" 
                                                            onclick="return(confirmToDelete());" class="btn btn-danger">
                                                            <i class="fa fa-trash-o"></i></a>
                                                        @endif
                                                        <a href="{{route('supplier.edit', $suppliers->supplier_id)}}" 
                                                            onclick="return(confirmToEdit());" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{route('supplier.product', $suppliers->supplier_id)}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
                                                          
                                                        </a>
                                                            
                                                    </td> 
							                    </tr><?php
							                    $number++; ?>
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
    <!--End Back To Top Button-->
	
@endsection