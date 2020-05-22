@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $seat->seat_uuid }}</div>

                <div class="card-body">
                    <p>
                        This Seat Will Be Locked For You For <strong class="text-success" id="time">60</strong>
                        second(s)
                    </p>

                    <form action="{{ route('confirm-reserve-seat', $seat->seat_uuid) }}" method="POST">

                        @csrf

                        <button class="btn btn-primary" type="submit">Reserve</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    let timer = document.getElementById('time');

    if (localStorage.getItem('time')) {
        document.getElementById('time').innerText = localStorage.getItem('time')
    }
    
    setInterval(function(){
        let time = timer.innerText - 1;
       
        timer.innerText = time ;
        
        localStorage.setItem('time', time)
        
        if (timer.innerText <= 0) {
            localStorage.removeItem('time')
            
            window.location.href = "{{ route('home') }}";
        }
    }, 1000)
</script>
@endpush
@endsection