(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[25],{

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "p[data-v-1bc0f64e] {\n  margin-bottom: 1rem;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/lib/css-base.js":
/*!*************************************************!*\
  !*** ./node_modules/css-loader/lib/css-base.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true& ***!
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("h1", { staticClass: "text--center" }, [
        _vm._v("Términos y Condiciones")
      ]),
      _vm._v(" "),
      _c("p", [
        _vm._v(
          "\n        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas earum\n        fuga ipsa quaerat officiis voluptatem impedit! Rerum, eum enim illo\n        ullam maiores minima, cupiditate qui, omnis corrupti ad autem\n        quod?Porro quasi in reiciendis voluptatem, molestiae maiores\n        quisquam asperiores, ipsam est molestias quae pariatur excepturi\n        consequatur! Eligendi soluta, error reprehenderit provident ipsa\n        quasi reiciendis fugit natus ratione consequuntur, voluptate maxime!\n        Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit vel\n        itaque officia atque ipsum, qui ea laudantium nam quasi quia,\n        consequatur reiciendis voluptates provident praesentium dolor\n        pariatur consectetur beatae modi? Totam accusamus laboriosam qui\n        tempore reiciendis hic laudantium deleniti ipsum inventore alias!\n        Distinctio voluptatibus, dolores nihil expedita nulla in nemo\n        quibusdam odio labore veniam vero porro vitae natus modi ratione.\n        Dolorem corrupti quae sed quasi nobis maxime nam, dolores minus\n        ullam voluptate dolore, reiciendis labore voluptatibus dolor modi\n        omnis quisquam mollitia et quas doloribus? Quae voluptates dolor\n    "
        )
      ]),
      _vm._v(" "),
      _c("h3", [_vm._v("Alias maiores, inventore dolorem")]),
      _vm._v(" "),
      _c("p", [
        _vm._v(
          "\n        corporis culpa! Cum? Error laborum neque vitae labore repellat quam\n        quia voluptatem? Repellendus illum ex maxime consequatur pariatur\n        sequi quo sint dolorum? Repudiandae expedita asperiores similique\n        mollitia in nisi non autem nulla commodi. Corporis corrupti at\n        libero sapiente deleniti totam atque neque nostrum ratione sed,\n        dolorum eos, est rem, dignissimos quod et consequatur maiores eaque\n        voluptas. Alias maiores, inventore dolorem asperiores aliquam nihil!\n        Amet ea velit provident saepe perspiciatis nostrum excepturi\n        necessitatibus est, aspernatur commodi odio autem quasi, ducimus\n        ullam labore distinctio non quae repudiandae ex aperiam maiores\n        quia? Quo vero maxime voluptates. Velit itaque ad maiores quas, ab,\n        temporibus quibusdam non fugit autem ratione quod dolores eum quia\n        exercitationem minima assumenda tenetur est aliquid. Molestias est\n        cupiditate id sed facere sapiente nobis. Sed veniam, temporibus\n        asperiores repellat tempore, id, cum enim animi nesciunt commodi\n        similique corporis! Exercitationem provident cupiditate consequuntur\n        optio omnis ipsam, assumenda natus eum minima nobis beatae\n        recusandae id quidem.\n    "
        )
      ]),
      _vm._v(" "),
      _c("h3", [_vm._v("Sed veniam, temporibus asperiores")]),
      _vm._v(" "),
      _c("p", [
        _vm._v(
          "\n        Lorem ipsum dolor sit amet consectetur adipisicing elit.\n        Consequuntur repellendus commodi nobis tempora dolorum explicabo\n        omnis reiciendis delectus vitae, minima est voluptate iure optio\n        corrupti nulla voluptatum. Voluptates, obcaecati\n        voluptatibus!Maiores quo, consequatur delectus, officia est culpa\n        error omnis harum similique iure impedit ullam neque ut. Ea quos\n        laudantium error tenetur maxime consequatur quae veniam. Culpa,\n        quae? Porro, repudiandae deserunt.\n    "
        )
      ]),
      _vm._v(" "),
      _c("h3", [_vm._v("Consectetur adipisicing elit")]),
      _vm._v(" "),
      _c("p", [
        _vm._v(
          "\n        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur\n        adipisci quod, voluptatem, quam reiciendis odio distinctio velit\n        porro illum facere veniam. Itaque laborum velit cumque quas, porro\n        minus commodi est? Earum voluptatem optio voluptatum ab ratione\n        neque modi cupiditate officiis. Laboriosam facilis accusantium ullam\n        architecto fugiat dolorem porro obcaecati, amet totam, quo eos saepe\n        inventore ipsa! Aspernatur laborum esse rerum. Id ab illum illo\n        laudantium sint obcaecati sequi dolorum, quia cumque non maxime,\n        debitis velit aperiam suscipit possimus, beatae odio nesciunt\n        laboriosam quibusdam fugiat tenetur in assumenda! Tempore, nisi!\n        Eius!\n    "
        )
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/pages/Terms.vue":
/*!**************************************!*\
  !*** ./resources/js/pages/Terms.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Terms.vue?vue&type=template&id=1bc0f64e&scoped=true& */ "./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true&");
/* harmony import */ var _Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& */ "./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");

var script = {}



/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  script,
  _Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1bc0f64e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/Terms.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& ***!
  \************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--7-2!../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../node_modules/vue-loader/lib??vue-loader-options!./Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=style&index=0&id=1bc0f64e&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_style_index_0_id_1bc0f64e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true&":
/*!*********************************************************************************!*\
  !*** ./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Terms.vue?vue&type=template&id=1bc0f64e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/Terms.vue?vue&type=template&id=1bc0f64e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Terms_vue_vue_type_template_id_1bc0f64e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);
//# sourceMappingURL=25.chunk.42803e3832dcad038a77.js.map