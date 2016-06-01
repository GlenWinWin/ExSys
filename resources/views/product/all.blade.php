@extends('layouts.layout')

@section('title')
	All product
@stop

@section('body')
	<table align="center" class="table table-hover table-striped" style="width:30%">

		<tr>
			<th><center>Name</center></th>
			<th><center>Price</center></th>
			<th colspan="2"><center>Action</center></th>
		</tr>

		@foreach($products as $pro)
		<tr>
			<td><center>{{$pro->name}}</center></td>
			<td><center>{{$pro->price}}</center></td>
			<td colspan="2">
				<center>
					<a class="btn btn-round btn-success" href="{{route('product.edit',$pro->id)}}" title="Edit"><span class="glyphicon glyphicon-pencil"></a>
					<a href="{{URL::action('ProductController@destroy',['id'=>$pro->id]) }}"
						onclick=" return confirm('Are you sure you want to delete this product?')"
						class="btn btn-danger btn-round" title="Remove"><span class="glyphicon glyphicon-trash"></a>
				</center>
			</td>
		</tr>
		@endforeach
	 </table>
	 <center>{!! $products->render() !!}</center>
	<center><a href="{{route('product.create')}}" class="btn btn-info btn-lg" title="Add"><span class="glyphicon glyphicon-plus"></span> Product</a></center>
@stop
