@if(session('message'))
    <div class="row">
        <div class="medium-12 columns">

            <div class="callout primary">
                <p>{{ session('message') }}</p>
            </div>

        </div>
    </div>
@endif