@extends('layouts.master')

@section('asset')
	<!--<link rel="stylesheet" href="{{ asset('packages/datatables/css/jquery.dataTables.css') }}" />
	<script src="{{ asset('packages/datatables/js/jquery.dataTables.js') }}"></script> -->
	<link rel="stylesheet" href="{{ asset('packages/datatables/css/jquery.dataTables.css')}}" />
	<script src="{{ asset('packages/datatables/js/jquery.dataTables.js')}}"></script>
@stop

@section('title')
	{{ $title }}
@stop

@section('breadcrumb')
	<li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
    <li class="uk-active">{{ $title }}</li>
@stop

@section('content')
	Tambah Author <br>
	{{ Datatable::table()
    	->addColumn('id','Nama', '')       // these are the column headings to be shown
    	->setOptions('aoColumnDefs',array(
        	array(
            	'bVisible' => false,
            	'aTargets' => [0]),
        	array(
            	'sTitle' => 'Nama',
            	'aTargets' => [1]),
        	array(
            	'bSortable' => false,
            	'aTargets' => [2])
        	))
    	->setOptions('bProcessing', true)
    	->setUrl(route('admin.authors.index'))   // this is the route where data will be retrieved
    	->render('datatable.uikit') }}
@stop