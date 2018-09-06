@extends('layouts.app_staff')@push('css')    <link href="{{ asset('css/appStaffTreeIndex.css') }}" rel="stylesheet" type="text/css">    <link href="{{ asset('css/appListUsers.css') }}" rel="stylesheet" type="text/css">@endpush@section('header')    @include('staff-list.header_staff_list')@endsection@section('content')    <div id="staff_list">        <div class="title">            <div class="alert">                <h2>Create new User</h2>            </div>        </div>        <div class="container">            <div class="row">                <div class="col-md-12">                    <div>                        <a href="{{ route('staff_list.index') }}" class="btn btn-default btn-sm">                            <i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"> Users list</i>                        </a>                        <hr>                    </div>                </div>            </div>            <div class="row">                <div class="app-users-show">                    <div class="col-md-8 col-sm-8 col-sm-offset-2 col-md-offset-2">                        <div class="row">                            <div class="col-md-4 col-md-offset-4">                                <h4 class="app-user-fullName">                                    Create User                                    <i class="fa fa-user text-danger" aria-hidden="true"></i>                                </h4>                            </div>                        </div>                        <form method="POST" action="{{ route('staff_list.save') }}" aria-label="Create">                            @csrf                            <div class="row">                                <div class="col-md-6 col-xs-12">                                    <div class="form-group">                                        <label for="surname" class="col-form-label">{{ __('Surname') }}</label>                                        <input id="surname" type="text"                                               class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}"                                               name="surname" value="{{ old('surname') }}" required autofocus>                                        @if ($errors->has('surname'))                                            <span class="invalid-feedback" role="alert">                                                <strong>{{ $errors->first('surname') }}</strong>                                            </span>                                        @endif                                    </div>                                    <div class="form-group ">                                        <label for="first_name" class="col-form-label">{{ __('First name') }}</label>                                        <input id="first_name" type="text"                                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"                                               name="first_name" value="{{ old('first_name') }}" required>                                        @if ($errors->has('first_name'))                                            <span class="invalid-feedback" role="alert">                                               <strong>{{ $errors->first('first_name') }}</strong>                                            </span>                                        @endif                                    </div>                                    <div class="form-group ">                                        <label for="patronymic"                                               class=" col-form-label">{{ __('Patronymic') }}</label>                                        <input id="patronymic" type="text"                                               class="form-control{{ $errors->has('patronymic') ? ' is-invalid' : '' }}"                                               name="patronymic" value="{{ old('patronymic') }}" required>                                        @if ($errors->has('patronymic'))                                            <span class="invalid-feedback" role="alert">                                                 <strong>{{ $errors->first('patronymic') }}</strong>                                            </span>                                        @endif                                    </div>                                    <div class="form-group">                                        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>                                        <input id="email" type="email"                                               class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"                                               name="email" value="{{ old('email') }}" required>                                        @if ($errors->has('email'))                                            <span class="invalid-feedback" role="alert">                                                <strong>{{ $errors->first('email') }}</strong>                                            </span>                                        @endif                                    </div>                                </div>                                <div class="col-md-6 col-xs-12">                                    <div class="form-group">                                        <div class="row">                                            <div class="col-md-6">                                                <label for="position_id"                                                       class="col-form-label">{{ __('Position') }}</label>                                                <select class="form-control {{ $errors->has('position_id') ? ' is-invalid' : '' }}"                                                        name="position_id" id="position_id">                                                    @foreach($positions as $value)                                                        <option                                                                @if(isset($user) && $value->id == $user->position_id)                                                                selected                                                                @endif                                                                value="{{ $value->id }}">{{ $value->position_name }}</option>                                                    @endforeach                                                </select>                                                @if ($errors->has('position_id'))                                                    <span class="invalid-feedback" role="alert">                                                        <strong>{{ $errors->first('position_id') }}</strong>                                                    </span>                                                @endif                                            </div>                                            <div class="col-md-6">                                                <label for="boss_id" class="col-form-label">{{ __('Boss') }}</label>                                                <select class="form-control {{ $errors->has('boss_id') ? ' is-invalid' : '' }}"                                                        name="boss_id" id="boss_id">                                                    <option value="null" disabled="" selected="">Boss Name</option>                                                </select>                                                @if ($errors->has('position_id'))                                                    <span class="invalid-feedback" role="alert">                                                        <strong>{{ $errors->first('position_id') }}</strong>                                                    </span>                                                @endif                                            </div>                                        </div>                                    </div>                                    <div class="form-group ">                                        <label for="amount_of_wages"                                               class="col-form-label">{{ __('Amount of wages - "UAN"') }}</label>                                        <input id="amount_of_wages" type="number" min="3800" max="400000" step="0.01"                                               class="form-control{{ $errors->has('amount_of_wages') ? ' is-invalid' : '' }}"                                               name="amount_of_wages" value="{{ old('amount_of_wages') }}" required>                                        @if ($errors->has('amount_of_wages'))                                            <span class="invalid-feedback" role="alert">                                                 <strong>{{ $errors->first('amount_of_wages') }}</strong>                                            </span>                                        @endif                                    </div>                                    <div class="form-group ">                                        <label for="password"                                               class=" col-form-label">{{ __('Password') }}</label>                                        <input id="password" type="password"                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"                                               name="password" required>                                        @if ($errors->has('password'))                                            <span class="invalid-feedback" role="alert">                                                <strong>{{ $errors->first('password') }}</strong>                                            </span>                                        @endif                                    </div>                                    <div class="form-group">                                        <label for="password-confirm"                                               class="col-form-label">{{ __('Confirm Password') }}</label>                                        <input id="password-confirm" type="password" class="form-control"                                               name="password_confirmation" required>                                    </div>                                    <div class="form-group pull-right mb-0">                                        <button type="submit" class="btn btn-success">                                            {{ __('Save user') }}                                        </button>                                    </div>                                </div>                            </div>                        </form>                    </div>                </div>            </div>        </div>    </div>@endsection@section('footer')    @include('staff-list.footer_staff_list')@endsection@push('scripts')    {{-- Custom style --}}    <script type="text/javascript" src="{{ asset('js/bossUpdate.js') }}"></script>@endpush