(self.webpackChunk=self.webpackChunk||[]).push([[83],{8619:(e,t,n)=>{"use strict";n.d(t,{Z:()=>o});var r=n(3645),a=n.n(r)()((function(e){return e[1]}));a.push([e.id,".avatar-img[data-v-1da5293e]{height:60px;-o-object-fit:cover;object-fit:cover;width:60px}",""]);const o=a},2705:(e,t,n)=>{var r=n(5639).Symbol;e.exports=r},4239:(e,t,n)=>{var r=n(2705),a=n(9607),o=n(2333),l=r?r.toStringTag:void 0;e.exports=function(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":l&&l in Object(e)?a(e):o(e)}},7561:(e,t,n)=>{var r=n(7990),a=/^\s+/;e.exports=function(e){return e?e.slice(0,r(e)+1).replace(a,""):e}},1957:(e,t,n)=>{var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;e.exports=r},9607:(e,t,n)=>{var r=n(2705),a=Object.prototype,o=a.hasOwnProperty,l=a.toString,c=r?r.toStringTag:void 0;e.exports=function(e){var t=o.call(e,c),n=e[c];try{e[c]=void 0;var r=!0}catch(e){}var a=l.call(e);return r&&(t?e[c]=n:delete e[c]),a}},2333:e=>{var t=Object.prototype.toString;e.exports=function(e){return t.call(e)}},5639:(e,t,n)=>{var r=n(1957),a="object"==typeof self&&self&&self.Object===Object&&self,o=r||a||Function("return this")();e.exports=o},7990:e=>{var t=/\s/;e.exports=function(e){for(var n=e.length;n--&&t.test(e.charAt(n)););return n}},3279:(e,t,n)=>{var r=n(3218),a=n(7771),o=n(4841),l=Math.max,c=Math.min;e.exports=function(e,t,n){var i,s,u,d,f,m,p=0,v=!1,h=!1,N=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function E(t){var n=i,r=s;return i=s=void 0,p=t,d=e.apply(r,n)}function b(e){return p=e,f=setTimeout(y,t),v?E(e):d}function g(e){var n=e-m;return void 0===m||n>=t||n<0||h&&e-p>=u}function y(){var e=a();if(g(e))return k(e);f=setTimeout(y,function(e){var n=t-(e-m);return h?c(n,u-(e-p)):n}(e))}function k(e){return f=void 0,N&&i?E(e):(i=s=void 0,d)}function V(){var e=a(),n=g(e);if(i=arguments,s=this,m=e,n){if(void 0===f)return b(m);if(h)return clearTimeout(f),f=setTimeout(y,t),E(m)}return void 0===f&&(f=setTimeout(y,t)),d}return t=o(t)||0,r(n)&&(v=!!n.leading,u=(h="maxWait"in n)?l(o(n.maxWait)||0,t):u,N="trailing"in n?!!n.trailing:N),V.cancel=function(){void 0!==f&&clearTimeout(f),p=0,i=m=s=f=void 0},V.flush=function(){return void 0===f?d:k(a())},V}},3218:e=>{e.exports=function(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}},7005:e=>{e.exports=function(e){return null!=e&&"object"==typeof e}},3448:(e,t,n)=>{var r=n(4239),a=n(7005);e.exports=function(e){return"symbol"==typeof e||a(e)&&"[object Symbol]"==r(e)}},7771:(e,t,n)=>{var r=n(5639);e.exports=function(){return r.Date.now()}},4841:(e,t,n)=>{var r=n(7561),a=n(3218),o=n(3448),l=/^[-+]0x[0-9a-f]+$/i,c=/^0b[01]+$/i,i=/^0o[0-7]+$/i,s=parseInt;e.exports=function(e){if("number"==typeof e)return e;if(o(e))return NaN;if(a(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=a(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=r(e);var n=c.test(e);return n||i.test(e)?s(e.slice(2),n?2:8):l.test(e)?NaN:+e}},2083:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>L});var r=n(821),a=function(e){return(0,r.pushScopeId)("data-v-1da5293e"),e=e(),(0,r.popScopeId)(),e},o={class:"row justify-content-center"},l={class:"col-12"},c={class:"card mt-3"},i={class:"card-header"},s={class:"d-flex justify-content-between"},u=a((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-plus"},null,-1)})),d=(0,r.createTextVNode)(" Create "),f={class:"card-body"},m={class:"table"},p=a((function(){return(0,r.createElementVNode)("thead",{class:"thead-light"},[(0,r.createElementVNode)("tr",null,[(0,r.createElementVNode)("th",null,"Avatar"),(0,r.createElementVNode)("th",null,"Name"),(0,r.createElementVNode)("th",null,"Email"),(0,r.createElementVNode)("th",null,"Action")])],-1)})),v=["src"],h=a((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-pen-to-square"},null,-1)})),N=(0,r.createTextVNode)(" Edit "),E=["onClick"],b=[a((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-trash-can"},null,-1)})),(0,r.createTextVNode)(" Delete")],g={key:1},y=[a((function(){return(0,r.createElementVNode)("td",{colspan:"5",class:"text-center"},[(0,r.createElementVNode)("h3",null,"No User Found")],-1)}))];var k=n(9418),V=n(3279),x=n.n(V),j=n(9680);const B={props:{admins:Object,filters:Object||Array},components:{Pagination:k.Z,Inertia:j.Inertia},data:function(){return{search:this.filters.search}},methods:{deleteStudent:function(e){confirm("Are you sure to delete?")&&j.Inertia.delete(route("admins.destroy",e))}},watch:{search:x()((function(e){j.Inertia.get("users",{search:e},{preserveState:!0,replace:!0})}),500)}};var T=n(3379),w=n.n(T),S=n(8619),C={insert:"head",singleton:!1};w()(S.Z,C);S.Z.locals;const O=(0,n(3744).Z)(B,[["render",function(e,t,n,a,k,V){var x=(0,r.resolveComponent)("Head"),j=(0,r.resolveComponent)("Link"),B=(0,r.resolveComponent)("Pagination");return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[(0,r.createVNode)(x,{title:"Admin List"}),(0,r.createElementVNode)("div",o,[(0,r.createElementVNode)("div",l,[(0,r.createElementVNode)("div",c,[(0,r.createElementVNode)("div",i,[(0,r.createElementVNode)("div",s,[(0,r.withDirectives)((0,r.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return k.search=e}),type:"text",placeholder:"Search..",class:"form-control w-50"},null,512),[[r.vModelText,k.search]]),(0,r.createVNode)(j,{href:e.route("admins.create"),class:"btn btn-primary"},{default:(0,r.withCtx)((function(){return[u,d]})),_:1},8,["href"])])]),(0,r.createElementVNode)("div",f,[(0,r.createElementVNode)("table",m,[p,(0,r.createElementVNode)("tbody",null,[n.admins&&n.admins.data.length?((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,{key:0},(0,r.renderList)(n.admins.data,(function(t,n){return(0,r.openBlock)(),(0,r.createElementBlock)("tr",{key:n},[(0,r.createElementVNode)("td",null,[(0,r.createElementVNode)("img",{class:"rounded img-fluid avatar-img",src:t.avatar,alt:""},null,8,v)]),(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(t.name),1),(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(t.email),1),(0,r.createElementVNode)("td",null,[(0,r.createVNode)(j,{href:e.route("admins.edit",t.id),class:"btn btn-primary mx-1"},{default:(0,r.withCtx)((function(){return[h,N]})),_:2},1032,["href"]),(0,r.createElementVNode)("a",{onClick:function(e){return V.deleteStudent(t.id)},href:"#",class:"btn btn-danger mx-1"},b,8,E)])])})),128)):((0,r.openBlock)(),(0,r.createElementBlock)("tr",g,y))])]),(0,r.createVNode)(B,{links:n.admins.links},null,8,["links"])])])])])],64)}],["__scopeId","data-v-1da5293e"]]),L=O},9418:(e,t,n)=>{"use strict";n.d(t,{Z:()=>c});var r=n(821),a={class:"pagination justify-content-center"},o=["innerHTML"];const l={props:{links:{type:Array,required:!0}}};const c=(0,n(3744).Z)(l,[["render",function(e,t,n,l,c,i){var s=(0,r.resolveComponent)("Link");return(0,r.openBlock)(),(0,r.createElementBlock)("nav",null,[(0,r.createElementVNode)("ul",a,[((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,null,(0,r.renderList)(n.links,(function(e,t){return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[e.url?((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:(0,r.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,r.createVNode)(s,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,r.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,o)]))],64)})),256))])])}]])}}]);