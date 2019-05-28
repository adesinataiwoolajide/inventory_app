@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('print.invoice',$orderDetails->transaction_number)}}">Print Invoice</a></li>
                        @if(auth()->user()->hasRole('Administrator') 
                            OR auth()->user()->hasRole('Admin') OR auth()->user()->hasRole('Editor')
                            OR auth()->user()->hasRole('Receptionist'))
                            <li class="breadcrumb-item"><a href="{{route('order.create')}}">Add Order</a></li>
                            
                        @endif
                        {{-- <li class="breadcrumb-item"><a href="{{route('order.index')}}">View Orders</a></li> --}}
                           
                        <li class="breadcrumb-item active" aria-current="page">Printing Order Invoice</li>
                        
			         </ol>
			   	</div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Content Header (Page header) -->
                    <section class="content-header" align="center">
                        <img src="{{asset('styling/assets/inventory.jpg')}}" 
                        style="height: 100px;" alt="logo icon">
                        <h3>
                            Company Name
                            
                        </h3>
                        <h5>
                            Address: <br>
                            State: <br>
                            Phone Number: <br>
                            Email:  <br>
                            website: <br>
                        </h5>
                    </section>
      
                    <!-- Main content -->
                    <section class="invoice"><?php
                        $num =1;
                        $total = array(); ?>
                        {{-- @foreach(ProductTransOrders($orderDetails->transaction_number) as $listOrder) --}}
                            <!-- title row -->
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    {{-- <h4><i class="fa fa-globe"></i> Company Name</h4> --}}
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="float-sm-right">Date: <?php echo date('d/m/y') ?></h5>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Ware House Address
                                    <address>
                                        <strong>{{$orderDetails->warehouse->name}}</strong><br>
                                        {{$orderDetails->warehouse->address}}<br>
                                        {{$orderDetails->warehouse->state. ", ". " ".
                                        $orderDetails->warehouse->state."."}} <br>
                                        {{$orderDetails->warehouse->country}} <br>
                                       
                                        Email: info@example.com
                                    </address>
                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Distributor Address
                                    @foreach($buyers as $see)
                                        
                                       
                                        <address>
                                    
                                            <strong>{{$see->name}}</strong><br>
                                            {{$see->address}}<br>
                                            
                                            Phone: {{$see->phone_one. ",". $see->phone_two}}<br>
                                            Email: {{$see->email}}<br>
                                            <strong>Credit Limit: {{$see->credit_limit}}</strong><br>
                                            <strong>Credit Reduction Per Month: {{$see->credit_reduction_per_month}}</strong>
                                        </address>
                                        
                                    @endforeach
                                </div><!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice {{$orderDetails->invoice_number}}</b><br>
                                    <br>
                                    <b>Order ID:</b> {{$orderDetails->transaction_number}}<br>
                                    <b>Payment Due:</b> <?php echo date('d/m/y') ?><br>
                                    <b>Account:</b> 968-34567
                                </div><!-- /.col -->
                            </div><!-- /.row -->
        
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N </th>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($viewOrder as $listOrder)<?php
                                                $cal = $listOrder->quantity * $listOrder->unit_amount;
                                                array_push($total, $cal); ?>
                                                <tr>
                                                    <td>{{$num}} </td>
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
                                </div><!-- /.col -->
                            </div><!-- /.row -->
        
                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-lg-6 payment-icons">
                                    <p class="lead">Payment Methods:</p>
                                    <img src="{{asset('styling/assets/visa-dark.png')}}" alt="Visa">
                                    <img src="{{asset('styling/assets/mastro-dark.png')}}" alt="Mastercard">
                                    <img src="{{asset('styling/assets/american-dark.png')}}" alt="American Express">
                                    <img src="{{asset('styling/assets/paypal-dark.png')}}" alt="Paypal">
                                    <p class="bg-light p-2 mt-3 rounded">
                                        Please Take this Invoice To The Account Department
                                    </p>
                                </div><!-- /.col -->
                                <div class="col-lg-6">
                                    <p class="lead">Amount Due: <?php echo date('d/m/y') ?></p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Total:</th>
                                                    <td>&#8358;<?php echo number_format($price) ?></td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
        
                            <!-- this row will not appear when printing -->
                            <hr>
                            <div class="row no-print">
                                <div class="col-lg-4">
                                <a href="{{route('print.the.invoice',$orderDetails->transaction_number)}}" target="_blank" 
                                    class="btn btn-dark m-1"><i class="fa fa-print"></i> Print The Invoice</a>
                                </div>
                                <div class="col-lg-8">
                                    <div class="float-sm-right">
                                        {{-- <button class="btn btn-success m-1"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                        <button class="btn btn-primary m-1"><i class="fa fa-download"></i> Generate PDF</button> --}}
                                    </div>
                                </div>
                            </div>
                    </section><!-- /.content -->
                </div>
            </div>
	     </div>
	</div>
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
@endsection