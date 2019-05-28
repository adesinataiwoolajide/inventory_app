@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('product.edit', $product->product_id)}}">Edit  Product</a></li>
                        <li class="breadcrumb-item"><a href="{{route('product.create')}}">Add Product</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
                            <li class="breadcrumb-item"><a href="{{route('product.restore')}}">Restore Deleted Products</a></li>
                        @endif
                        <li class="breadcrumb-item"><a href="{{route('inventory.index')}}">Inventory</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Saved Products</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update 
                            The Product Details</div>
	            		<div class="card-body">
	            			<form action="{{route('product.update', $product->product_id)}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-4">
                                        <label>Name</label>
                                        <input type="text" name="product_name" class="form-control 
                                        form-control-rounded" required placeholder="Enter The Product Name" 
                                        value="{{$product->product_name}}">
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('product_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('product_name') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="form-control 
                                        form-control-rounded" required placeholder="Enter The Amount" value="{{$product->amount}}">
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('amount'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('amount') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Quantity</label>
                                        <input type="hidden" value="{{$product->quantity}}" name="previous">
                                        <input type="number" name="quantity" class="form-control 
                                        form-control-rounded" required placeholder="Enter The Quantity" value="{{$product->quantity}}">
                                        <span style="color: red">** This Field is Required **</span>
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
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Supplier</label>
                                        <select name="supplier_id" class="form-control 
                                        form-control-rounded" required>
                                            <option value="{{$product->supplier->supplier_id}}">
                                                    {{$product->supplier->name}}
                                            </option>
                                            {{-- @foreach(ProductSupplier($prod->supplier_id) as $supl)      
                                                <option value="{{$prod->supplier_id}}">{{$supl->name}}</option>
                                            @endforeach --}}
                                            <option value=""> </option>
                                            @foreach($supplier as $suppliers)
                                                <option value="{{$suppliers->supplier_id}}">{{$suppliers->name}} </option>
                                            @endforeach
                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('supplier_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('supplier_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                   
                                    <div class="col-sm-4">
                                        <label>Category & Variant</label>
                                        <select name="variant_id" class="form-control 
                                        form-control-rounded" required>
                                        @foreach(ProductCategory($product->category_id) as $ca)
                                            <option value="{{$product->variant->variant_id}}">
                                                <?php echo ucwords(
                                                $ca->category_name. " ". $product->variant->variant_name. " ". $product->variant->variant_size
                                                ); ?>
                                            </option>
                                        @endforeach
                                            <option value=""> </option>
                                            @foreach($variant as $variants)
                                                @foreach(ProductCategory($variants->category_id) as $cat)
            
                                                    <option value="{{$variants->variant_id }}">
                                                    {{$cat->category_name. " ". $variants->variant_name. " ". $variants->variant_size}} </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('variant_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('variant_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Ware House</label>
                                        <select name="ware_house_id" class="form-control 
                                        form-control-rounded" required>
                                            
                                            <option value="{{$product->warehouse->ware_house_id}}">
                                                    {{$product->warehouse->name}}
                                            </option>
                                            {{-- @foreach(WareHouseDetails($prod->ware_house_id) as $wareh)
                                              
                                                <option value="{{$prod->ware_house_id}}">{{$wareh->name}}</option>
                                            @endforeach --}}
                                            
                                            @if(auth()->user()->hasRole('Admininistrator')OR 
                                            auth()->user()->hasRole('Admin'))
                                                <option value=""> </option>
                                                @foreach($warehouse as $warehouses)
                                                    <option value="{{$warehouses->ware_house_id}}">
                                                        {{$warehouses->name}} </option>
                                                @endforeach
                                            @else
                                                <option value="{{$inv->ware_house_id}}">{{$inv->name}} </option>
                                            @endif
                                        </select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('ware_house_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('ware_house_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>

					                <div class="col-sm-12" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                            UPDATE THE 
                                            PRODUCT </button>
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
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                            @if(count($proc) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty In All Ware Houses
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> List of Saved Products In All Ware Houses</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th>Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th>Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($proc as $procs)
                                                    <tr>
                                                        
                                                        <td>{{$procs->product_name}}</td> 
                                                        <td><?php echo number_format($procs->quantity) ?></td> 
                                                        <td>&#8358;<?php echo number_format($procs->amount) ?></td> 
                                                        
                                                        <td>{{$procs->category->category_name}}
                                                            {{-- @foreach(ProductCategory($products->category_id) as $categories)
                                                                {{$categories->category_name}}
                                                            @endforeach --}}
                                                        </td>
                                                        <td>{{$procs->variant->variant_name}}
                                                            {{-- @foreach(ProductVariants($products->variant_id) as $vari)
                                                                {{$vari->variant_name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        
                                                        <td>{{$procs->supplier->name}}
                                                            {{-- @foreach(ProductSupplier($products->supplier_id) as $suppl)
                                                                {{$suppl->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                    
                                                        <td>{{$procs->warehouse->name}}
                                                            {{-- @foreach(WareHouseDetails($products->ware_house_id) as $wareh)
                                                                {{$wareh->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        <td>{{$procs->created_at }}</td>
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
                                                                auth()->user()->hasRole('Admin')))
                                                                <a href="{{route('product.delete', $procs->product_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o">
                                                                </i></a>
                                                            @endif
                                                            @can('product-edit')
                                                                <a href="{{route('product.edit', $procs->product_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil">
                                                                </i></a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                </div>
                            @endif
                       
                        @else
                            @if(count($prod) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty in {{$inv->name}} Ware House
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> List of Saved Products In {{$inv->name}} Ware House</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th> Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th> Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($prod as $prods)
                                                    <tr>
                                                        
                                                        <td>{{$prods->product_name}}</td> 
                                                        <td><?php echo number_format($prods->quantity) ?></td> 
                                                        <td>&#8358;<?php echo number_format($prods->amount) ?></td> 
                                                        
                                                        <td>{{$prods->category->category_name}}
                                                            {{-- @foreach(ProductCategory($products->category_id) as $categories)
                                                                {{$categories->category_name}}
                                                            @endforeach --}}
                                                        </td>
                                                        <td>{{$prods->variant->variant_name}}
                                                            {{-- @foreach(ProductVariants($products->variant_id) as $vari)
                                                                {{$vari->variant_name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        
                                                        <td>{{$prods->supplier->name}}
                                                            {{-- @foreach(ProductSupplier($products->supplier_id) as $suppl)
                                                                {{$suppl->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                    
                                                        <td>{{$prods->warehouse->name}}
                                                            {{-- @foreach(WareHouseDetails($products->ware_house_id) as $wareh)
                                                                {{$wareh->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        <td>{{$prods->created_at }}</td>
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                            {{-- @can('product-delete') --}}
                                                                <a href="{{route('product.delete', $prods->product_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o">
                                                                </i>Delete</a>
                                                            @endif
                                                            @can('product-edit')
                                                                <a href="{{route('product.edit', $prods->product_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil">
                                                                </i>Edit </a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
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