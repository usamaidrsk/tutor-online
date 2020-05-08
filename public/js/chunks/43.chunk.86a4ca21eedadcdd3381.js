(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[43],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Payment.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['asigment'],
  data: function data() {
    return {};
  },
  mounted: function mounted() {
    var _this = this;

    var script = document.createElement('script');

    script.onload = function () {
      return _this.setupPayPalButton();
    };

    script.async = true;
    script.src = 'https://www.paypalobjects.com/api/checkout.js';
    document.head.appendChild(script);
  },
  methods: {
    setupPayPalButton: function setupPayPalButton() {
      paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
          sandbox: 'demo_sandbox_client_id',
          production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'es_ES',
        style: {
          size: 'large',
          color: 'gold',
          shape: 'pill'
        },
        commit: true,
        // Enable Pay Now checkout flow (optional)
        payment: this.handlePayment.bind(this),
        // Set up a payment
        onAuthorize: this.handleOnAuthorize.bind(this) // Execute the payment

      }, '#paypal-button');
    },
    handlePayment: function handlePayment(data, actions) {
      var budget = this.asigment.budget;
      return actions.payment.create({
        transactions: [{
          amount: {
            total: budget,
            currency: 'USD'
          }
        }]
      });
    },
    handleOnAuthorize: function handleOnAuthorize(data, actions) {
      var id = this.asigment.id;
      return actions.payment.execute().then(function () {
        return window.location.href = route('room', id);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-resources-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-3!./node_modules/sass-loader/dist/cjs.js??ref--6-4!./node_modules/sass-resources-loader/lib/loader.js??ref--6-5!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "/* --------------------------------- Colors --------------------------------- */\n/* ------------------------------- Typography ------------------------------- */\n/* -------------------------------- Elevation ------------------------------- */\n/* -------------------------------------------------------------------------- */\n/*                                 Components                                 */\n/* -------------------------------------------------------------------------- */\n/* --------------------------------- Button --------------------------------- */\n/* ---------------------------------- Input --------------------------------- */\n/* -------------------------------- Checkbox -------------------------------- */\n/* ---------------------------------- Radio --------------------------------- */\n/* --------------------------------- Select --------------------------------- */\n/* --------------------------------- Colors --------------------------------- */\n/* ------------------------------- Typography ------------------------------- */\n/* -------------------------------- Elevation ------------------------------- */\n/* -------------------------------------------------------------------------- */\n/*                                 Components                                 */\n/* -------------------------------------------------------------------------- */\n/* --------------------------------- Button --------------------------------- */\n/* ---------------------------------- Input --------------------------------- */\n/* -------------------------------- Checkbox -------------------------------- */\n/* ---------------------------------- Radio --------------------------------- */\n/* --------------------------------- Select --------------------------------- */\n.wrapper[data-v-be3450e6] {\n  height: 100%;\n  display: flex;\n  text-align: center;\n  align-items: center;\n  justify-content: center;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/extract-text-webpack-plugin/dist/loader.js?!./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-resources-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/extract-text-webpack-plugin/dist/loader.js??ref--6-0!./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-3!./node_modules/sass-loader/dist/cjs.js??ref--6-4!./node_modules/sass-resources-loader/lib/loader.js??ref--6-5!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-3!../../../node_modules/sass-loader/dist/cjs.js??ref--6-4!../../../node_modules/sass-resources-loader/lib/loader.js??ref--6-5!../../../node_modules/vue-loader/lib??vue-loader-options!./Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-resources-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "wrapper" }, [
    _c("div", [
      _c("h1", [_vm._v("Pago")]),
      _vm._v(" "),
      _c("h3", [_vm._v("TOTAL: $" + _vm._s(_vm.asigment.budget))]),
      _vm._v(" "),
      _c("div", { attrs: { id: "paypal-button" } })
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/Payment.vue":
/*!****************************************!*\
  !*** ./resources/js/pages/Payment.vue ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Payment.vue?vue&type=template&id=be3450e6&scoped=true& */ "./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true&");
/* harmony import */ var _Payment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Payment.vue?vue&type=script&lang=js& */ "./resources/js/pages/Payment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& */ "./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Payment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "be3450e6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/Payment.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/Payment.vue?vue&type=script&lang=js&":
/*!*****************************************************************!*\
  !*** ./resources/js/pages/Payment.vue?vue&type=script&lang=js& ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Payment.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/extract-text-webpack-plugin/dist/loader.js??ref--6-0!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-3!../../../node_modules/sass-loader/dist/cjs.js??ref--6-4!../../../node_modules/sass-resources-loader/lib/loader.js??ref--6-5!../../../node_modules/vue-loader/lib??vue-loader-options!./Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true& */ "./node_modules/extract-text-webpack-plugin/dist/loader.js?!./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/sass-resources-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=style&index=0&id=be3450e6&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_extract_text_webpack_plugin_dist_loader_js_ref_6_0_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_3_node_modules_sass_loader_dist_cjs_js_ref_6_4_node_modules_sass_resources_loader_lib_loader_js_ref_6_5_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_style_index_0_id_be3450e6_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true&":
/*!***********************************************************************************!*\
  !*** ./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Payment.vue?vue&type=template&id=be3450e6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Payment.vue?vue&type=template&id=be3450e6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Payment_vue_vue_type_template_id_be3450e6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=43.chunk.86a4ca21eedadcdd3381.js.map