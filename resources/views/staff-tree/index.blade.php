@extends('layouts.app_staff')@push('css')    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">@endpush@section('header')    <header id="header_wrapper">        <div class="container">            <div class="header_box">                <div class="logo"><a href="#"><img src="img/logo.png" alt="logo"></a></div>                <nav class="navbar navbar-inverse" role="navigation">                    <div class="navbar-header">                        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse"                                data-target="#main-nav"><span class="sr-only">Toggle navigation</span> <span                                    class="icon-bar"></span> <span class="icon-bar"></span> <span                                    class="icon-bar"></span>                        </button>                    </div>                    <div id="main-nav" class="collapse navbar-collapse navStyle" style="visibility: visible">                        <ul class="nav navbar-nav" id="mainNav">                            @if (Route::has('login'))                                @auth                                    <li><a class="scroll-link" href="{{ url('/home') }}">Home</a></li>                                @else                                    <li><a class="scroll-link" href="{{ route('login') }}">Login</a></li>                                    <li><a class="scroll-link" href="{{ route('register') }}">Register</a></li>                                @endauth                            @endif                        </ul>                    </div>                </nav>            </div>        </div>    </header>@endsection@section('content')    <div id="staff_tree">        <div class="container">            <div class="row">                <div class="col-md-12">                    <h1>                        {{--{{ dd($user->getChild->first()->childUsers) }}--}}                    </h1>                </div>            </div>        </div>    </div>@endsection@section('footer')    <footer class="footer_wrapper" id="contact">        <div class="container">            <div class="footer_bottom">            <span>Copyright © 2014, Template by                <a href="http://webthemez.com">abz.agency.com</a>.            </span>            </div>        </div>    </footer>@endsection@push('scripts')    <script type="text/javascript" src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>@endpush