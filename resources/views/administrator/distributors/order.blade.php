@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-12">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        
                        <li class="breadcrumb-item"><a href="{{route('distributor.order', $distribut->distributor_id)}}">
                            Distributor Orders</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.payment', $distribut->distributor_id)}}">
                            Distributor Payments</a>
                        </li>

                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                             <li class="breadcrumb-item"><a href="{{route('distributor.create')}}">Add Distributor</a></li>
                            <li class="breadcrumb-item"><a href="{{route('distributor.restore')}}">Restore Deleted 
                            Distributors</a></li>
                        @endif
                        
                       
                        <li class="breadcrumb-item active" aria-current="page">List of Distributor Order</li>
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		
                        <div class="card-header"><i class="fa fa-table"></i> 
                            List of Distributor Order
                        </div>
                        
                        <div class="card-body">
                        
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th> Transaction ID</th>
                                            <th> Distributor </th>
                                            <th> Ware House </th>
                                            <th> Operation</th>
                                            
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                           
                                            <th> Distributor </th>
                                            <th> Ware House </th>
                                            <th> Transaction ID</th>
                                            <th> Operation</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $number =1; ?>
                                        @foreach($dist_order as $orders)
                                            <tr>
                                                
                                                
                                                <td>{{$orders->transaction_number}}</td>
                                                <td>{{$orders->distributor->name}}</td>
                                                <td>{{$orders->warehouse->name}}</td>
                                                <td>
                                                    
                                                    <a href="{{route('payment.details', $orders->transaction_number)}}" 
                                                            class="btn btn-primary">
                                                        <i class="fa fa-list"></i></a>  
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php
                                            $number++; ?>
                                        @endforeach
                                    </tbody>
                                
                                </table>
                            </div>
                            
                        </div> 
                                
		             	
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>


    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection