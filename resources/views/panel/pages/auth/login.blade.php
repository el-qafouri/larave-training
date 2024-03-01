@extends('panel.pages.auth.layouts.main')
@section('styles')
    <style>
        .page-title {
            color: blue;
            font-size: 22px;
        }

    </style>
@endsection
@section('content')
    <h1 class="page-title"> Hello Eli </h1>
    <h1 class="text-3xl font-bold underline">
        Hello world!
    </h1>
    <div>
        <form action="{{ route('login') }}">
            @csrf
            @component('components.input' , [
    'label'=>'Username',
    'name'=>'username',
])@endcomponent
            @component('components.input' , [
    'label'=>'Password',
    'name'=>'password',
    'type'=>'password'
])@endcomponent

        </form>

    </div>
@endsection
@section('script')

@endsection
