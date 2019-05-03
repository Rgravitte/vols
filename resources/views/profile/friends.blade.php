@extends('layouts.app')
@section('content')
<div class="container">
        <i class="text-small">*Search to add friends.</i>
        <form action="" class="form-inline border-form-one justify-between">


                <input type="text" placeholder="Name" class="input-group-text col-xs-3 col-md-3">

                <input type="text" placeholder="Email" class="input-group-text col-xs-3 col-md-3">


                <input type="number" placeholder="Phone #" class="input-group-text col-xs-3 col-md-3">


                <button class="btn bg-success btn-outline-dark col-xs-12 col-md-2">Search</button>

        </form>
</div>
@endsection
