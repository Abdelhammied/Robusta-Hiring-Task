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
                            @if ($seat->reserved_from == 'specific_station')
                            <p>
                                from: <strong>{{ $seat->checkInAt->name }}</strong>
                            </p>
                            @else
                            <p>
                                from: <strong>{{ $seat->trip->from->name }}</strong>
                            </p>
                            @endif

                            @if ($seat->reserved_to == 'specific_station')
                            <p>
                                to: <strong>{{ $seat->checkOutAt->name }}</strong>
                            </p>
                            @else
                            <p>
                                to: <strong>{{ $seat->trip->to->name }}</strong>
                            </p>
                            @endif
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