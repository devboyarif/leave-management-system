(self.webpackChunk=self.webpackChunk||[]).push([[151],{9314:(e,t,n)=>{"use strict";n.d(t,{Z:()=>a});var r=n(3645),o=n.n(r)()((function(e){return e[1]}));o.push([e.id,".avatar-img[data-v-c01713c6]{height:60px;-o-object-fit:cover;object-fit:cover;width:60px}",""]);const a=o},2705:(e,t,n)=>{var r=n(5639).Symbol;e.exports=r},4239:(e,t,n)=>{var r=n(2705),o=n(9607),a=n(2333),l=r?r.toStringTag:void 0;e.exports=function(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":l&&l in Object(e)?o(e):a(e)}},7561:(e,t,n)=>{var r=n(7990),o=/^\s+/;e.exports=function(e){return e?e.slice(0,r(e)+1).replace(o,""):e}},1957:(e,t,n)=>{var r="object"==typeof n.g&&n.g&&n.g.Object===Object&&n.g;e.exports=r},9607:(e,t,n)=>{var r=n(2705),o=Object.prototype,a=o.hasOwnProperty,l=o.toString,c=r?r.toStringTag:void 0;e.exports=function(e){var t=a.call(e,c),n=e[c];try{e[c]=void 0;var r=!0}catch(e){}var o=l.call(e);return r&&(t?e[c]=n:delete e[c]),o}},2333:e=>{var t=Object.prototype.toString;e.exports=function(e){return t.call(e)}},5639:(e,t,n)=>{var r=n(1957),o="object"==typeof self&&self&&self.Object===Object&&self,a=r||o||Function("return this")();e.exports=a},7990:e=>{var t=/\s/;e.exports=function(e){for(var n=e.length;n--&&t.test(e.charAt(n)););return n}},3279:(e,t,n)=>{var r=n(3218),o=n(7771),a=n(4841),l=Math.max,c=Math.min;e.exports=function(e,t,n){var i,s,u,d,p,m,f=0,v=!1,h=!1,y=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function b(t){var n=i,r=s;return i=s=void 0,f=t,d=e.apply(r,n)}function g(e){return f=e,p=setTimeout(E,t),v?b(e):d}function k(e){var n=e-m;return void 0===m||n>=t||n<0||h&&e-f>=u}function E(){var e=o();if(k(e))return N(e);p=setTimeout(E,function(e){var n=t-(e-m);return h?c(n,u-(e-f)):n}(e))}function N(e){return p=void 0,y&&i?b(e):(i=s=void 0,d)}function x(){var e=o(),n=k(e);if(i=arguments,s=this,m=e,n){if(void 0===p)return g(m);if(h)return clearTimeout(p),p=setTimeout(E,t),b(m)}return void 0===p&&(p=setTimeout(E,t)),d}return t=a(t)||0,r(n)&&(v=!!n.leading,u=(h="maxWait"in n)?l(a(n.maxWait)||0,t):u,y="trailing"in n?!!n.trailing:y),x.cancel=function(){void 0!==p&&clearTimeout(p),f=0,i=m=s=p=void 0},x.flush=function(){return void 0===p?d:N(o())},x}},3218:e=>{e.exports=function(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}},7005:e=>{e.exports=function(e){return null!=e&&"object"==typeof e}},3448:(e,t,n)=>{var r=n(4239),o=n(7005);e.exports=function(e){return"symbol"==typeof e||o(e)&&"[object Symbol]"==r(e)}},7771:(e,t,n)=>{var r=n(5639);e.exports=function(){return r.Date.now()}},4841:(e,t,n)=>{var r=n(7561),o=n(3218),a=n(3448),l=/^[-+]0x[0-9a-f]+$/i,c=/^0b[01]+$/i,i=/^0o[0-7]+$/i,s=parseInt;e.exports=function(e){if("number"==typeof e)return e;if(a(e))return NaN;if(o(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=o(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=r(e);var n=c.test(e);return n||i.test(e)?s(e.slice(2),n?2:8):l.test(e)?NaN:+e}},151:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>_});var r=n(821),o={class:"row justify-content-center"},a={class:"col-12"},l={class:"card mt-3"},c={class:"card-header"},i={class:"d-flex justify-content-between"},s=["placeholder"],u=function(e){return(0,r.pushScopeId)("data-v-c01713c6"),e=e(),(0,r.popScopeId)(),e}((function(){return(0,r.createElementVNode)("i",{class:"fa-solid fa-plus"},null,-1)})),d={class:"card-body table-responsive p-0"},p={class:"table table-valign-middle"},m=["src"],f={class:"d-flex"},v=["onClick"],h={key:1},y={colspan:"5",class:"text-center"};var b=n(9418),g=n(3279),k=n.n(g),E=n(9680);const N={props:{companies:Object,filters:Object||Array},components:{Pagination:b.Z,Inertia:E.Inertia},data:function(){return{search:this.filters.search}},methods:{deleteCompany:function(e){this.$swal({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(t){t.isConfirmed&&E.Inertia.delete(route("companies.destroy",e))}))}},watch:{search:k()((function(e){E.Inertia.get("users",{search:e},{preserveState:!0,replace:!0})}),500)}};var x=n(3379),V=n.n(x),B=n(9314),C={insert:"head",singleton:!1};V()(B.Z,C);B.Z.locals;const _=(0,n(3744).Z)(N,[["render",function(e,t,n,b,g,k){var E=(0,r.resolveComponent)("Head"),N=(0,r.resolveComponent)("Link"),x=(0,r.resolveComponent)("EditIcon"),V=(0,r.resolveComponent)("DeleteIcon"),B=(0,r.resolveComponent)("Pagination"),C=(0,r.resolveDirective)("tooltip");return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[(0,r.createVNode)(E,{title:e.__("Company List")},null,8,["title"]),(0,r.createElementVNode)("div",o,[(0,r.createElementVNode)("div",a,[(0,r.createElementVNode)("div",l,[(0,r.createElementVNode)("div",c,[(0,r.createElementVNode)("div",i,[(0,r.withDirectives)((0,r.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return g.search=e}),type:"text",placeholder:e.__("Search"),class:"form-control w-50"},null,8,s),[[r.vModelText,g.search]]),(0,r.createVNode)(N,{href:e.route("companies.create"),class:"btn btn-primary"},{default:(0,r.withCtx)((function(){return[u,(0,r.createTextVNode)(" "+(0,r.toDisplayString)(e.__("Create")),1)]})),_:1},8,["href"])])]),(0,r.createElementVNode)("div",d,[(0,r.createElementVNode)("table",p,[(0,r.createElementVNode)("thead",null,[(0,r.createElementVNode)("tr",null,[(0,r.createElementVNode)("th",null,(0,r.toDisplayString)(e.__("Company")),1),(0,r.createElementVNode)("th",null,(0,r.toDisplayString)(e.__("Email")),1),(0,r.createElementVNode)("th",null,(0,r.toDisplayString)(e.__("Action")),1)])]),(0,r.createElementVNode)("tbody",null,[n.companies&&n.companies.data.length?((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,{key:0},(0,r.renderList)(n.companies.data,(function(t,n){return(0,r.openBlock)(),(0,r.createElementBlock)("tr",{key:n},[(0,r.createElementVNode)("td",null,[(0,r.createElementVNode)("img",{src:t.avatar,alt:"Product 1",class:"img-circle img-size-32 mr-2"},null,8,m),(0,r.createTextVNode)(" "+(0,r.toDisplayString)(t.name),1)]),(0,r.createElementVNode)("td",null,(0,r.toDisplayString)(t.email),1),(0,r.createElementVNode)("td",f,[(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createBlock)(N,{href:e.route("companies.edit",t.id),class:"btn btn-sm pl-0"},{default:(0,r.withCtx)((function(){return[(0,r.createVNode)(x)]})),_:2},1032,["href"])),[[C,e.__("Company Edit")]]),(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createElementBlock)("button",{onClick:function(e){return k.deleteCompany(t.id)},class:"btn btn-sm"},[(0,r.createVNode)(V)],8,v)),[[C,e.__("Company Delete")]])])])})),128)):((0,r.openBlock)(),(0,r.createElementBlock)("tr",h,[(0,r.createElementVNode)("td",y,[(0,r.createElementVNode)("h3",null,(0,r.toDisplayString)(e.__("No Data Found")),1)])]))])]),(0,r.createVNode)(B,{links:n.companies.links},null,8,["links"])])])])])],64)}],["__scopeId","data-v-c01713c6"]])},9418:(e,t,n)=>{"use strict";n.d(t,{Z:()=>c});var r=n(821),o={class:"pagination justify-content-center"},a=["innerHTML"];const l={props:{links:{type:Array,required:!0}}};const c=(0,n(3744).Z)(l,[["render",function(e,t,n,l,c,i){var s=(0,r.resolveComponent)("Link");return(0,r.openBlock)(),(0,r.createElementBlock)("nav",null,[(0,r.createElementVNode)("ul",o,[((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,null,(0,r.renderList)(n.links,(function(e,t){return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[e.url?((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:(0,r.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,r.createVNode)(s,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,r.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,a)]))],64)})),256))])])}]])}}]);