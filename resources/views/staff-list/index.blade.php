@extends('layouts.app_staff')@push('css')    <link href="{{ asset('css/appStaffTreeIndex.css') }}" rel="stylesheet" type="text/css">    <link href="{{ asset('css/appListUsers.css') }}" rel="stylesheet" type="text/css">    {{--  Data Table plugin --}}    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">@endpush@section('header')    <header id="header_wrapper">        <div class="container">            <div class="header_box">                <nav class="navbar navbar-inverse" role="navigation">                    <div class="navbar-header">                        <div class="logo">                            <a href="{{ route('welcome') }}"><img id="logo-abz" src="{{ asset('img/abz.agency.jpg') }}"                                                                  alt="logo"></a>                        </div>                        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse"                                data-target="#main-nav"><span class="sr-only">Toggle navigation</span> <span                                    class="icon-bar"></span> <span class="icon-bar"></span> <span                                    class="icon-bar"></span>                        </button>                    </div>                    <div id="main-nav" class="collapse navbar-collapse navStyle" style="visibility: visible">                        <ul class="nav navbar-nav" id="mainNav">                            @if (Route::has('login'))                                @auth                                    <li><a class="scroll-link" href="{{ route('staff_list.index') }}">Home</a></li>                                @else                                    <li><a class="scroll-link" href="{{ route('login') }}">Login</a></li>                                    <li><a class="scroll-link" href="{{ route('register') }}">Register</a></li>                                @endauth                            @endif                        </ul>                    </div>                </nav>            </div>        </div>    </header>@endsection@section('content')    <div id="staff_list">        <div class="title">            <div class="alert">                <h2>List all Users with full information</h2>            </div>        </div>        <div class="container">            <div class="row">                <div class="col-md-12">                    <div class="alert">                        <a href="{{ route('staff_list.create') }}" class="btn btn-success">                            <i class="fa fa-plus" aria-hidden="true"></i>                            CREATE USER                        </a>                    </div>                </div>            </div>            <div class="row">                <div class="col-xl-12 col-md-12">                    <div class="app-users-list">                        <table class="nowrap table table-striped table-bordered dataTable" id="myTable">                            <thead class="table-secondary">                            </thead>                            <tbody>                            </tbody>                        </table>                    </div>                </div>            </div>        </div>    </div>@endsection@section('footer')    <footer class="footer_wrapper" id="contact">        <div class="container">            <div class="footer_bottom">                <span>Copyright © 2014, Template by                    <a href="http://abz.agency">abz.agency.com</a>.                </span>            </div>        </div>    </footer>@endsection@push('scripts')    {{--  Data Table plugin --}}    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>    <script type="text/javascript" src="{{ asset('js/datatable.js') }}"></script>@endpush