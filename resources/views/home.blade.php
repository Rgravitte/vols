@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row display-even">
        <div class="col-xs-12 col-md-3">
            <div class="card bg-two border-color-two">
                <div class="card-header text-center nav-text-color-one bottom-white">
                    Account:
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="nav-text-color-one"><b class="nav-text-color-one">User: </b>{{ Auth::user()->name }}</li>
                        <li class="nav-text-color-one">Account Balance:</li>
                        <li class="nav-text-color-one">Pending:</li>
                        <li class="nav-text-color-one">Friends:</li>
                        <li class="nav-text-color-one">Settings</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="card">
                <div class="card-header border-color-two">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif Notificationns
                </div>
                <div class="card-body">
                    Open Bets
                </div>
                <div class="card-body">
                    Field
                </div>
                <div class="card-body">
                    Friends
                </div>
                <div class="card-body">
                    Friends
                </div>
                <div class="card-body">
                    Activity
                </div>
                <div class="card-body">
                    History
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
