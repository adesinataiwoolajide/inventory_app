@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') 
                            OR auth()->user()->hasRole('Admin') OR auth()->user()->hasRole('Editor')
                            OR auth()->user()->hasRole('Receptionist'))
                           
                            <li class="breadcrumb-item"><a href="{{route('order.create')}}">Add Order</a></li>
                        @endif
                       
                        <li class="breadcrumb-item"><a href="{{route('order.invoice')}}">Invoice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editing Distributor Order</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			 <div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
                        
                        <div class="card-header"><i class="fa fa-table"></i> 
                            Edit The Order
                        </div>
                        <form action="{{route('order.update', $details->transaction_number)}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                            
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Variants </th>
                                                {{-- <th>Ware House </th> --}}
                                                <th>Qty </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Variants </th>
                                                {{-- <th>Ware House </th> --}}
                                                <th>Qty </th>
                                                <th>Action </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $number =1; ?>
                                            @foreach($invent as $inventories)
                                                @foreach(ProductStock($inventories->stock_id) as $list )
                                                    <tr>
                                                        <td>{{$number}}</td>
                                                        <td>{{$list->product_name}}</td> 
                                                        <input type="hidden" name="product_name<?php echo $number ?>"
                                                            value="{{$list->product_name}}">
                                                        <td>
                                                            
                                                            @foreach(ProductCategory($list->category_id) as 
                                                                $categories)
                                                                {{$categories->category_name}}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach(ProductVariants($list->variant_id) 
                                                                as $vari)
                                                                {{$vari->variant_name. " ". $vari->variant_size}}
                                                            @endforeach
                                                        </td> 
                                                        
                                                        
                                                        {{-- <td>
                                                            @foreach(WareHouseDetails($list->ware_house_id) 
                                                            as $ware)
                                                                {{$ware->name}}
                                                            @endforeach
                                                        </td> --}}
                                                        <td><?php
                                                            $early = 1;
                                                            $current = $list->quantity;
                                                            if($current < 1){ ?>
                                                                <p style="color:red">Out of Stock</p><?php
                                                            }else{ ?>
                                                                <select class ="form-control form-control-rounded" name ="quantity<?php echo $number; ?>">
                                                                    <option value="{{$inventories->quantity}}">{{$inventories->quantity}}  </option>

                                                                    <?php
                                                                    foreach(range($early, $current) as $i){
                                                                        print'<option value=" '.$i.'"'.($i === $current ? $early : '').'>'.$i.'</option>';
                                                                    } ?>
                                                                </select>
                                                                @if ($errors->has('quantity')) 
                                                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                                        <div class="alert-icon contrast-alert">
                                                                            <i class="fa fa-check"></i>
                                                                        </div>
                                                                        <div class="alert-message">
                                                                            <span><strong>Error!</strong> {{ $errors->first('quantity') }} !</span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                @endif  <?php
                                                            } ?>
                                                            
                                                        </td> 
                                                        <td><?php
                                                            if($current < 1){ ?>
                                                                <p style="color:red">Out of Stock</p><?php
                                                            }else{ ?><p style="color:green">
                                                                <input type="checkbox" name="add_order<?php echo $number; ?>"  
                                                                value="1">
                                                                Update</p><?php
                                                            } ?>
                                                        </td> 
                                                        <input type="hidden" name="prev_quantity<?php echo $number ?>" value="{{$inventories->quantity}}">
                                                        <input type="hidden" name="stock_id<?php echo $number ?>" value="{{$list->stock_id}}">
                                                        <input type="hidden" name="order_id<?php echo $number ?>" value="{{$inventories->order_id}}">
                                                        <input type="hidden" name="invoice_number" value="{{$details->invoice_number}}">
                                                    </tr>
                                                    
                                                    <?php
                                                    $number++; ?>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    
                                    </table>
                                </div>
                                
                            </div> 
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <select class="form-control form-control-rounded" name="distributor_id" required>
                                           
                                            <option value="{{$details->distributor_id}}"> {{$details->distributor->name}} </option>
                                            <option value=""> </option>
                                            @foreach($distributor as $disDetails)
                                                <option value="{{$disDetails->distributor_id}}">{{$disDetails->name}} </option>
                                            @endforeach
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('distributor_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('distributor_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-6" align="center">
                                        <input type="hidden" name="show" value="<?php echo $number; ?>">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            UPDATE THE ORDER 
                                        </button>
                                    </div>
                                </div> 
                            </div>  
                        </form>
                                
                           
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>


    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection