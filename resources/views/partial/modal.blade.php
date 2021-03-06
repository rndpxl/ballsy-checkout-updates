<div class="micromodal micromodal-slide" id="modal-referral" aria-hidden="true">
    <div class="micromodal__overlay" tabindex="-1" data-micromodal-close>
        <div class="micromodal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="micromodal__header">
                <h2 class="micromodal__title" id="modal-1-title">
                    Friends don't let friends have funky <span class="nuts">🌰🌰s</span>
                </h2>
                <button class="micromodal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="micromodal__content" id="modal-1-content">
                <div class="refer_img">
                    <img src="https://ballsy.blue-hat.tech/img/Friends.png">
                </div>
                <div class="refer_copy">
                    <p>
                        <span class="make-money">Make Money. Refer Friends.</span><br/>
                        <span class="you-get">You get $5 off. They get $5 off.</span> <br/>
                        Help the 🌎 become funk free.
                    </p>
                </div>

            </main>
            <footer class="micromodal__footer">
                <div class="social-share">
                    <p>Share on:</p>
                    <div class="storefront-card-social-buttons-component ember-view">

                        <div id="share" class="social-buttons-container">

                        </div>
                    </div>
                </div>
                <div class="link-share">

                    <div class="referral-explanation">
                        <p>Or copy and paste your link:</p>
                    </div>
                    <div id="ember1238" class="referral-link copyable-text-component ember-view">
                        <div class="copyable-text text-ellipsis">
                            http://i.refs.cc/kdruSz4v?u=1542993278187
                        </div>

                        <button style="touch-action: manipulation; -ms-touch-action: manipulation; cursor: pointer;" type="button" data-clipboard-text="http://i.refs.cc/kdruSz4v?u=1542993278187" id="ember1239" class="btn btn-primary copy-button background-primary copy-btn ember-view">  Copy</button>
                    </div>
                </div>

            </footer>
        </div>
    </div>
</div>

<div class="micromodal micromodal-slide" id="modal-signup" aria-hidden="true">
    <div class="micromodal__overlay" tabindex="-1" data-micromodal-close>
        <div class="micromodal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <div class="header__image" src="https://ballsy.blue-hat.tech/img/rewards_header_image.png" ></div>

            <header class="micromodal__header">
                <button class="micromodal__close" aria-label="Close modal" data-micromodal-close></button>


                <h2 class="micromodal__title" id="modal-1-title">

                    Earn Free Products, <span class="hide-on-mobile">Exclusive</span> Discounts and More!
                </h2>
                <h4 class="micromodal__subtitle">
                    Create a Ballsy rewards account.
                </h4>
            </header>
            <main class="micromodal__content" id="modal-1-content">

                {{--<p>Follow the link below to activate your account.</p>--}}

                <form method="post" action="/account" id="create_customer" accept-charset="UTF-8"><input type="hidden" name="form_type" value="create_customer">
                    <input type="hidden" name="utf8" value="✓">
                    <input name="store" type="hidden" value="ball-wash.myshopify.com"/>
                    <input type="hidden" name="customer[id]" value=""/>

                    <div class="errors"></div>

                    <div id="email" class="clearfix large_form">
                        <label for="email" class="login">Email</label>
                        <input type="email" value="" name="customer[email]" id="email" class="large" size="30" disabled>
                    </div>

                    {{--<div id="password" class="clearfix large_form">--}}
                        {{--<label for="password" class="login">Password</label>--}}
                        {{--<input type="password" value="" name="customer[password]" id="password" class="large password" size="30">--}}
                    {{--</div>--}}

                    <div class="action_bottom">
                        <button class="btn action_button" type="submit" value="Start Earning Rewards">
                            <span class="btn__content">Start Earning Rewards</span>
                            <i class="btn__spinner fas fa-circle-notch fa-spin"></i>
                        </button>
                    </div>

                </form>

            </main>
            <footer class="micromodal__footer">

            </footer>
        </div>
    </div>
</div>

<div class="micromodal micromodal-slide" id="modal-signup-complete" aria-hidden="true">
    <div class="micromodal__overlay" tabindex="-1" data-micromodal-close>
        <div class="micromodal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">

            <header class="micromodal__header">
                <button class="micromodal__close" aria-label="Close modal" data-micromodal-close></button>

            </header>
            <main class="micromodal__content" id="modal-1-content">

                <img class="vib-image" src="/img/VIB.png"/>

                <p>Incrediball!</p>

            </main>
            <footer class="micromodal__footer">
                <p>
                    You’re one step away from
                    being a Baller. Please check
                    your email to activate your
                    account.
                </p>
            </footer>
        </div>
    </div>
</div>