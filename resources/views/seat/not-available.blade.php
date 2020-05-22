@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $seat->seat_uuid }}</div>

                <div class="card-body">
                    This Seat Is Not Available Right Now
                    <a href="#">Get Notification When Seat Is Availalbe</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection