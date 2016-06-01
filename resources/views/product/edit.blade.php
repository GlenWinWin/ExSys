@extends('layouts.layout')

@section('title')
	Edit {{$product->name}}
@stop

@section('body')
	
	{!! Form::model($product, [
		'method' => 'patch',
		'route' => ['product.update',$product->id]
	])!!}
		{!! Form::label('name','Name') !!}
	{!! Form::text('name') !!}
	<br>
	{!! Form::label('name','Price') !!}
	{!! Form::text('price') !!}
	<br>
	{!! Form::button('Update Product',array(
		'type' => 'submit',
		'class' => 'btn btn-warning'
		)) !!}

	{!! Form::close()!!}

@stop