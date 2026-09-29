@extends('layouts.frontend')

@section('title', 'Portfolio ' . ($profile->full_name ?? 'Ahmad Zaki') . ' - ' . ($profile->profession ?? 'Backend Developer'))

@section('content')

@include('frontend.navbar')

@include('frontend.hero')

@include('frontend.about')

@include('frontend.skill')

@include('frontend.project')

@include('frontend.experience')

@include('frontend.education')

@include('frontend.certificate')

@include('frontend.service')

@include('frontend.review')

@include('frontend.contact')

@include('frontend.footer')

@endsection