@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-12">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @foreach($payment as $pay)
                            <li class="breadcrumb-item"><a href="{{route('distributor.payment', $pay->distributor_id)}}">
                            Distributor Payments</a></li>
                            <li class="breadcrumb-item"><a href="{{route('distributor.order', $pay->distributor_id)}}">
                                Distributor Orders</a></li>
                            <li class="breadcrumb-item"><a href="{{route('distributor.order', $pay->distributor_id)}}">
                                    Distributor Outlets</a></li>
                        @endforeach
                        <li class="breadcrumb-item"><a href="{{route('distributor.create')}}">Add Distributor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Distributor Payment</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		
                        <div class="card-header"><i class="fa fa-table"></i> 
                            List of Saved Distributor's Payment
                        </div>
                        
                        <div class="card-body">
                        
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Distributor </th>
                                            <th> Ware House </th>
                                            <th> Transaction ID</th>
                                            <th> Total Amount </th>
                                            <th> Amount Paid </th>
                                            <th> Credit </th>
                                            <th> Time Added</th>
                                            <th> Options</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th> Distributor </th>
                                            <th> Ware House </th>
                                            <th> Transaction ID</th>
                                            <th> Total Amount </th>
                                            <th> Amount Paid </th>
                                            <th> Credit </th>
                                            <th> Time Added</th>
                                            <th> Options</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $number =1; ?>
                                        @foreach($payment as $orders)
                                            <tr>
                                                <td><?php echo ucwords($orders->distributor->name) ?></td>
                                                <td><?php echo ucwords($orders->warehouse->name) ?></td>
                                                <td>{{$orders->order->transaction_number}}</td>
                                                <td> &#8358;<?php echo number_format($orders->total_amount) ?> </td>
                                                <td> &#8358;<?php echo number_format($orders->paid_amount) ?></td>
                                                <td> 
                                                    @if($orders->credit ==0)
                                                        <p style="color: green"> No Credit </p>
                                                    @else
                                                        <p style="color: red"> &#8358;<?php echo number_format($orders->credit) ?> </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$orders->created_at}}
                                                </td>
                                                <td>
                                                    
                                                    <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                            class="btn btn-primary">
                                                        <i class="fa fa-list"></i>
                                                    </a>  
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