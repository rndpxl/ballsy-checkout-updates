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

        const referral_url = "http://i.refs.cc/kdruSz4v?u=1542993278187";

        ReferralModal.init(referral_url);

    </script>

@stop
