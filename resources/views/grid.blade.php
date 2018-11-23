@extends('layout.main')

@section('content')

    <div class="container">
        <h2>Ballsy Checkout Additions</h2>

        <div>
            <p>Additions to the Ballsy Checkout</p>
        </div>

        <div>
            <button onclick="MicroModal.show('modal-1')">Show Modal</button>
        </div>

    </div>

    @include('partial/modal')

    <script>

        MicroModal.init({
            awaitCloseAnimation: true
        });
        MicroModal.show('modal-1');
    </script>

@stop
