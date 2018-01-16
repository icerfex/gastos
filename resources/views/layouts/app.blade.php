@extends('master')
@section('page')
    <!-- main header -->
    @include('layouts.header')
    <!-- main header end -->
    <!-- main top_bar -->
    @include('layouts.top_bar')
    <!-- main top_bar end -->
    <!-- main content -->
    @yield('content')
    <!-- main content end -->
@stop
@section('sindebar_body')
	
@stop