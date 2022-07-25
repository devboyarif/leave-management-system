"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[9595],{9595:(e,r,o)=>{o.r(r),o.d(r,{default:()=>B});var t=o(821),a={class:"row justify-content-center"},n={class:"col-12"},l={class:"card mt-3"},s={class:"card-header"},c={class:"d-flex justify-content-between"},i={class:"card-title"},m=(0,t.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),d={class:"card-body row justify-content-center"},u={class:"col-lg-6"},f={class:"mb-3 row"},p={class:"col-lg-6"},v={class:"col-lg-6"},V={class:"mb-3 row"},N={class:"col-lg-6"},E={value:""},y=["value"],w={class:"col-lg-6"},_={class:"mb-3 row"},g={class:"col-lg-6"},C={class:"col-lg-6"},k=["disabled"],b={key:1},h=(0,t.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1);const D={props:{countries:{type:Array,required:!0}},data:function(){return{form:this.$inertia.form({name:null,email:null,country:null,password:null,password_confirmation:null,avatar:null})}},methods:{createData:function(){this.form.post(route("companies.store"))}}};const B=(0,o(3744).Z)(D,[["render",function(e,r,o,D,B,x){var S=(0,t.resolveComponent)("Head"),M=(0,t.resolveComponent)("Link"),z=(0,t.resolveComponent)("Label"),T=(0,t.resolveComponent)("ErrorMessage"),j=(0,t.resolveComponent)("Loading");return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createVNode)(S,{title:e.__("Company Create")},null,8,["title"]),(0,t.createElementVNode)("div",a,[(0,t.createElementVNode)("div",n,[(0,t.createElementVNode)("div",l,[(0,t.createElementVNode)("div",s,[(0,t.createElementVNode)("div",c,[(0,t.createElementVNode)("h3",i,(0,t.toDisplayString)(e.__("Company Create")),1),(0,t.createVNode)(M,{href:e.route("companies.index"),class:"btn btn-primary"},{default:(0,t.withCtx)((function(){return[m,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])]),(0,t.createElementVNode)("div",d,[(0,t.createElementVNode)("div",u,[(0,t.createElementVNode)("form",{onSubmit:r[6]||(r[6]=(0,t.withModifiers)((function(){return x.createData&&x.createData.apply(x,arguments)}),["prevent"]))},[(0,t.createElementVNode)("div",f,[(0,t.createElementVNode)("div",p,[(0,t.createVNode)(z,{name:e.__("Name")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[0]||(r[0]=function(e){return B.form.name=e}),type:"text",class:(0,t.normalizeClass)(["form-control",{"is-invalid":B.form.errors.name}]),id:"name"},null,2),[[t.vModelText,B.form.name]]),(0,t.createVNode)(T,{name:B.form.errors.name},null,8,["name"])]),(0,t.createElementVNode)("div",v,[(0,t.createVNode)(z,{name:e.__("Email address")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[1]||(r[1]=function(e){return B.form.email=e}),type:"email",class:(0,t.normalizeClass)(["form-control",{"is-invalid":B.form.errors.email}]),id:"email"},null,2),[[t.vModelText,B.form.email]]),(0,t.createVNode)(T,{name:B.form.errors.email},null,8,["name"])])]),(0,t.createElementVNode)("div",V,[(0,t.createElementVNode)("div",N,[(0,t.createVNode)(z,{name:e.__("Country")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("select",{"onUpdate:modelValue":r[2]||(r[2]=function(e){return B.form.country=e}),id:"country",class:(0,t.normalizeClass)(["form-control",{"is-invalid":B.form.errors.country}])},[(0,t.createElementVNode)("option",E,(0,t.toDisplayString)(e.__("Select Country")),1),((0,t.openBlock)(!0),(0,t.createElementBlock)(t.Fragment,null,(0,t.renderList)(o.countries,(function(e){return(0,t.openBlock)(),(0,t.createElementBlock)("option",{value:e.id,key:e.id},(0,t.toDisplayString)(e.name),9,y)})),128))],2),[[t.vModelSelect,B.form.country]]),(0,t.createVNode)(T,{name:B.form.errors.country},null,8,["name"])]),(0,t.createElementVNode)("div",w,[(0,t.createVNode)(z,{name:e.__("Avatar"),required:!1},null,8,["name"]),(0,t.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",class:(0,t.normalizeClass)(["form-control border-0 p-0",{"is-invalid":B.form.errors.avatar}]),type:"file",onInput:r[3]||(r[3]=function(e){return B.form.avatar=e.target.files[0]})},null,34),(0,t.createVNode)(T,{name:B.form.errors.avatar},null,8,["name"])])]),(0,t.createElementVNode)("div",_,[(0,t.createElementVNode)("div",g,[(0,t.createVNode)(z,{name:e.__("Password")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[4]||(r[4]=function(e){return B.form.password=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":B.form.errors.password}]),id:"password"},null,2),[[t.vModelText,B.form.password]]),(0,t.createVNode)(T,{name:B.form.errors.password},null,8,["name"])]),(0,t.createElementVNode)("div",C,[(0,t.createVNode)(z,{name:e.__("Confirm Password")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[5]||(r[5]=function(e){return B.form.password_confirmation=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":B.form.errors.password_confirmation}]),id:"password_confirmation"},null,2),[[t.vModelText,B.form.password_confirmation]]),(0,t.createVNode)(T,{name:B.form.errors.password_confirmation},null,8,["name"])])]),(0,t.createElementVNode)("button",{disabled:B.form.processing,type:"submit",class:"btn btn-primary"},[B.form.processing?((0,t.openBlock)(),(0,t.createBlock)(j,{key:0})):((0,t.openBlock)(),(0,t.createElementBlock)("span",b,[h,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Save")),1)]))],8,k)],32)])])])])])],64)}]])}}]);