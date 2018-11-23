/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
module.exports = __webpack_require__(5);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var API_URL = Object({"MIX_PUSHER_APP_KEY":"","MIX_PUSHER_APP_CLUSTER":"mt1","NODE_ENV":"development"}).APP_URL || 'http://localhost:8000';

var ReferralModal = function () {
    function ReferralModal() {
        _classCallCheck(this, ReferralModal);
    }

    _createClass(ReferralModal, null, [{
        key: "showReferral",
        value: function showReferral(referral_url) {
            var _this = this;

            MicroModal.init({
                awaitCloseAnimation: true
            });

            $("#share").jsSocials({
                showLabel: false,
                showCount: false,
                shareIn: "popup",
                text: "$5 Off at Ballwash.com",
                url: referral_url,
                shares: [{ share: "facebook", logo: 'fab fa-facebook-f' }, { share: "twitter", logo: "fab fa-twitter" }, { share: "email", logo: 'far fa-envelope' }]
            });

            var $modal = $('#modal-1.micromodal');

            $modal.find('.copyable-text').html(referral_url);
            $modal.find('.copy-btn').data('clipboard-text', referral_url);

            $(document).on('click', '.copy-btn', function (e) {
                var text = $(e.target).data('clipboard-text');
                _this.copyTextToClipBoard(e.target, text);

                var $button = $(e.target);
                $button.text('Copied!');
                setTimeout(function () {
                    $button.text('Copy');
                }, 1000);
            });

            MicroModal.show('modal-1');
        }
    }, {
        key: "showSignup",
        value: function showSignup(first_name, last_name, email, referral_url) {
            MicroModal.init({
                awaitCloseAnimation: true
            });

            var $modal = $('#modal-signup');

            $modal.find('.copyable-text').html(referral_url);
            $modal.find('.copy-btn').data('clipboard-text', referral_url);

            var $form = $modal.find('#create_customer');
            $modal.find('#create_customer').on('submit', function (e) {
                e.preventDefault();

                $.post({
                    url: API_URL + "/customer-signup",
                    data: $form.serialize(),
                    success: function success(result) {
                        console.log(result);
                        if (!result.status) {
                            $modal.find('.errors').html(result.message);
                        } else {
                            MicroModal.close('#modal-signup');

                            ReferralModal.showReferral(referral_url);
                        }
                    },
                    error: function error(_error) {}
                });
            });

            MicroModal.show('modal-signup');
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

/***/ }),
/* 3 */,
/* 4 */,
/* 5 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);