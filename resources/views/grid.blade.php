@extends('layout.main')

@section('content')

    <div class="container">
        <h2>Ballsy Checkout Additions</h2>

        <div>
            <p>Additions to the Ballsy Checkout</p>
        </div>

        <div>
            <button onclick="MicroModal.show('modal-referral')">Show Referral Modal</button>
        </div>

        <div>
            <button onclick="MicroModal.show('modal-signup')">Show Signup Modal</button>
        </div>

    </div>

    @include('partial/modal')

    <script>

        const referral_url = "http://i.refs.cc/kdruSz4v?u=1234";

        ReferralModal.showReferral(referral_url);

        // ReferralModal.showSignup('test@email.com', referral_url, 'https://ballsy.blue-hat.tech');
    </script>

@stop
