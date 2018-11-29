import MicroModal from "micromodal";


let API_URL = 'https://ballsy.blue-hat.tech';

class ReferralModal {
    static showReferral(referral_url) {
        MicroModal.init({
            awaitCloseAnimation: true
        });

        const shareMessage = "Friends, keep the funk off your junk! Click my link to buy and save $5 on your first purchase and I’ll get $5!";

        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shareIn: "popup",
            text: shareMessage,
            url: referral_url,
            shares: [
                {share: "facebook", logo: 'fab fa-facebook-f'},
                {share: "twitter", logo: "fab fa-twitter"},
                {
                    share:"email",
                    logo: 'far fa-envelope',
                    shareUrl: `mailto:?subject=${encodeURI(shareMessage)}&body=${encodeURI(shareMessage + '\n\n' + referral_url)}`
                }]
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
            }, 5000)
        });

        MicroModal.show('modal-referral');
    }

    static showSignup(email, referral_url){
        MicroModal.init({
            awaitCloseAnimation: true
        });

        const $modal = $('#modal-signup');

        $modal.find('.copyable-text').html(referral_url);
        $modal.find('.copy-btn').data('clipboard-text', referral_url);

        $modal.find('[name="customer[email]"]').val(email);


        const $form = $modal.find('#create_customer');
        $modal.find('#create_customer').on('submit', (e) => {
            e.preventDefault();

            $modal.find('button.action_button').attr('disabled','disabled');
            $modal.find('.btn__content').css('opacity', 0);
            $modal.find('.btn__spinner').css('opacity', 1);


            $.post({
                url: API_URL + "/customer-activate",
                data: $form.serialize(),
                success: (result) => {
                    console.log(result)
                    if(!result.status){
                        $modal.find('.errors').html(result.message);

                    } else {
                        MicroModal.close('#modal-signup');

                        ReferralModal.showConfirmation();

                    }

                    $modal.find('.btn__content').css('opacity', 1);
                    $modal.find('.btn__spinner').css('opacity', 0);
                    $modal.find('button.action_button').attr('disabled',false);
                },
                error: (error) => {
                    $modal.find('.btn__content').css('opacity', 1);
                    $modal.find('.btn__spinner').css('opacity', 0);
                    $modal.find('button.action_button').attr('disabled',false);
                }
            })
        });


        MicroModal.show('modal-signup');
    }

    static showConfirmation(){

        MicroModal.show('modal-signup-complete');
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

