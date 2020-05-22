@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search For Trip</div>

                <div class="card-body">
                    <form action="#" method="post" novalidate="novalidate" class="p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 p-0">
                                        <select class="form-control" id="from_station">
                                            <option value="0" selected disabled>Select Start Station</option>
                                            @foreach ($stations as $station)
                                            <option value="{{ $station->slug }}">{{ $station->name }}</option>
                                            @endforeach
                                        </select>

                                        <strong id="from-station-errors" class="text-danger"></strong>
                                    </div>

                                    <div class="col-md-6 col-sm-12 p-0">
                                        <select class="form-control" id="to_station">
                                            <option value="0" selected disabled>Select End Station</option>
                                            @foreach ($stations as $station)
                                            <option value="{{ $station->slug }}">{{ $station->name }}</option>
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
        
        error_1.textContent = from_station == 0 ? "From Station Value is Required" : '';
        error_2.textContent = to_station == 0 ? "To Station Value is Required" : '';

        if (from_station == 0 || to_station == 0) {
            return ;
        }

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
                console.log(res);
            },
            error(err) {
                console.log(err);
            }
        })

    }
</script>
@endpush
@endsection