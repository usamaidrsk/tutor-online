(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[34],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
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
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['email'],
  data: function data() {
    return {
      form: {}
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc& ***!
  \***************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c(
      "header",
      {
        staticClass: "text--center col-xs-6",
        staticStyle: { margin: "0 auto" }
      },
      [
        _c("h1", [_vm._v("Oops, algo esta mal")]),
        _vm._v(" "),
        _c("h3", { staticClass: "text--light" }),
        _vm._v(" "),
        _c("p", [
          _vm._v("\n            El correo "),
          _c("strong", [_vm._v(_vm._s(_vm.email))]),
          _vm._v(
            " esta ya esta en uso,\n            posiblemente hayas sido tu, antes de continuar debes decidir que\n            hacer.\n        "
          )
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        staticClass: "row col-xs-10 margin-top--three",
        staticStyle: { margin: "0 auto" }
      },
      [
        _c(
          "div",
          { staticClass: "col-xs-12 col-sm-6" },
          [
            _c("Radio", {
              attrs: {
                value: "0",
                label:
                  "Quiero descartar la propuesta antigua y crear una\n                nueva"
              },
              model: {
                value: _vm.form.option,
                callback: function($$v) {
                  _vm.$set(_vm.form, "option", $$v)
                },
                expression: "form.option"
              }
            })
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-xs-12 col-sm-6" },
          [
            _c("Radio", {
              attrs: {
                value: "1",
                label:
                  "Quiero descartar la propuesta antigua y crear una\n                nueva"
              },
              model: {
                value: _vm.form.option,
                callback: function($$v) {
                  _vm.$set(_vm.form, "option", $$v)
                },
                expression: "form.option"
              }
            })
          ],
          1
        )
      ]
    ),
    _vm._v("\n\n    " + _vm._s(_vm.form) + "\n")
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/asigment/Conflict.vue":
/*!**************************************************!*\
  !*** ./resources/js/pages/asigment/Conflict.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Conflict.vue?vue&type=template&id=271d49cc& */ "./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc&");
/* harmony import */ var _Conflict_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Conflict.vue?vue&type=script&lang=js& */ "./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Conflict_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/asigment/Conflict.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Conflict_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Conflict.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/asigment/Conflict.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Conflict_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc&":
/*!*********************************************************************************!*\
  !*** ./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Conflict.vue?vue&type=template&id=271d49cc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/asigment/Conflict.vue?vue&type=template&id=271d49cc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Conflict_vue_vue_type_template_id_271d49cc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=34.chunk.a7ec8d1db67a3d47aadd.js.map