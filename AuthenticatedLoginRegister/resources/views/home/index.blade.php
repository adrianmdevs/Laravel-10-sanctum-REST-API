@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <a class="btn btn-lg btn-primary" href="https://murigugitongah.wordpress.com" role="button">View my blog here &raquo;</a>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">You are viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection