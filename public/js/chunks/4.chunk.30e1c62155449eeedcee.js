(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{"13S4":function(n,e,i){"use strict";var t=i("d4h1");i.n(t).a},"1xQc":function(n,e,i){(n.exports=i("I1BE")(!1)).push([n.i,"/* --------------------------------- Colors --------------------------------- */\n/* ------------------------------- Typography ------------------------------- */\n/* -------------------------------- Elevation ------------------------------- */\n/* -------------------------------------------------------------------------- */\n/*                                 Components                                 */\n/* -------------------------------------------------------------------------- */\n/* --------------------------------- Button --------------------------------- */\n/* ---------------------------------- Input --------------------------------- */\n/* -------------------------------- Checkbox -------------------------------- */\n/* ---------------------------------- Radio --------------------------------- */\n/* --------------------------------- Select --------------------------------- */\n.file[data-v-516b89e4]:not(:last-child) {\n  border-bottom: 1px solid #c2c8cc;\n}\n.file__container[data-v-516b89e4] {\n  padding: 0.75rem;\n}\n.file__container[data-v-516b89e4],\n.file__controls[data-v-516b89e4] {\n  display: flex;\n  align-items: center;\n}\n.file__icon[data-v-516b89e4] {\n  font-size: 2rem !important;\n}\n.file--is-image .file__icon[data-v-516b89e4] {\n  color: #f6993f;\n}\n.file--is-pdf .file__icon[data-v-516b89e4] {\n  color: #dc3545;\n}\n.file__name[data-v-516b89e4] {\n  white-space: nowrap !important;\n  overflow: hidden !important;\n  text-overflow: ellipsis !important;\n  max-width: 100%;\n  padding: 0 0.75rem;\n  flex-grow: 1;\n}\n.file__size[data-v-516b89e4] {\n  color: #a6afb4;\n  padding: 0 1rem;\n  margin-right: 0.5rem;\n  border-right: 1px solid #c2c8cc;\n}\n.file__controls .icon[data-v-516b89e4] {\n  font-size: 1.3rem;\n  cursor: pointer;\n}\n.icon-x[data-v-516b89e4] {\n  color: #dc3545;\n}",""])},N75w:function(n,e,i){"use strict";i.r(e);var t={props:{file:{type:[File,Object],required:!0},readonly:Boolean},methods:{formatSize:function(n){var e="KB",i=n/1024;return i>=700&&(i/=1024,e="MB"),i.toFixed(1)+e}},computed:{type:function(){var n=this.file.type;return n.includes("image")?"image":n.includes("pdf")?"pdf":void 0}}},a=(i("13S4"),i("KHd+")),o=Object(a.a)(t,(function(){var n=this,e=n.$createElement,i=n._self._c||e;return i("div",{staticClass:"file",class:["file--is-"+n.type]},[i("div",{staticClass:"file__container"},[i("div",[i("i",{staticClass:"file__icon icon",class:"icon-file-"+n.type})]),n._v(" "),i("p",{staticClass:"file__name"},[n._v("\n            "+n._s(n.file.name)+"\n        ")]),n._v(" "),i("div",{staticClass:"file__controls"},[i("span",{staticClass:"file__size"},[n._v(" "+n._s(n.formatSize(n.file.size))+" ")]),n._v(" "),n.readonly?i("a",{attrs:{href:n.file.path,download:n.file.name,target:"_blank",rel:"noopener noreferrer",title:"Descargar"}},[i("i",{staticClass:"icon icon-download"})]):i("i",{staticClass:"icon icon-x",attrs:{title:"Remover"},on:{click:function(e){return n.$emit("remove")}}})])])])}),[],!1,null,"516b89e4",null);e.default=o.exports},d4h1:function(n,e,i){var t=i("1xQc");"string"==typeof t&&(t=[[n.i,t,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};i("aET+")(t,a);t.locals&&(n.exports=t.locals)}}]);