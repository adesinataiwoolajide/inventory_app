@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.edit', $dist->distributor_id)}}">Edit Distributor</a></li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.create')}}">Add Distributor</a></li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.restore')}}">Restore Deleted Distributors</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Save Product Distributors</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update The Distributor Details</div>
	            		<div class="card-body">
	            			<form action="{{route('distributor.update', $dist->distributor_id)}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-3">
                                        <label>Distributor Name</label>
                                        <input type="text" name="name" class="form-control form-control-rounded" 
                                        value="{{$dist->name}}" required placeholder="Enter The distributor Name">
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
                                        <input type="number" value="{{$dist->phone_one}}" name="phone_one" class="form-control form-control-rounded" required placeholder="Enter The Phone One">
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
                                        placeholder="Enter The Phone Two" value="{{$dist->phone_two}}">
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
                                        <input type="email" name="email" value="{{$dist->email}}" class="form-control form-control-rounded" required 
                                        placeholder="Enter The E-mail">
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
                                        <label>Credit Limit</label>
                                        <input type="number" name="credit_limit" class="form-control form-control-rounded" 
                                        required placeholder="Enter The Credit Limit" value="{{$dist->credit_limit}}">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('credit_limit'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('credit_limit') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Credit Reduction</label>
                                        <input type="number" name="credit_reduction_per_month" class="form-control form-control-rounded" required 
                                                    placeholder="Enter The Credit Reduction" value="{{$dist->credit_reduction_per_month}}">
                                        <span style="color: red">** This Field is Required **</span>
                                        @if ($errors->has('credit_reduction_per_month'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('credit_reduction_per_month') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>

                                    
                                    <div class="col-sm-6">
                                        <label>Address</label>
                                        <textarea class="form-control form-control-rounded" required name="address" 
                                        placeholder="Enter The distributor Address">{{$dist->address}}</textarea>
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
                                    <input type="hidden" value="{{$dist->email}}" name="prev_email">

					                <div class="col-sm-12" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE THE 
                                            DISTRIBUTOR </button>
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
		          		@if(count($distributor) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Saved Product distributors</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                                <th> Credit Limit </th>
                                                <th> Credit RPM </th>
                                                <th>Time Added</th>
                                                <th>Options </th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                                <th> Credit Limit </th>
                                                <th> Credit RPM </th>
                                                <th>Time Added</th>
                                                <th>Options </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $number =1; ?>
                                            @foreach($distributor as $distributors)
                                                <tr>
                                                    
                                                    <td>{{$distributors->name}}</td> 
                                                    <td>{{$distributors->phone_one. ", ". $distributors->phone_two}}</td> 
                                                    <td>{{$distributors->email}}</td>
                                                    <td>&#8358;<?php echo number_format($distributors->credit_limit); ?></td> 
                                                    <td>&#8358;<?php echo number_format($distributors->credit_reduction_per_month) ?></td> 
                                                    <td>{{$distributors->created_at}}</td>
                                                    <td>    
                                                        @if(auth()->user()->hasRole('Administrator') OR(
                                                            auth()->user()->hasRole('Admin')))
                                                            <a href="{{route('distributor.delete', $distributors->distributor_id)}}" 
                                                            onclick="return(confirmToDelete());" class="">
                                                            <i class="fa fa-trash-o"></i></a>
                                                        @endif
                                                        <a href="{{route('distributor.edit', $distributors->distributor_id)}}" 
                                                            onclick="return(confirmToEdit());" class=""><i class="fa fa-pencil"></i> 
                                                            
                                                        </a>
                                                        <a href="{{route('distributor.order', $distributors->distributor_id)}}"><i class="fa fa-shopping-cart"></i>
                                                            
                                                        </a>
                                                        @if(auth()->user()->hasRole('Administrator') OR (auth()->user()->hasRole('Admin'))
                                                            OR (auth()->user()->hasRole('Accountant')))        
                                                            <a href="{{route('distributor.payment', $distributors->distributor_id)}}"><i class="fa fa-money"></i>
                                                                
                                                            </a>
                                                            
                                                            <a href="{{route('distributor.payment', $distributors->distributor_id)}}"><i class="fa fa-list"></i>
                                                                
                                                            </a>
                                                        @endif
                                                        {{-- <a href="{{route('distributor.payment', $distributors->distributor_id)}}"><i class="fa fa-building"></i>
                                                            
                                                        </a> --}}
                                                           
                                                            
                                                                
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