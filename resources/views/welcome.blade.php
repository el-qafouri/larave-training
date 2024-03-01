@extends('.auth.layout')
@section('title' , 'home page')
@section('content')
{{--    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />--}}

    @php
        $breadcrumbs = [];
    @endphp

    @foreach ($breadcrumbs as $breadcrumb)
        <li><a href="{{ $breadcrumb['url'] }}"> {{ $breadcrumb['title'] }} </a></li>
    @endforeach



@endsection
