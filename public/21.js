(window.webpackJsonp=window.webpackJsonp||[]).push([[21],{"58TA":function(r,t,e){"use strict";var a=e("cTUR");e.n(a).a},H5DE:function(r,t,e){(r.exports=e("I1BE")(!1)).push([r.i,"/* --------------------------------- Colors --------------------------------- */\n/* ------------------------------- Typography ------------------------------- */\n/* -------------------------------- Elevation ------------------------------- */\n/* -------------------------------------------------------------------------- */\n/*                                 Components                                 */\n/* -------------------------------------------------------------------------- */\n/* --------------------------------- Button --------------------------------- */\n/* ---------------------------------- Input --------------------------------- */\n/* -------------------------------- Checkbox -------------------------------- */\n/* ---------------------------------- Radio --------------------------------- */\n/* --------------------------------- Select --------------------------------- */\n.register__form[data-v-9328e158] {\n  width: 490px;\n  max-width: 100%;\n  margin: 0 auto;\n}",""])},cTUR:function(r,t,e){var a=e("H5DE");"string"==typeof a&&(a=[[r.i,a,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(a,s);a.locals&&(r.exports=a.locals)},fjoP:function(r,t,e){"use strict";e.r(t);var a=e("o0o1"),s=e.n(a);function o(r,t,e,a,s,o,n){try{var i=r[o](n),l=i.value}catch(r){return void e(r)}i.done?t(l):Promise.resolve(l).then(a,s)}var n={data:function(){return{form:{first_name:null,last_name:null,email:null,password:null,accepTerms:!1},loading:!1,error:null,errors:new ErrorBag}},methods:{handleSubmit:function(){var r,t=this;return(r=s.a.mark((function r(){return s.a.wrap((function(r){for(;;)switch(r.prev=r.next){case 0:if(!t.loading){r.next=2;break}return r.abrupt("return");case 2:return r.prev=2,t.loading=!0,r.next=6,t.$http.post("register",t.form);case 6:window.location.href=route("questions",1),r.next=14;break;case 9:r.prev=9,r.t0=r.catch(2),t.loading=!1,console.error(r.t0),r.t0.response&&(console.error(r.t0.response),window.scrollTo({top:0,behavior:"smooth"}),t.errors.set(r.t0.response.data.errors));case 14:case"end":return r.stop()}}),r,null,[[2,9]])})),function(){var t=this,e=arguments;return new Promise((function(a,s){var n=r.apply(t,e);function i(r){o(n,a,s,i,l,"next",r)}function l(r){o(n,a,s,i,l,"throw",r)}i(void 0)}))})()}}},i=(e("58TA"),e("KHd+")),l=Object(i.a)(n,(function(){var r=this,t=r.$createElement,e=r._self._c||t;return e("div",{staticClass:"registe"},[e("form",{staticClass:"register__form",on:{submit:function(t){return t.preventDefault(),r.handleSubmit(t)}}},[e("header",{staticClass:"text--center margin-bottom--two"},[e("h1",{staticClass:"margin-bottom--quarter"},[r._v("\n                Unete a nuestra plataforma\n            ")]),r._v(" "),e("p",[e("span",[r._v("¿Ya eres miembro?")]),r._v(" "),e("a",{staticClass:"link",attrs:{href:r.route("login")}},[r._v("Iniciar sesión")])])]),r._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-xs-12 col-sm-6"},[e("Input",{attrs:{label:"nombres",required:"",autocomplete:"name",autofocus:"",error:r.errors.first("first_name")},model:{value:r.form.first_name,callback:function(t){r.$set(r.form,"first_name",t)},expression:"form.first_name"}})],1),r._v(" "),e("div",{staticClass:"col-xs-12 col-sm-6"},[e("Input",{attrs:{label:"apellidos",error:r.errors.first("last_name"),required:""},model:{value:r.form.last_name,callback:function(t){r.$set(r.form,"last_name",t)},expression:"form.last_name"}})],1)]),r._v(" "),e("Input",{attrs:{label:"email",type:"email",autocomplete:"email",error:r.errors.first("email"),required:""},model:{value:r.form.email,callback:function(t){r.$set(r.form,"email",t)},expression:"form.email"}}),r._v(" "),e("Input",{attrs:{label:"contraseña",placeholder:"6+ caracteres",type:"password",autocomplete:"new-password",error:r.errors.first("password"),required:""},model:{value:r.form.password,callback:function(t){r.$set(r.form,"password",t)},expression:"form.password"}}),r._v(" "),e("Button",{staticClass:"margin-top--two",attrs:{type:"submit",block:"",loading:r.loading}},[r._v("registrarse")]),r._v(" "),e("div",{staticClass:"margin-top--one"},[e("p",{staticClass:"text--small",attrs:{for:"terms"}},[e("span",[r._v("Al registrarte aceptas los")]),r._v(" "),e("a",{staticClass:"link",attrs:{href:r.route("terms"),target:"_blank"}},[r._v("Términos y Condiciones")]),r._v(" "),e("span",[r._v("y las")]),r._v(" "),e("a",{staticClass:"link",attrs:{href:r.route("privacy-policy"),target:"_blank"}},[r._v("Políticas de Privacidad")])])])],1)])}),[],!1,null,"9328e158",null);t.default=l.exports}}]);