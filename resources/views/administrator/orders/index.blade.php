@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('order.invoice')}}">Order Invoice</a></li>
                        @if(auth()->user()->hasRole('Administrator') 
                            OR auth()->user()->hasRole('Admin') OR auth()->user()->hasRole('Editor')
                            OR auth()->user()->hasRole('Receptionist'))
                            <li class="breadcrumb-item"><a href="{{route('order.create')}}">Add Order</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">List of Order Invoice</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			 <div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		@if(count($invoice) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
                            <div class="card-header"><i class="fa fa-table"></i> 
                                List of Saved Order Invoice
                            </div>
                            
                            <div class="card-body">
                            
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Transaction Id</th>{{-- <th>Total</th> --}}
                                                <th>Distributor </th>
                                                <th>TIme Added</th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Transaction Id</th>
                                                {{-- <th>Total</th> --}}
                                                <th>Distributor </th>
                                                <th> Invoice </th>
                                                <th>TIme Added</th>
                                                <th>Action </th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $number =1; ?>
                                            @foreach($invoice as $orders)
                                                <tr>
                                                    <td>{{$number}}</td>
                                                    <td>{{$orders->transaction_number}}</td>
                                                    
                                                    
                                                    <td>@foreach(ProductDistributor($orders->distributor_id) as $dist)
                                                            {{$dist->name}}
                                                        @endforeach
                                                    </td>
                                                    <td> {{$orders->invoice_number}} </td>
                                                    
                                                    <td>{{$orders->created_at}}
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="{{route('order.details',$orders->transaction_number)}}" 
                                                        class="btn btn-primary">
                                                        <i class="fa fa-list"></i></a>  
                                                        <a href="{{route('print.invoice', $orders->transaction_number)}}" class="btn btn-success">
                                                            <i class="fa fa-pdf"></i> See Invoice
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
                                
		             	@endif
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>


    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection