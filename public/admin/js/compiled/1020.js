(self.webpackChunk=self.webpackChunk||[]).push([[1020],{3849:(e,t,o)=>{"use strict";o.d(t,{Z:()=>r});var n=o(3645),a=o.n(n)()((function(e){return e[1]}));a.push([e.id,".avatar-img[data-v-34a9c086]{height:60px;-o-object-fit:cover;object-fit:cover;width:60px}.employee-add-dropdown[data-v-34a9c086]{left:0;position:absolute;top:0;transform:translate3d(0,38px,0);will-change:transform}.team-member-edit[data-v-34a9c086]{position:absolute;right:30px;top:0}.team-member-delete[data-v-34a9c086]{position:absolute;right:0;top:0}",""]);const r=a},8347:(e,t,o)=>{"use strict";o.d(t,{Z:()=>r});var n=o(3645),a=o.n(n)()((function(e){return e[1]}));a.push([e.id,".modal-dialog[data-v-700dab8d]{max-width:600px!important}",""]);const r=a},1612:(e,t,o)=>{"use strict";o.d(t,{Z:()=>r});var n=o(3645),a=o.n(n)()((function(e){return e[1]}));a.push([e.id,".modal-dialog[data-v-589eac80]{max-width:600px!important}",""]);const r=a},2705:(e,t,o)=>{var n=o(5639).Symbol;e.exports=n},4239:(e,t,o)=>{var n=o(2705),a=o(9607),r=o(2333),l=n?n.toStringTag:void 0;e.exports=function(e){return null==e?void 0===e?"[object Undefined]":"[object Null]":l&&l in Object(e)?a(e):r(e)}},7561:(e,t,o)=>{var n=o(7990),a=/^\s+/;e.exports=function(e){return e?e.slice(0,n(e)+1).replace(a,""):e}},1957:(e,t,o)=>{var n="object"==typeof o.g&&o.g&&o.g.Object===Object&&o.g;e.exports=n},9607:(e,t,o)=>{var n=o(2705),a=Object.prototype,r=a.hasOwnProperty,l=a.toString,s=n?n.toStringTag:void 0;e.exports=function(e){var t=r.call(e,s),o=e[s];try{e[s]=void 0;var n=!0}catch(e){}var a=l.call(e);return n&&(t?e[s]=o:delete e[s]),a}},2333:e=>{var t=Object.prototype.toString;e.exports=function(e){return t.call(e)}},5639:(e,t,o)=>{var n=o(1957),a="object"==typeof self&&self&&self.Object===Object&&self,r=n||a||Function("return this")();e.exports=r},7990:e=>{var t=/\s/;e.exports=function(e){for(var o=e.length;o--&&t.test(e.charAt(o)););return o}},3279:(e,t,o)=>{var n=o(3218),a=o(7771),r=o(4841),l=Math.max,s=Math.min;e.exports=function(e,t,o){var c,i,d,m,u,p,f=0,v=!1,E=!1,h=!0;if("function"!=typeof e)throw new TypeError("Expected a function");function y(t){var o=c,n=i;return c=i=void 0,f=t,m=e.apply(n,o)}function V(e){return f=e,u=setTimeout(k,t),v?y(e):m}function N(e){var o=e-p;return void 0===p||o>=t||o<0||E&&e-f>=d}function k(){var e=a();if(N(e))return w(e);u=setTimeout(k,function(e){var o=t-(e-p);return E?s(o,d-(e-f)):o}(e))}function w(e){return u=void 0,h&&c?y(e):(c=i=void 0,m)}function b(){var e=a(),o=N(e);if(c=arguments,i=this,p=e,o){if(void 0===u)return V(p);if(E)return clearTimeout(u),u=setTimeout(k,t),y(p)}return void 0===u&&(u=setTimeout(k,t)),m}return t=r(t)||0,n(o)&&(v=!!o.leading,d=(E="maxWait"in o)?l(r(o.maxWait)||0,t):d,h="trailing"in o?!!o.trailing:h),b.cancel=function(){void 0!==u&&clearTimeout(u),f=0,c=p=i=u=void 0},b.flush=function(){return void 0===u?m:w(a())},b}},3218:e=>{e.exports=function(e){var t=typeof e;return null!=e&&("object"==t||"function"==t)}},7005:e=>{e.exports=function(e){return null!=e&&"object"==typeof e}},3448:(e,t,o)=>{var n=o(4239),a=o(7005);e.exports=function(e){return"symbol"==typeof e||a(e)&&"[object Symbol]"==n(e)}},7771:(e,t,o)=>{var n=o(5639);e.exports=function(){return n.Date.now()}},4841:(e,t,o)=>{var n=o(7561),a=o(3218),r=o(3448),l=/^[-+]0x[0-9a-f]+$/i,s=/^0b[01]+$/i,c=/^0o[0-7]+$/i,i=parseInt;e.exports=function(e){if("number"==typeof e)return e;if(r(e))return NaN;if(a(e)){var t="function"==typeof e.valueOf?e.valueOf():e;e=a(t)?t+"":t}if("string"!=typeof e)return 0===e?e:+e;e=n(e);var o=s.test(e);return o||c.test(e)?i(e.slice(2),o?2:8):l.test(e)?NaN:+e}},1020:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>xt});var n=o(821),a=function(e){return(0,n.pushScopeId)("data-v-34a9c086"),e=e(),(0,n.popScopeId)(),e},r={class:"row justify-content-center mt-4"},l={class:"col-12"},s={class:"card"},c={class:"card-header"},i={class:"d-flex justify-content-between"},d=a((function(){return(0,n.createElementVNode)("span",null,"Employee List",-1)})),m=[a((function(){return(0,n.createElementVNode)("i",{class:"fa-regular fa-paper-plane"},null,-1)})),(0,n.createTextVNode)(" Invite Employee ")],u=[a((function(){return(0,n.createElementVNode)("i",{class:"fa-solid fa-plus"},null,-1)})),(0,n.createTextVNode)(" Instant Create ")],p={class:"card"},f={class:"card-header"},v={class:"d-flex justify-content-between"},E={class:"nav nav-pills mb-3",id:"pills-tab",role:"tablist"},h={class:"nav-item"},y=["onClick"],V={class:"card-body"},N={class:"tab-content",id:"pills-tabContent"},k={class:"row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters"},w={key:0,class:"card h-100"},b=["src"],g={class:"card-body"},C={class:"card-title"},B=(0,n.createTextVNode)(),x=a((function(){return(0,n.createElementVNode)("br",null,null,-1)})),M={key:0,class:"m-0 p-0"},D={class:"mt-0 p-0"},T=["onClick"],_=["onClick"],S={key:1,class:"text-center m-auto"},j={class:"row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 semi-gutters"},I={key:0,class:"card h-100"},z=["src"],L={class:"card-body"},O={class:"card-title"},Z=(0,n.createTextVNode)(),U=a((function(){return(0,n.createElementVNode)("br",null,null,-1)})),$={key:0,class:"m-0 p-0"},A={class:"mt-0 p-0"},F=["onClick"],P=["onClick"],H={key:1,class:"d-flex justify-content-center text-center m-auto"},q=[a((function(){return(0,n.createElementVNode)("h6",null,"No employees found",-1)}))];var W=o(7757),Y=o.n(W),G=o(9418),J=(o(3279),o(9680)),K={key:0},Q={class:"modal-mask"},R={class:"modal-wrapper"},X={class:"modal-dialog",role:"document"},ee={class:"modal-content"},te={class:"modal-header"},oe=(0,n.createElementVNode)("h5",{class:"modal-title"}," Invite Employee ",-1),ne={type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},ae={class:"modal-body"},re={class:"mb-3 row"},le={class:"col-md-12"},se={class:"col-md-12"},ce=(0,n.createElementVNode)("option",{value:"",class:"d-none"},"Select Team",-1),ie=["value"],de={class:"modal-footer"},me=["disabled"],ue={key:1},pe=[(0,n.createElementVNode)("i",{class:"fa-regular fa-paper-plane"},null,-1),(0,n.createTextVNode)(" Invite ")];const fe={props:{show:{type:Boolean,default:!1},teams:{type:Array,default:function(){return[]}}},data:function(){return{form:this.$inertia.form({email:"",team_id:""}),teams:this.teams}},methods:{hideModal:function(){this.$emit("close")},sendData:function(){var e=this;this.form.post(route("company.invite.send"),{onSuccess:function(){e.form.reset(),e.hideModal()}})},hideModalOutsideClick:function(){this.form.processing||this.$emit("close")}}};var ve=o(3744);const Ee=(0,ve.Z)(fe,[["render",function(e,t,o,a,r,l){var s=(0,n.resolveComponent)("Label"),c=(0,n.resolveComponent)("ErrorMessage"),i=(0,n.resolveComponent)("Loading"),d=(0,n.resolveDirective)("click-outside");return o.show?((0,n.openBlock)(),(0,n.createElementBlock)("div",K,[(0,n.createVNode)(n.Transition,{name:"fade"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",Q,[(0,n.createElementVNode)("div",R,[(0,n.createElementVNode)("div",X,[(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",ee,[(0,n.createElementVNode)("div",te,[oe,(0,n.createElementVNode)("button",ne,[(0,n.createElementVNode)("span",{"aria-hidden":"true",onClick:t[0]||(t[0]=function(e){return l.hideModal()})},"×")])]),(0,n.createElementVNode)("form",{onSubmit:t[4]||(t[4]=(0,n.withModifiers)((function(){return l.sendData&&l.sendData.apply(l,arguments)}),["prevent"]))},[(0,n.createElementVNode)("div",ae,[(0,n.createElementVNode)("div",re,[(0,n.createElementVNode)("div",le,[(0,n.createVNode)(s,{name:"Email"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return r.form.email=e}),type:"email",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.email}]),id:"name"},null,2),[[n.vModelText,r.form.email]]),(0,n.createVNode)(c,{name:r.form.errors.email},null,8,["name"])]),(0,n.createElementVNode)("div",se,[(0,n.createVNode)(s,{name:"Team"}),(0,n.withDirectives)((0,n.createElementVNode)("select",{class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.team_id}]),"onUpdate:modelValue":t[2]||(t[2]=function(e){return r.form.team_id=e})},[ce,((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(r.teams,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("option",{key:e.id,value:e.id},(0,n.toDisplayString)(e.name),9,ie)})),128))],2),[[n.vModelSelect,r.form.team_id]]),(0,n.createVNode)(c,{name:r.form.errors.team_id},null,8,["name"])])])]),(0,n.createElementVNode)("div",de,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-secondary",onClick:t[3]||(t[3]=function(e){return l.hideModal()})},"Close"),(0,n.createElementVNode)("button",{disabled:r.form.processing,type:"submit",class:"btn btn-primary"},[r.form.processing?((0,n.openBlock)(),(0,n.createBlock)(i,{key:0,message:"Inviting..."})):((0,n.openBlock)(),(0,n.createElementBlock)("span",ue,pe))],8,me)])],32)])),[[d,l.hideModalOutsideClick]])])])])]})),_:1})])):(0,n.createCommentVNode)("",!0)}]]);var he=function(e){return(0,n.pushScopeId)("data-v-700dab8d"),e=e(),(0,n.popScopeId)(),e},ye={key:0},Ve={class:"modal-mask"},Ne={class:"modal-wrapper"},ke={class:"modal-dialog",role:"document"},we={class:"modal-content"},be={class:"modal-header"},ge=he((function(){return(0,n.createElementVNode)("h5",{class:"modal-title"}," Create New Employee ",-1)})),Ce={type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},Be={class:"modal-body"},xe={class:"mb-3 row"},Me={class:"col-md-6"},De={class:"col-md-6"},Te={class:"mb-3 row"},_e=he((function(){return(0,n.createElementVNode)("option",{value:"",class:"d-none"},"Select Team",-1)})),Se=["value"],je={class:"mb-3 row"},Ie={class:"col-lg-6"},ze={class:"col-lg-6"},Le={class:"mb-3 row"},Oe={class:"col-md-6"},Ze={class:"modal-footer"},Ue=["disabled"],$e={key:1},Ae=[he((function(){return(0,n.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)})),(0,n.createTextVNode)(" Save ")];const Fe={props:{show:{type:Boolean,default:!1},teams:{type:Array,default:function(){return[]}}},data:function(){return{form:this.$inertia.form({name:null,email:null,password:null,password_confirmation:null,avatar:null,team_id:""}),teams:this.teams}},methods:{hideModal:function(){this.$emit("close")},hideModalOutsideClick:function(){this.form.processing||this.$emit("close")},saveData:function(){var e=this;this.form.post(route("company.employees.store"),{onSuccess:function(){e.$emit("created"),e.form.reset(),e.hideModal()}})}}};var Pe=o(3379),He=o.n(Pe),qe=o(8347),We={insert:"head",singleton:!1};He()(qe.Z,We);qe.Z.locals;const Ye=(0,ve.Z)(Fe,[["render",function(e,t,o,a,r,l){var s=(0,n.resolveComponent)("Label"),c=(0,n.resolveComponent)("ErrorMessage"),i=(0,n.resolveComponent)("Loading"),d=(0,n.resolveDirective)("click-outside");return o.show?((0,n.openBlock)(),(0,n.createElementBlock)("div",ye,[(0,n.createVNode)(n.Transition,{name:"fade"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",Ve,[(0,n.createElementVNode)("div",Ne,[(0,n.createElementVNode)("div",ke,[(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",we,[(0,n.createElementVNode)("div",be,[ge,(0,n.createElementVNode)("button",Ce,[(0,n.createElementVNode)("span",{"aria-hidden":"true",onClick:t[0]||(t[0]=function(e){return l.hideModal()})},"×")])]),(0,n.createElementVNode)("form",{onSubmit:t[8]||(t[8]=(0,n.withModifiers)((function(){return l.saveData&&l.saveData.apply(l,arguments)}),["prevent"]))},[(0,n.createElementVNode)("div",Be,[(0,n.createElementVNode)("div",xe,[(0,n.createElementVNode)("div",Me,[(0,n.createVNode)(s,{name:"Name"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return r.form.name=e}),type:"text",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.name}]),id:"name"},null,2),[[n.vModelText,r.form.name]]),(0,n.createVNode)(c,{name:r.form.errors.name},null,8,["name"])]),(0,n.createElementVNode)("div",De,[(0,n.createVNode)(s,{name:"Email address"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[2]||(t[2]=function(e){return r.form.email=e}),type:"email",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.email}]),id:"email"},null,2),[[n.vModelText,r.form.email]]),(0,n.createVNode)(c,{name:r.form.errors.email},null,8,["name"])])]),(0,n.createElementVNode)("div",Te,[(0,n.createVNode)(s,{name:"Team"}),(0,n.withDirectives)((0,n.createElementVNode)("select",{class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.team_id}]),"onUpdate:modelValue":t[3]||(t[3]=function(e){return r.form.team_id=e})},[_e,((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(r.teams,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("option",{key:e.id,value:e.id},(0,n.toDisplayString)(e.name),9,Se)})),128))],2),[[n.vModelSelect,r.form.team_id]]),(0,n.createVNode)(c,{name:r.form.errors.team_id},null,8,["name"])]),(0,n.createElementVNode)("div",je,[(0,n.createElementVNode)("div",Ie,[(0,n.createVNode)(s,{name:"Password"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[4]||(t[4]=function(e){return r.form.password=e}),type:"password",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.password}]),id:"password"},null,2),[[n.vModelText,r.form.password]]),(0,n.createVNode)(c,{name:r.form.errors.password},null,8,["name"])]),(0,n.createElementVNode)("div",ze,[(0,n.createVNode)(s,{name:"Confirm Password"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[5]||(t[5]=function(e){return r.form.password_confirmation=e}),type:"password",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.password_confirmation}]),id:"password_confirmation"},null,2),[[n.vModelText,r.form.password_confirmation]]),(0,n.createVNode)(c,{name:r.form.errors.password_confirmation},null,8,["name"])])]),(0,n.createElementVNode)("div",Le,[(0,n.createElementVNode)("div",Oe,[(0,n.createVNode)(s,{name:"Avatar",required:!1}),(0,n.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",class:(0,n.normalizeClass)(["form-control border-0 p-0",{"is-invalid":r.form.errors.avatar}]),type:"file",onInput:t[6]||(t[6]=function(e){return r.form.avatar=e.target.files[0]})},null,34),(0,n.createVNode)(c,{name:r.form.errors.avatar},null,8,["name"])])])]),(0,n.createElementVNode)("div",Ze,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-secondary",onClick:t[7]||(t[7]=function(e){return l.hideModal()})}," Close "),(0,n.createElementVNode)("button",{disabled:r.form.processing,type:"submit",class:"btn btn-primary"},[r.form.processing?((0,n.openBlock)(),(0,n.createBlock)(i,{key:0})):((0,n.openBlock)(),(0,n.createElementBlock)("span",$e,Ae))],8,Ue)])],32)])),[[d,l.hideModalOutsideClick]])])])])]})),_:1})])):(0,n.createCommentVNode)("",!0)}],["__scopeId","data-v-700dab8d"]]);var Ge=function(e){return(0,n.pushScopeId)("data-v-589eac80"),e=e(),(0,n.popScopeId)(),e},Je={key:0},Ke={class:"modal-mask"},Qe={class:"modal-wrapper"},Re={class:"modal-dialog",role:"document"},Xe={class:"modal-content"},et={class:"modal-header"},tt=Ge((function(){return(0,n.createElementVNode)("h5",{class:"modal-title"}," Edit Employee ",-1)})),ot={type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},nt={class:"modal-body"},at={class:"mb-3 row"},rt={class:"col-md-6"},lt={class:"col-md-6"},st={class:"mb-3 row"},ct=Ge((function(){return(0,n.createElementVNode)("option",{value:"",class:"d-none"},"Select Team",-1)})),it=["value"],dt={class:"mb-3 row"},mt={class:"col-lg-6"},ut={class:"col-lg-6"},pt={class:"mb-3 row"},ft={class:"col-md-6"},vt={class:"modal-footer"},Et=["disabled"],ht={key:1},yt=[Ge((function(){return(0,n.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)})),(0,n.createTextVNode)(" Save ")];const Vt={props:{show:{type:Boolean,default:!1},employee:{type:Object,default:{}},teams:{type:Array,default:function(){return[]}}},data:function(){return{form:this.$inertia.form({name:this.employee.user.name,email:this.employee.user.email,password:null,password_confirmation:null,avatar:null,team_id:this.employee.team_id,_method:"PUT"}),teams:this.teams}},methods:{hideModal:function(){this.$emit("close")},hideModalOutsideClick:function(){this.form.processing||this.$emit("close")},saveData:function(){var e=this;this.form.post(route("company.employees.update",this.employee.id),{onSuccess:function(){e.$emit("updated"),e.form.reset(),e.hideModal()}})}}};var Nt=o(1612),kt={insert:"head",singleton:!1};He()(Nt.Z,kt);Nt.Z.locals;const wt=(0,ve.Z)(Vt,[["render",function(e,t,o,a,r,l){var s=(0,n.resolveComponent)("Label"),c=(0,n.resolveComponent)("ErrorMessage"),i=(0,n.resolveComponent)("Loading"),d=(0,n.resolveDirective)("click-outside");return o.show?((0,n.openBlock)(),(0,n.createElementBlock)("div",Je,[(0,n.createVNode)(n.Transition,{name:"fade"},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("div",Ke,[(0,n.createElementVNode)("div",Qe,[(0,n.createElementVNode)("div",Re,[(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",Xe,[(0,n.createElementVNode)("div",et,[tt,(0,n.createElementVNode)("button",ot,[(0,n.createElementVNode)("span",{"aria-hidden":"true",onClick:t[0]||(t[0]=function(e){return l.hideModal()})},"×")])]),(0,n.createElementVNode)("form",{onSubmit:t[8]||(t[8]=(0,n.withModifiers)((function(){return l.saveData&&l.saveData.apply(l,arguments)}),["prevent"]))},[(0,n.createElementVNode)("div",nt,[(0,n.createElementVNode)("div",at,[(0,n.createElementVNode)("div",rt,[(0,n.createVNode)(s,{name:"Name"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return r.form.name=e}),type:"text",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.name}]),id:"name"},null,2),[[n.vModelText,r.form.name]]),(0,n.createVNode)(c,{name:r.form.errors.name},null,8,["name"])]),(0,n.createElementVNode)("div",lt,[(0,n.createVNode)(s,{name:"Email address"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[2]||(t[2]=function(e){return r.form.email=e}),type:"email",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.email}]),id:"email"},null,2),[[n.vModelText,r.form.email]]),(0,n.createVNode)(c,{name:r.form.errors.email},null,8,["name"])])]),(0,n.createElementVNode)("div",st,[(0,n.createVNode)(s,{name:"Team"}),(0,n.withDirectives)((0,n.createElementVNode)("select",{class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.team_id}]),"onUpdate:modelValue":t[3]||(t[3]=function(e){return r.form.team_id=e})},[ct,((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(r.teams,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("option",{key:e.id,value:e.id},(0,n.toDisplayString)(e.name),9,it)})),128))],2),[[n.vModelSelect,r.form.team_id]]),(0,n.createVNode)(c,{name:r.form.errors.team_id},null,8,["name"])]),(0,n.createElementVNode)("div",dt,[(0,n.createElementVNode)("div",mt,[(0,n.createVNode)(s,{name:"Change Password"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[4]||(t[4]=function(e){return r.form.password=e}),type:"password",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.password}]),id:"password"},null,2),[[n.vModelText,r.form.password]]),(0,n.createVNode)(c,{name:r.form.errors.password},null,8,["name"])]),(0,n.createElementVNode)("div",ut,[(0,n.createVNode)(s,{name:"Confirm Password"}),(0,n.withDirectives)((0,n.createElementVNode)("input",{"onUpdate:modelValue":t[5]||(t[5]=function(e){return r.form.password_confirmation=e}),type:"password",class:(0,n.normalizeClass)(["form-control",{"is-invalid":r.form.errors.password_confirmation}]),id:"password_confirmation"},null,2),[[n.vModelText,r.form.password_confirmation]]),(0,n.createVNode)(c,{name:r.form.errors.password_confirmation},null,8,["name"])])]),(0,n.createElementVNode)("div",pt,[(0,n.createElementVNode)("div",ft,[(0,n.createVNode)(s,{name:"Change Avatar",required:!1}),(0,n.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",class:(0,n.normalizeClass)(["form-control border-0 p-0",{"is-invalid":r.form.errors.avatar}]),type:"file",onInput:t[6]||(t[6]=function(e){return r.form.avatar=e.target.files[0]})},null,34),(0,n.createVNode)(c,{name:r.form.errors.avatar},null,8,["name"])])])]),(0,n.createElementVNode)("div",vt,[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-secondary",onClick:t[7]||(t[7]=function(e){return l.hideModal()})}," Close "),(0,n.createElementVNode)("button",{disabled:r.form.processing,type:"submit",class:"btn btn-primary"},[r.form.processing?((0,n.openBlock)(),(0,n.createBlock)(i,{key:0})):((0,n.openBlock)(),(0,n.createElementBlock)("span",ht,yt))],8,Et)])],32)])),[[d,l.hideModalOutsideClick]])])])])]})),_:1})])):(0,n.createCommentVNode)("",!0)}],["__scopeId","data-v-589eac80"]]);function bt(e,t,o,n,a,r,l){try{var s=e[r](l),c=s.value}catch(e){return void o(e)}s.done?t(c):Promise.resolve(c).then(n,a)}const gt={props:{teams:Array,employees:Array},components:{Pagination:G.Z,Inertia:J.Inertia,InviteEmployeeModal:Ee,CreateEmployeeModal:Ye,EditEmployeeModal:wt},data:function(){return{currentTab:"all",employees:this.employees,showEmployeeDropdown:!1,showEmployeeInviteModal:!1,showEmployeeCreateModal:!1,showEmployeeEditModal:!1,employee:""}},methods:{changeTab:function(e){var t,o=this;return(t=Y().mark((function t(){var n;return Y().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return o.currentTab=e,o.currentActiveTeam=e,t.next=4,axios.get(route("company.teams.employees",{team:e}));case 4:n=t.sent,o.employees=n.data.employees;case 6:case"end":return t.stop()}}),t)})),function(){var e=this,o=arguments;return new Promise((function(n,a){var r=t.apply(e,o);function l(e){bt(r,n,a,l,s,"next",e)}function s(e){bt(r,n,a,l,s,"throw",e)}l(void 0)}))})()},deleteData:function(e){var t=this;this.$swal({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(o){o.isConfirmed&&J.Inertia.delete(route("company.employees.destroy",e),{onSuccess:function(){t.changeTab(t.currentTab)}})}))},editData:function(e){this.employee=e,this.showEmployeeEditModal=!0}}};var Ct=o(3849),Bt={insert:"head",singleton:!1};He()(Ct.Z,Bt);Ct.Z.locals;const xt=(0,ve.Z)(gt,[["render",function(e,t,o,a,W,Y){var G=(0,n.resolveComponent)("Head"),J=(0,n.resolveComponent)("EditIcon"),K=(0,n.resolveComponent)("DeleteIcon"),Q=(0,n.resolveComponent)("InviteEmployeeModal"),R=(0,n.resolveComponent)("CreateEmployeeModal"),X=(0,n.resolveComponent)("EditEmployeeModal"),ee=(0,n.resolveDirective)("tooltip"),te=(0,n.resolveDirective)("click-outside");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)(G,{title:"Employee List"}),(0,n.createElementVNode)("div",r,[(0,n.createElementVNode)("div",l,[(0,n.createElementVNode)("div",s,[(0,n.createElementVNode)("div",c,[(0,n.createElementVNode)("div",i,[d,(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("div",null,[(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["btn-group",{show:W.showEmployeeDropdown}]),role:"group"},[(0,n.createElementVNode)("button",{type:"button",class:"btn btn-secondary dropdown-toggle",onClick:t[0]||(t[0]=function(e){return W.showEmployeeDropdown=!W.showEmployeeDropdown})}," Create Employee "),(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["dropdown-menu employee-add-dropdown",{show:W.showEmployeeDropdown}]),"x-placement":"bottom-start"},[(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("a",{onClick:t[1]||(t[1]=function(e){return W.showEmployeeInviteModal=!0}),class:"dropdown-item",href:"javascript:void(0)"},m)),[[ee,"Invite employee via email address"]]),(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createElementBlock)("a",{onClick:t[2]||(t[2]=function(e){return W.showEmployeeCreateModal=!0}),class:"dropdown-item",href:"#"},u)),[[ee,"Create employee instant from here"]])],2)],2)])),[[te,function(){return W.showEmployeeDropdown=!1}]])])])]),(0,n.createElementVNode)("div",p,[(0,n.createElementVNode)("div",f,[(0,n.createElementVNode)("div",v,[(0,n.createElementVNode)("ul",E,[(0,n.createElementVNode)("li",h,[(0,n.createElementVNode)("a",{href:"javascript:void(0)",onClick:t[3]||(t[3]=function(e){return Y.changeTab("all")}),class:(0,n.normalizeClass)(["nav-link",{active:"all"==W.currentTab}])},"All",2)]),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(o.teams,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("li",{class:"nav-item",key:e.id},[(0,n.createElementVNode)("a",{href:"javascript:void(0)",onClick:function(t){return Y.changeTab(e.slug)},class:(0,n.normalizeClass)(["nav-link",{active:W.currentTab==e.slug}])},(0,n.toDisplayString)(e.name),11,y)])})),128))])])]),(0,n.createElementVNode)("div",V,[(0,n.createElementVNode)("div",N,[(0,n.createElementVNode)("div",{class:(0,n.normalizeClass)(["tab-pane fade",{"show active":"all"==W.currentTab}])},[(0,n.createElementVNode)("div",k,[W.employees&&W.employees.length?((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,{key:0},(0,n.renderList)(W.employees,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("div",{class:"col mb-4",key:e.id},[e.user?((0,n.openBlock)(),(0,n.createElementBlock)("div",w,[(0,n.createElementVNode)("img",{src:e.user.avatar,class:"card-image-top"},null,8,b),(0,n.createElementVNode)("div",g,[(0,n.createElementVNode)("h6",C,(0,n.toDisplayString)(e.user.name),1),B,x,e.team?((0,n.openBlock)(),(0,n.createElementBlock)("p",M,(0,n.toDisplayString)(e.team.name),1)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("p",D,(0,n.toDisplayString)(e.user.email),1),(0,n.createElementVNode)("button",{onClick:function(t){return Y.editData(e)},class:"btn btn-sm team-member-edit"},[(0,n.createVNode)(J)],8,T),(0,n.createElementVNode)("button",{onClick:function(t){return Y.deleteData(e.user.id)},class:"btn btn-sm team-member-delete"},[(0,n.createVNode)(K)],8,_)])])):(0,n.createCommentVNode)("",!0)])})),128)):((0,n.openBlock)(),(0,n.createElementBlock)("h6",S,"No employees found"))])],2),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(o.teams,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("div",{class:(0,n.normalizeClass)(["tab-pane fade",{"show active":W.currentTab==e.slug}]),key:e.id},[(0,n.createElementVNode)("div",j,[W.employees&&W.employees.length?((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,{key:0},(0,n.renderList)(W.employees,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("div",{class:"col mb-4",key:e.id},[e.user?((0,n.openBlock)(),(0,n.createElementBlock)("div",I,[(0,n.createElementVNode)("img",{src:e.user.avatar,class:"card-image-top"},null,8,z),(0,n.createElementVNode)("div",L,[(0,n.createElementVNode)("h6",O,(0,n.toDisplayString)(e.user.name),1),Z,U,e.team?((0,n.openBlock)(),(0,n.createElementBlock)("p",$,(0,n.toDisplayString)(e.team.name),1)):(0,n.createCommentVNode)("",!0),(0,n.createElementVNode)("p",A,(0,n.toDisplayString)(e.user.email),1),(0,n.createElementVNode)("button",{onClick:function(t){return Y.editData(e)},class:"btn btn-sm team-member-edit"},[(0,n.createVNode)(J)],8,F),(0,n.createElementVNode)("button",{onClick:function(t){return Y.deleteData(e.user.id)},class:"btn btn-sm team-member-delete"},[(0,n.createVNode)(K)],8,P)])])):(0,n.createCommentVNode)("",!0)])})),128)):((0,n.openBlock)(),(0,n.createElementBlock)("div",H,q))])],2)})),128))])])])])]),(0,n.createVNode)(Q,{show:W.showEmployeeInviteModal,onClose:t[4]||(t[4]=function(e){return W.showEmployeeInviteModal=!1}),teams:o.teams},null,8,["show","teams"]),(0,n.createVNode)(R,{show:W.showEmployeeCreateModal,onClose:t[5]||(t[5]=function(e){return W.showEmployeeCreateModal=!1}),teams:o.teams,onCreated:t[6]||(t[6]=function(e){return Y.changeTab(W.currentTab)})},null,8,["show","teams"]),W.showEmployeeEditModal?((0,n.openBlock)(),(0,n.createBlock)(X,{key:0,show:W.showEmployeeEditModal,onClose:t[7]||(t[7]=function(e){return W.showEmployeeEditModal=!1}),teams:o.teams,employee:W.showEmployeeEditModal?W.employee:"",onUpdated:t[8]||(t[8]=function(e){return Y.changeTab(W.currentTab)})},null,8,["show","teams","employee"])):(0,n.createCommentVNode)("",!0)],64)}],["__scopeId","data-v-34a9c086"]])},9418:(e,t,o)=>{"use strict";o.d(t,{Z:()=>s});var n=o(821),a={class:"pagination justify-content-center"},r=["innerHTML"];const l={props:{links:{type:Array,required:!0}}};const s=(0,o(3744).Z)(l,[["render",function(e,t,o,l,s,c){var i=(0,n.resolveComponent)("Link");return(0,n.openBlock)(),(0,n.createElementBlock)("nav",null,[(0,n.createElementVNode)("ul",a,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(o.links,(function(e,t){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[e.url?((0,n.openBlock)(),(0,n.createElementBlock)("li",{class:(0,n.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,n.createVNode)(i,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,n.openBlock)(),(0,n.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,n.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,r)]))],64)})),256))])])}]])}}]);