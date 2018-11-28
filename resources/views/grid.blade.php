@extends('layout.main')

@section('content')

    <script>

        const referral_url = "http://i.refs.cc/kdruSz4v?u=1234";

    </script>

    <div class="container">
        <h2>Ballsy Checkout Additions</h2>

        <div>
            <p>Additions to the Ballsy Checkout</p>
        </div>

        <div>
            <button onclick="ReferralModal.showReferral(referral_url)">Show Referral Modal</button>
        </div>

        <div>
            <button onclick="ReferralModal.showSignup('test@email.com', referral_url)">Show Signup Modal</button>
        </div>

        <div>
            <button onclick="ReferralModal.showConfirmation()">Show Confirmation</button>
        </div>

    </div>

    @include('partial/modal')

    <script>

        // const referral_url = "http://i.refs.cc/kdruSz4v?u=1234";

        // ReferralModal.showReferral(referral_url);

        ReferralModal.showSignup('test@email.com', referral_url);

        // ReferralModal.showConfirmation();
    </script>

@stop
