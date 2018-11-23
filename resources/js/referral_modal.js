
class ReferralModal {
    static init(referral_url) {
        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shareIn: "popup",
            text: "$5 Off at Ballwash.com",
            url: referral_url,
            shares: [{share: "facebook", logo: 'fab fa-facebook-f'}, {share: "twitter", logo: "fab fa-twitter"},{share:"email", logo: 'far fa-envelope'}]
        });



        $(document).on('click', '.copy-btn', (e) => {
            const text = $(e.target).data('clipboard-text');
            this.copyTextToClipBoard(e.target, text);

            const $button = $(e.target);
            $button.text('Copied!');
            setTimeout(()=>{
                $button.text('Copy');
            }, 1000)
        });


        MicroModal.init({
            awaitCloseAnimation: true
        });
        MicroModal.show('modal-1');
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

