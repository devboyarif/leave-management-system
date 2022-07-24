"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[6585],{6585:(e,a,r)=>{r.r(a),r.d(a,{default:()=>y});var t=r(821),n={class:"row justify-content-center"},o={class:"col-12"},l={class:"card mt-3"},s={class:"card-header"},m={class:"d-flex justify-content-between"},i={class:"card-title"},c=(0,t.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),d={class:"card-body row justify-content-center"},u={class:"col-lg-6"},f={class:"mb-3"},p={class:"mb-3"},v={class:"mb-3"},V={class:"mb-3"},N=["disabled"],E={key:1},b=(0,t.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1);const w={data:function(){return{form:this.$inertia.form({name:null,email:null,password:null,avatar:null})}},methods:{createData:function(){this.form.post(route("admins.store"))}}};const y=(0,r(3744).Z)(w,[["render",function(e,a,r,w,y,_){var g=(0,t.resolveComponent)("Head"),h=(0,t.resolveComponent)("Link"),k=(0,t.resolveComponent)("Label"),C=(0,t.resolveComponent)("ErrorMessage"),x=(0,t.resolveComponent)("Loading");return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createVNode)(g,{title:e.__("Admin Create")},null,8,["title"]),(0,t.createElementVNode)("div",n,[(0,t.createElementVNode)("div",o,[(0,t.createElementVNode)("div",l,[(0,t.createElementVNode)("div",s,[(0,t.createElementVNode)("div",m,[(0,t.createElementVNode)("h3",i,(0,t.toDisplayString)(e.__("Admin Create")),1),(0,t.createVNode)(h,{href:e.route("admins.index"),class:"btn btn-primary"},{default:(0,t.withCtx)((function(){return[c,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])]),(0,t.createElementVNode)("div",d,[(0,t.createElementVNode)("div",u,[(0,t.createElementVNode)("form",{onSubmit:a[4]||(a[4]=(0,t.withModifiers)((function(){return _.createData&&_.createData.apply(_,arguments)}),["prevent"]))},[(0,t.createElementVNode)("div",f,[(0,t.createVNode)(k,{name:e.__("Name")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":a[0]||(a[0]=function(e){return y.form.name=e}),type:"text",class:(0,t.normalizeClass)(["form-control",{"is-invalid":y.form.errors.name}]),id:"name"},null,2),[[t.vModelText,y.form.name]]),(0,t.createVNode)(C,{name:y.form.errors.name},null,8,["name"])]),(0,t.createElementVNode)("div",p,[(0,t.createVNode)(k,{name:e.__("Email address")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":a[1]||(a[1]=function(e){return y.form.email=e}),type:"email",class:(0,t.normalizeClass)(["form-control",{"is-invalid":y.form.errors.email}]),id:"email"},null,2),[[t.vModelText,y.form.email]]),(0,t.createVNode)(C,{name:y.form.errors.email},null,8,["name"])]),(0,t.createElementVNode)("div",v,[(0,t.createVNode)(k,{name:e.__("Password")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":a[2]||(a[2]=function(e){return y.form.password=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":y.form.errors.password}]),id:"password"},null,2),[[t.vModelText,y.form.password]]),(0,t.createVNode)(C,{name:y.form.errors.password},null,8,["name"])]),(0,t.createElementVNode)("div",V,[(0,t.createVNode)(k,{name:e.__("Avatar"),required:!1},null,8,["name"]),(0,t.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",class:(0,t.normalizeClass)(["form-control border-0 p-0",{"is-invalid":y.form.errors.avatar}]),type:"file",onInput:a[3]||(a[3]=function(e){return y.form.avatar=e.target.files[0]})},null,34),(0,t.createVNode)(C,{name:y.form.errors.avatar},null,8,["name"])]),(0,t.createElementVNode)("button",{disabled:y.form.processing,type:"submit",class:"btn btn-primary"},[y.form.processing?((0,t.openBlock)(),(0,t.createBlock)(x,{key:0})):((0,t.openBlock)(),(0,t.createElementBlock)("span",E,[b,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Save")),1)]))],8,N)],32)])])])])])],64)}]])}}]);