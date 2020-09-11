@extends('frontend.master')

@section('stylus')


@endsection


@section('content_frontend')
@include('frontend.section.navbar')
@include('frontend.section.sidebar')
@include('frontend.section.content')
@include('frontend.section.footer')



@endsection