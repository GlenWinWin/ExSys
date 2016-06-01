@extends('layouts.layout')

@section('title')
	Add Product
@stop

@section('body')
	{!! Form::open(['route' => 'product.store']) !!}

	{!! Form::label('name','Name') !!}
	{!! Form::text('name') !!}
	@if($errors->first('name') != '')
	<p style="color:red"><b>{{ $errors->first('name')}}</b></p>
	@endif
	<br>
	{!! Form::label('name','Price') !!}
	{!! Form::number('price',5,[
		'min' => '1',
		'max' => '20'
	]) !!}
	<p style="color:red"><b>{{ $errors->first('price')}}</b></p>
	<br><br>
	{!! Form::button('Submit', array(
            'type' => 'submit',
            'class'=> 'btn btn-info'    )) !!}

	{!! Form::close() !!}

	<center><a href="{{route('product.index')}}" class="btn btn-success btn-lg" title="Back"> <- BAck</a></center>
@stop
