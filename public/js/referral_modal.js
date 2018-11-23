var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var ReferralModal = function () {
    function ReferralModal() {
        _classCallCheck(this, ReferralModal);
    }

    _createClass(ReferralModal, null, [{
        key: "init",
        value: function init(referral_url) {
            var _this = this;

            $("#share").jsSocials({
                showLabel: false,
                showCount: false,
                shareIn: "popup",
                text: "$5 Off at Ballwash.com",
                url: referral_url,
                shares: [{ share: "facebook", logo: 'fab fa-facebook-f' }, { share: "twitter", logo: "fab fa-twitter" }, { share: "email", logo: 'far fa-envelope' }]
            });

            $(document).on('click', '.copy-btn', function (e) {
                var text = $(e.target).data('clipboard-text');
                _this.copyTextToClipBoard(e.target, text);

                var $button = $(e.target);
                $button.text('Copied!');
                setTimeout(function () {
                    $button.text('Copy');
                }, 1000);
            });

            MicroModal.init({
                awaitCloseAnimation: true
            });
            MicroModal.show('modal-1');
        }
    }, {
        key: "copyTextToClipBoard",
        value: function copyTextToClipBoard(target, text) {
            var el = document.createElement('textarea');
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
    }]);

    return ReferralModal;
}();

window.ReferralModal = ReferralModal;
