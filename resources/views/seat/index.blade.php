@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Seats</div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($seats as $seat)
                        <div class="col-md-8">
                            <p>
                                Seat UuId: <strong>{{ $seat->seat_uuid }}</strong>
                            </p>
                            <p>
                                Reservation UuId: <strong>{{ $seat->reservation_uuid }}</strong>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p>
                                from: <strong>{{ $seat->trip->from->name }}</strong>
                            </p>
                            <p>
                                to: <strong>{{ $seat->trip->to->name }}</strong>
                            </p>
                        </div>
                        <div class="col-12">
                            <hr>
                            <br>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection