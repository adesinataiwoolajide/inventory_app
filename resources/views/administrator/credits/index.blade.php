@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')) OR(
                            auth()->user()->hasRole('Accountant')))
                            <li class="breadcrumb-item"><a href="{{route('credit.index')}}">View All Credits</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.paid')}}">Paid Credit</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.unpaid')}}">UnPaid Credit</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.payment')}}">Credit Payment</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">List of Credit</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                            @if(count($credit) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of All Saved Credit in All Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Credit Amount </th>
                                                    <th> Status </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Credit Amount </th>
                                                    <th> Status </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($credit as $credits)
                                                    <tr>
                                                        <td>{{$number}}
                                                            {{-- <a href="{{route('payment.delete', $credits->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                            <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToEdit());" class="btn btn-success">
                                                                <i class="fa fa-pencil"></i></a>
                                                            <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                class="btn btn-primary">
                                                                <i class="fa fa-list"></i>
                                                            </a>   --}}
                                                        </td>
                                                        
                                                        <td>{{$credits->payment_number}}</td>
                                                        <td>{{$credits->distributor->name}}</td>
                                                        <td>{{$credits->warehouse->name}}</td>
                                                        <td> &#8358;<?php echo number_format($credits->credit_amount) ?> </td>
                                                        
                                                        <td> 
                                                            @if($credits->paid_status ==1)
                                                                <p style="color: green"> Paid </p>
                                                            @else
                                                                <p style="color: red"> &#8358;
                                                                    <?php echo number_format($credits->credit_amount) ?> Pending </p>
                                                            @endif
                                                        </td>
                                                        <td>{{$credits->created_at}}</td>
                                                        
                                                    </tr>
                                                    
                                                    <?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                    
                                </div> 
                                    
                            @endif
                        @else
                            @if(count($cre) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List in {{$inv->name}} Warehouse is Empty
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of All Saved Credit in {{$inv->name}} Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Credit Amount </th>
                                                    <th> Status </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Credit Amount </th>
                                                    <th> Status </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($cre as $credits)
                                                    <tr>
                                                        <td>{{$number}}
                                                            {{-- <a href="{{route('payment.delete', $credits->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                            <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToEdit());" class="btn btn-success">
                                                                <i class="fa fa-pencil"></i></a>
                                                            <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                class="btn btn-primary">
                                                                <i class="fa fa-list"></i>
                                                            </a>   --}}
                                                        </td>
                                                        
                                                        <td>{{$credits->payment_number}}</td>
                                                        <td>{{$credits->distributor->name}}</td>
                                                        <td>{{$credits->warehouse->name}}</td>
                                                        <td> &#8358;<?php echo number_format($credits->credit_amount) ?> </td>
                                                        
                                                        <td> 
                                                            @if($credits->paid_status ==1)
                                                                <p style="color: green"> Paid </p>
                                                            @elseif($credits->credit_amount ==0)
                                                                <p style="color: green">
                                                                No Credit </p>
                                                            @else
                                                            <p style="color: red"> &#8358;
                                                                    <?php echo number_format($credits->credit_amount) ?> Pending </p> 
                                                            @endif
                                                        </td>
                                                        <td>{{$credits->created_at}}</td>
                                                        
                                                    </tr>
                                                    
                                                    <?php
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