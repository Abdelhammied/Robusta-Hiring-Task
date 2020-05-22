@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search For Trip</div>

                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="#" method="post" novalidate="novalidate" class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 p-0">
                                        <select class="form-control" id="from_station">
                                            <option value="0" selected disabled>Select Start Station</option>
                                            @foreach ($stations as $station)
                                            <option value="{{ $station->slug }}">
                                                {{ $station->id . ' - ' . $station->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <strong id="from-station-errors" class="text-danger"></strong>
                                    </div>

                                    <div class="col-md-6 col-sm-12 p-0">
                                        <select class="form-control" id="to_station">
                                            <option value="0" selected disabled>Select End Station</option>
                                            @foreach ($stations as $station)
                                            <option value="{{ $station->slug }}">
                                                {{ $station->id . ' - ' . $station->name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <strong id="to-station-errors" class="text-danger"></strong>
                                    </div>
                                    <div class="col-sm-12 p-0 mt-3">
                                        <button type="button" class="btn btn-primary form-control" id="submit-btn"
                                            onclick="search()">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p id="response" class="mb-0"></p>
                                <div id="results">
                                    <ul id="trip-seats"></ul>
                                    <ul id="crossover-seats"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    const search = () => {
        let from_station = document.getElementById('from_station').value;
        let to_station = document.getElementById('to_station').value;
        let submit_button = document.getElementById("submit-btn");
        let error_1 = document.getElementById('from-station-errors');
        let error_2 = document.getElementById('to-station-errors');
        let response = document.getElementById("response");
        let trip_seats_result = document.getElementById('trip-seats'); 
        let crossover_seats_result = document.getElementById('crossover-seats'); 
    
        error_1.textContent = from_station == 0 ? "From Station Value is Required" : '';
        error_2.textContent = to_station == 0 ? "To Station Value is Required" : '';

        if (from_station == 0 || to_station == 0) {
            return ;
        }
        
        trip_seats_result.innerHTML = "";
        crossover_seats_result.innerHTML = "";
        submit_button.textContent = "Loading ...";
        submit_button.setAttribute('disabled', true);
        
        $.ajax({
            method: "GET",
            url: "{{ route('search') }}",   
            data: {
                from_station,
                to_station
            },
            success(res) {
                submit_button.removeAttribute('disabled');
                submit_button.textContent = "Search";

                if (res.trips.length == 0 && res.crossovers.length == 0) {
                    response.textContent = "No Available Trips / Crossovers";
                }

                if (res.trips.length == 0 && res.crossovers.length > 0) {
                    response.textContent = 'No Direct Trips Are Available But there are Crossovers available.'
                }

                if (res.trips.length > 0) {
                    let trip_seats = [];
                    let trip_seats_html = '';
                    
                    response.textContent = '';

                    res.trips.forEach(trip => {
                        trip_seats.push(...trip.seats)
                    })
                   
                    trip_seats.forEach(seat => {
                        trip_seats_html += `<li> <a href="/trip-seat/${seat.seat_uuid}"> Reserve Seat </a> </li>`;
                    });
                    
                    trip_seats_result.innerHTML = trip_seats_html;
                }

                if (res.crossovers.length > 0) {
                    let crossovers_seats = [];
                    let crossover_html = "";

                    res.crossovers.forEach(crossover => {
                        crossovers_seats.push(...crossover.trip.seats)
                    })

                    crossovers_seats.forEach(seat => {
                        crossover_html += `<li> <a href="/crossover-seat/${seat.seat_uuid}?from=${from_station}&to=${to_station}"> Reserve Seat </a> </li>`;
                    })

                    crossover_seats_result.innerHTML = crossover_html;                    
                }
            },
            error(err) {
                console.log(err);
            }
        })

    }
</script>
@endpush
@endsection