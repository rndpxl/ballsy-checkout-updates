import MicroModal from "micromodal";


let API_URL = process.env.APP_URL || 'http://localhost:8000';

class ReferralModal {
    static showReferral(referral_url) {
        MicroModal.init({
            awaitCloseAnimation: true
        });

        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shareIn: "popup",
            text: "$5 Off at Ballwash.com",
            url: referral_url,
            shares: [{share: "facebook", logo: 'fab fa-facebook-f'}, {share: "twitter", logo: "fab fa-twitter"},{share:"email", logo: 'far fa-envelope'}]
        });

        const $modal = $('#modal-referral.micromodal');

        $modal.find('.copyable-text').html(referral_url);
        $modal.find('.copy-btn').data('clipboard-text', referral_url);

        $(document).on('click', '.copy-btn', (e) => {
            const text = $(e.target).data('clipboard-text');
            this.copyTextToClipBoard(e.target, text);

            const $button = $(e.target);
            $button.text('Copied!');
            setTimeout(()=>{
                $button.text('Copy');
            }, 1000)
        });



        MicroModal.show('modal-referral');
    }

    static showSignup(first_name, last_name, email, referral_url){
        MicroModal.init({
            awaitCloseAnimation: true
        });

        const $modal = $('#modal-signup');

        $modal.find('.copyable-text').html(referral_url);
        $modal.find('.copy-btn').data('clipboard-text', referral_url);


        const $form = $modal.find('#create_customer');
        $modal.find('#create_customer').on('submit', (e) => {
            e.preventDefault();

            $.post({
                url: API_URL + "/customer-signup",
                data: $form.serialize(),
                success: (result) => {
                    console.log(result)
                    if(!result.status){
                        $modal.find('.errors').html(result.message);
                    } else {
                        MicroModal.close('#modal-signup');

                        ReferralModal.showReferral(referral_url);

                    }
                },
                error: (error) => {

                }
            })
        });


        MicroModal.show('modal-signup');
    }



    static copyTextToClipBoard(target, text){
        const el = document.createElement('textarea');
        el.value = text;
        target.insertBefore(el, null);
        el.select();

        var oldContentEditable = el.contentEditable,
            oldReadOnly = el.readOnly,
            range = document.createRange();

        el.contenteditable = true;
        el.readonly = false;
        range.selectNodeContents(el);

        var s = window.getSelection();
        s.removeAllRanges();
        s.addRange(range);

        el.setSelectionRange(0, 999999); // A big number, to cover anything that could be inside the element.

        el.contentEditable = oldContentEditable;
        el.readOnly = oldReadOnly;

        document.execCommand('copy');
        target.removeChild(el);
    }
}

window.ReferralModal = ReferralModal;

