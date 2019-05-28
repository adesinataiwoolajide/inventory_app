@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
                            <li class="breadcrumb-item"><a href="{{route('product.restore')}}">Restore Deleted Products</a></li>
                        @endif
                        <li class="breadcrumb-item"><a href="{{route('product.create')}}">Add  Product</a></li>
                        <li class="breadcrumb-item"><a href="{{route('inventory.index')}}">Inventory</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Deleted Products</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')

		          	<div class="card">
		          		@if(count($product) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Deleted Products</div>
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
						                	@foreach($product as $products)
							                    <tr>
                                                    
                                                    <td>{{$products->product_name}}</td> 
                                                    <td><?php echo number_format($products->quantity) ?></td> 
                                                    <td>&#8358;<?php echo number_format($products->amount)  ?></td> 
                                                    
                                                    <td>{{$products->category->category_name}}
                                                        {{-- @foreach(ProductCategory($products->category_id) as $categories)
                                                            {{$categories->category_name}}
                                                        @endforeach --}}
                                                    </td>
                                                    <td>{{$products->variant->variant_name}}
                                                        {{-- @foreach(ProductVariants($products->variant_id) as $vari)
                                                            {{$vari->variant_name}}
                                                        @endforeach --}}
                                                    </td> 
                                                    
                                                    <td>{{$products->supplier->name}}
                                                        {{-- @foreach(ProductSupplier($products->supplier_id) as $suppl)
                                                            {{$suppl->name}}
                                                        @endforeach --}}
                                                    </td> 
                                                
                                                    <td>{{$products->warehouse->name}}
                                                        {{-- @foreach(WareHouseDetails($products->ware_house_id) as $wareh)
                                                            {{$wareh->name}}
                                                        @endforeach --}}
                                                    </td> 
                                                    <td>
                                                        {{$products->deleted_at}}
							                        </td>
                                                    <td>
                                                        @if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                        {{-- @can('product-delete') --}}
                                                            <a href="{{route('product.undelete', $products->product_id)}}" 
                                                                onclick="return(confirmToRestore());" class="btn btn-success">
                                                                <i class="fa fa-trash-o">
                                                            </i>Restore</a>
                                                        @endif
                                                        
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