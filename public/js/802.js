(self.webpackChunk=self.webpackChunk||[]).push([[802],{5167:(e,t,n)=>{"use strict";n.d(t,{Z:()=>a});var r=n(3645),o=n.n(r)()((function(e){return e[1]}));o.push([e.id,".avatar-img[data-v-e53a08f8]{height:60px;-o-object-fit:cover;object-fit:cover;width:60px}",""]);const a=o},2705:(e,t,n)=>{var r=n(5639).Symbol;e.exports=r},4239:(e,t,n)=>{var r=n(2705),o=n(9607),a=n(2333),l=r?r.toStringTag:void 0;e.exports=function(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":l&&l in Object(e)?o(e):a(e)}},7561:(e,t,n)=>{var r=n(7990),o=/^\s+/;e.exports=function(e){return e?e.slice(0,r(e)+1).replace(o,""):e}},1957:(e,t,n)=>{var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;e.exports=r},9607:(e,t,n)=>{var r=n(2705),o=Object.prototype,a=o.hasOwnProperty,l=o.toString,c=r?r.toStringTag:void 0;e.exports=function(e){var t=a.call(e,c),n=e[c];try{e[c]=void 0;var r=!0}catch(e){}var o=l.call(e);return r&&(t?e[c]=n:delete e[c]),o}},2333:e=>{var t=Object.prototype.toString;e.exports=function(e){return t.call(e)}},5639:(e,t,n)=>{var r=n(1957),o="object"==typeof self&&self&&self.Object===Object&&self,a=r||o||Function("return this")();e.exports=a},7990:e=>{var t=/\s/;e.exports=function(e){for(var n=e.length;n--&&t.test(e.charAt(n)););return n}},3279:(e,t,n)=>{var r=n(3218),o=n(7771),a=n(4841),l=Math.max,c=Math.min;e.exports=function(e,t,n){var i,s,u,d,f,p,m=0,v=!1,h=!1,y=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function N(t){var n=i,r=s;return i=s=void 0,m=t,d=e.apply(r,n)}function E(e){return m=e,f=setTimeout(b,t),v?N(e):d}function g(e){var n=e-p;return void 0===p||n>=t||n<0||h&&e-m>=u}function b(){var e=o();if(g(e))return V(e);f=setTimeout(b,function(e){var n=t-(e-p);return h?c(n,u-(e-m)):n}(e))}function V(e){return f=void 0,y&&i?N(e):(i=s=void 0,d)}function k(){var e=o(),n=g(e);if(i=arguments,s=this,p=e,n){if(void 0===f)return E(p);if(h)return clearTimeout(f),f=setTimeout(b,t),N(p)}return void 0===f&&(f=setTimeout(b,t)),d}return t=a(t)||0,r(n)&&(v=!!n.leading,u=(h="maxWait"in n)?l(a(n.maxWait)||0,t):u,y="trailing"in n?!!n.trailing:y),k.cancel=function(){void 0!==f&&clearTimeout(f),m=0,i=p=s=f=void 0},k.flush=function(){return void 0===f?d:V(o())},k}},3218:e=>{e.exports=function(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}},7005:e=>{e.exports=function(e){return null!=e&&"object"==typeof e}},3448:(e,t,n)=>{var r=n(4239),o=n(7005);e.exports=function(e){return"symbol"==typeof e||o(e)&&"[object Symbol]"==r(e)}},7771:(e,t,n)=>{var r=n(5639);e.exports=function(){return r.Date.now()}},4841:(e,t,n)=>{var r=n(7561),o=n(3218),a=n(3448),l=/^[-+]0x[0-9a-f]+$/i,c=/^0b[01]+$/i,i=/^0o[0-7]+$/i,s=parseInt;e.exports=function(e){if("number"==typeof e)return e;if(a(e))return NaN;if(o(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=o(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=r(e);var n=c.test(e);return n||i.test(e)?s(e.slice(2),n?2:8):l.test(e)?NaN:+e}},802:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>O});var r=n(821),o=function(e){return(0,r.pushScopeId)("data-v-e53a08f8"),e=e(),(0,r.popScopeId)(),e},a={class:"row justify-content-center"},l={class:"col-12"},c={class:"card mt-3"},i={class:"card-header"},s={class:"d-flex justify-content-between"},u=o((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-plus"},null,-1)})),d=(0,r.createTextVNode)(" Create "),f={class:"card-body"},p={class:"table"},m=o((function(){return(0,r.createElementVNode)("thead",{class:"thead-light"},[(0,r.createElementVNode)("tr",null,[(0,r.createElementVNode)("th",null,"SL"),(0,r.createElementVNode)("th",null,"Avatar"),(0,r.createElementVNode)("th",null,"Name"),(0,r.createElementVNode)("th",null,"Email"),(0,r.createElementVNode)("th",null,"Action")])],-1)})),v=["src"],h=o((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-pen-to-square"},null,-1)})),y=(0,r.createTextVNode)(" Edit "),N=["onClick"],E=[o((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-trash-can"},null,-1)})),(0,r.createTextVNode)(" Delete")],g={key:1},b=[o((function(){return(0,r.createElementVNode)("td",{colspan:"5",class:"text-center"},[(0,r.createElementVNode)("h3",null,"No User Found")],-1)}))];var V=n(9418),k=n(3279),x=n.n(k),j=n(9680);const B={props:{employees:Object,filters:Object||Array},components:{Pagination:V.Z,Inertia:j.Inertia},data:function(){return{search:this.filters.search}},methods:{deleteData:function(e){confirm("Are you sure to delete?")&&j.Inertia.delete(route("employees.destroy",e))}},watch:{search:x()((function(e){j.Inertia.get("users",{search:e},{preserveState:!0,replace:!0})}),500)}};var T=n(3379),w=n.n(T),S=n(5167),C={insert:"head",singleton:!1};w()(S.Z,C);S.Z.locals;const O=(0,n(3744).Z)(B,[["render",function(e,t,n,o,V,k){var x=(0,r.resolveComponent)("Head"),j=(0,r.resolveComponent)("Link"),B=(0,r.resolveComponent)("Pagination");return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[(0,r.createVNode)(x,{title:"Company List"}),(0,r.createElementVNode)("div",a,[(0,r.createElementVNode)("div",l,[(0,r.createElementVNode)("div",c,[(0,r.createElementVNode)("div",i,[(0,r.createElementVNode)("div",s,[(0,r.withDirectives)((0,r.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return V.search=e}),type:"text",placeholder:"Search..",class:"form-control w-50"},null,512),[[r.vModelText,V.search]]),(0,r.createVNode)(j,{href:e.route("employees.create"),class:"btn btn-primary"},{default:(0,r.withCtx)((function(){return[u,d]})),_:1},8,["href"])])]),(0,r.createElementVNode)("div",f,[(0,r.createElementVNode)("table",p,[m,(0,r.createElementVNode)("tbody",null,[n.employees&&n.employees.data.length?((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,{key:0},(0,r.renderList)(n.employees.data,(function(t,n){return(0,r.openBlock)(),(0,r.createElementBlock)("tr",{key:n},[(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(n+1),1),(0,r.createElementVNode)("td",null,[(0,r.createElementVNode)("img",{class:"rounded img-fluid avatar-img",src:t.avatar,alt:""},null,8,v)]),(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(t.name),1),(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(t.email),1),(0,r.createElementVNode)("td",null,[(0,r.createVNode)(j,{href:e.route("employees.edit",t.id),class:"btn btn-primary mx-1"},{default:(0,r.withCtx)((function(){return[h,y]})),_:2},1032,["href"]),(0,r.createElementVNode)("a",{onClick:function(e){return k.deleteData(t.id)},href:"#",class:"btn btn-danger mx-1"},E,8,N)])])})),128)):((0,r.openBlock)(),(0,r.createElementBlock)("tr",g,b))])]),(0,r.createVNode)(B,{links:n.employees.links},null,8,["links"])])])])])],64)}],["__scopeId","data-v-e53a08f8"]])},9418:(e,t,n)=>{"use strict";n.d(t,{Z:()=>c});var r=n(821),o={class:"pagination justify-content-center"},a=["innerHTML"];const l={props:{links:{type:Array,required:!0}}};const c=(0,n(3744).Z)(l,[["render",function(e,t,n,l,c,i){var s=(0,r.resolveComponent)("Link");return(0,r.openBlock)(),(0,r.createElementBlock)("nav",null,[(0,r.createElementVNode)("ul",o,[((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,null,(0,r.renderList)(n.links,(function(e,t){return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[e.url?((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:(0,r.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,r.createVNode)(s,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,r.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,a)]))],64)})),256))])])}]])}}]);