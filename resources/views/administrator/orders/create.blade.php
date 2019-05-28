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
                        {{-- <li class="breadcrumb-item"><a href="{{route('order.index')}}">View Orders</a></li> --}}
                        <li class="breadcrumb-item"><a href="{{route('order.invoice')}}">Invoice</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adding Distributor Order</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
                        @if(auth()->user()->hasRole('Administrator') OR(
                                auth()->user()->hasRole('Admin')))
                            @if(count($inventory) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Saved Inventories in All Ware House <br>
                                    <b style="color:red">You will Have an error creating an order as Super Admin Or Admin because the products are linked to a ware house and, the super admin 
                                        does not have a ware house but its working for other users</b>
                                </div>
                                <form action="{{route('order.save')}}" method="POST" enctype="multipart/form-data">
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
                                                        <th>Ware House </th>
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
                                                        <th>Ware House </th>
                                                        <th>Qty </th>
                                                        <th>Action </th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php $number =1; ?>
                                                    @foreach($inventory as $inventories)
                                                        <tr>
                                                            <td>{{$number}}</td>
                                                            <td>{{$inventories->product_name}}</td> 
                                                            <input type="hidden" name="product_name<?php echo $number ?>"
                                                                value="{{$inventories->product_name}}">
                                                            <td>
                                                                
                                                                @foreach(ProductCategory($inventories->category_id) as 
                                                                    $categories)
                                                                    {{$categories->category_name}}
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach(ProductVariants($inventories->variant_id) 
                                                                    as $vari)
                                                                    {{$vari->variant_name. " ". $vari->variant_size}}
                                                                @endforeach
                                                            </td> 
                                                            
                                                            
                                                            <td>
                                                                @foreach(WareHouseDetails($inventories->ware_house_id) 
                                                                as $ware)
                                                                    {{$ware->name}}
                                                                @endforeach
                                                            </td>
                                                            <td><?php
                                                                $early = 1;
                                                                $current = $inventories->quantity;
                                                                if($current < 1){ ?>
                                                                    <p style="color:red">Out of Stock</p><?php
                                                                }else{ ?>
                                                                    <select class ="form-control form-control-rounded" name ="quantity<?php echo $number; ?>">

                                                                        <option value="">Qty  </option>
                                                                        
                                                                        <option value=""> </option><?php
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
                                                                    Add Order</p><?php
                                                                } ?>
                                                            </td> 
                                                            <input type="hidden" name="stock_id<?php echo $number ?>" value="{{$inventories->stock_id}}">
                                                            <input type="hidden" name="unit_amount<?php echo $number ?>" value="1000"> 
                                                            
                                                        </tr>
                                                        
                                                    <?php
                                                        $number++; ?>
                                                    @endforeach
                                                </tbody>
                                            
                                            </table>
                                        </div>
                                        
                                    </div> 
                                    <div class="card-body">
                                        <div class="form-group row ">
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-rounded" name="distributor_id" required>
                                                    <option value=""> -- Select The Distributor -- </option>
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
                                            @if(auth()->user()->hasRole('Editor') OR
                                                auth()->user()->hasRole('Receptionist'))
                                                <div class="col-sm-6" align="center">
                                                    <input type="hidden" name="show" value="<?php echo $number; ?>">
                                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                                        ADD THE ORDER 
                                                    </button>
                                                </div>
                                            @endif
                                        </div> 
                                    </div>  
                                </form>
                                
                            @endif
                        @else
                            @if(count($invent) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty in {{$inv->name}}
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Saved Inventories in {{$inv->name}} Ware House
                                </div>
                                <form action="{{route('order.save')}}" method="POST" enctype="multipart/form-data">
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
                                                    @foreach($invent as $invento)
                                                        <tr>
                                                            <td>{{$number}}</td>
                                                            <td><?php echo ucwords($invento->product_name) ?></td> 
                                                            <input type="hidden" name="product_name<?php echo $number ?>"
                                                                value="{{$invento->product_name}}">
                                                            <td>
                                                                
                                                                @foreach(ProductCategory($invento->category_id) as 
                                                                    $categories)
                                                                    <?php echo ucwords($categories->category_name); ?>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach(ProductVariants($invento->variant_id) 
                                                                    as $vari)
                                                                    <?php echo ucwords($vari->variant_name. " ". $vari->variant_size) ?>
                                                                @endforeach
                                                            </td> 
                                                            
                                                            
                                                            
                                                                {{-- @foreach(WareHouseDetails($invento->ware_house_id) 
                                                                as $ware)
                                                                     //echo ucwords($ware->name) 
                                                                @endforeach --}}
                                                            
                                                            <td><?php
                                                                $early = 1;
                                                                $current = $invento->quantity; ?>
                                                                @if($current < 1)
                                                                    <p style="color:red">Out of Stock</p>
                                                                @else 
                                                                    <select class ="form-control form-control-rounded" style="width: 80px" 
                                                                        name="quantity<?php echo $number; ?>">
                                                                        <option value="">Qty  </option>
                                                                        <?php foreach(range($early, $current) as $i){
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
                                                                        
                                                                    @endif  
                                                                @endif
                                                                
                                                            </td> 
                                                            <td><?php
                                                                if($current < 1){ ?>
                                                                    <p style="color:red">Out of Stock</p><?php
                                                                }else{ ?><p style="color:green">
                                                                    <input type="checkbox" name="add_order<?php echo $number; ?>"  
                                                                    value="1">
                                                                    Add Order</p><?php
                                                                } ?>
                                                            </td> 
                                                            <input type="hidden" name="stock_id<?php echo $number ?>" value="{{$invento->stock_id}}">
                                                            <input type="hidden" name="unit_amount<?php echo $number ?>" value="1000"> 
                                                            
                                                        </tr>
                                                        
                                                    <?php
                                                        $number++; ?>
                                                    @endforeach
                                                </tbody>
                                            
                                            </table>
                                        </div>
                                        
                                    </div> 
                                    <div class="card-body">
                                        <div class="form-group row ">
                                            <div class="col-sm-6">
                                                <select class="form-control form-control-rounded" name="distributor_id" required>
                                                    <option value=""> -- Select The Distributor -- </option>
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
                                                    ADD THE ORDER 
                                                </button>
                                            </div>
                                        </div> 
                                    </div>  
                                </form>
                                
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