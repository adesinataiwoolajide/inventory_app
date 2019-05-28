@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @can('order-invoice')
                            <li class="breadcrumb-item"><a href="{{route('sales.report')}}">View Sales Report</a></li>
                            <li class="breadcrumb-item"><a href="{{route('sales.invoice')}}">Sales Invoice</a></li>
                        @endcan
                        @can('order-create')
                        <li class="breadcrumb-item"><a href="{{route('sales.index')}}">View Sales</a></li>
                        
                        @endcan
                        {{-- <li class="breadcrumb-item"><a href="{{route('order.index')}}">View Orders</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">List of Sales Invoice</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		@if(count($payment) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
                            <div class="card-header"><i class="fa fa-table"></i> 
                                List of Sales Report
                            </div>
                            
                            <div class="card-body">
                            
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N </th>
                                                <th> Distributor </th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S/N </th>
                                                <th> Distributor </th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </tfoot>
                                        <tbody><?php
                                            $num=1; ?>
                                            @foreach($payment as $listOrder)<?php
                                                $cal = $listOrder->quantity * $listOrder->unit_amount;
                                                //array_push($total, $cal); ?>
                                                <tr>
                                                    <td>{{$num}} </td>
                                                    <td>{{$listOrder->distributor->name}} </td>
                                                    <td>{{$listOrder->inventory->product_name}}
                                                        {{-- @foreach(ProductStock($listOrder->stock_id) as $stock)
                                                            {{$stock->product_name}}
                                                        @endforeach --}}
                                                    </td>
                                                    <td><?php echo number_format($listOrder->quantity) ?></td> 
                                                    <td>&#8358;<?php echo number_format($listOrder->unit_amount)  ?></td> 
                                                    <td>&#8358;<?php echo number_format($listOrder->total_amount)  ?></td> 
                                                    
                                                </tr>
                                                <?php 
                                                $num++; ?>
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