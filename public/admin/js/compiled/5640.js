"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[5640],{5640:(e,r,t)=>{t.r(r),t.d(r,{default:()=>S});var o=t(821),a={class:"row justify-content-center"},n={class:"col-12"},l={class:"card mt-3"},s={class:"card-header"},c={class:"d-flex justify-content-between"},i={class:"card-title"},m=(0,o.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),d={class:"card-body row justify-content-center"},u={class:"col-lg-6"},p={class:"mb-3 row"},f={class:"col-lg-6"},v=["placeholder"],V={class:"col-lg-6"},N=["placeholder"],y={class:"mb-3 row"},E={class:"col-lg-6"},h={value:""},_=["value"],g={class:"col-lg-6"},w={class:"mb-3 row"},k={class:"col-lg-6"},b=["placeholder"],C=["disabled"],D={key:1},B=(0,o.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1);const x={props:{user:{type:Object,required:!0},country_id:{type:Number,required:!0},countries:{type:Array,required:!0}},data:function(){return{form:this.$inertia.form({name:this.user.name,email:this.user.email,country:this.country_id||"",password:null,avatar:null,_method:"PUT"})}},methods:{updateData:function(){this.form.post(route("companies.update",this.user.id))}},mounted:function(){this.checkPagePermission("admin")}};const S=(0,t(3744).Z)(x,[["render",function(e,r,t,x,S,j){var M=(0,o.resolveComponent)("Head"),T=(0,o.resolveComponent)("Link"),z=(0,o.resolveComponent)("Label"),P=(0,o.resolveComponent)("ErrorMessage"),U=(0,o.resolveComponent)("Loading");return(0,o.openBlock)(),(0,o.createElementBlock)(o.Fragment,null,[(0,o.createVNode)(M,{title:e.__("Company Edit")},null,8,["title"]),(0,o.createElementVNode)("div",a,[(0,o.createElementVNode)("div",n,[(0,o.createElementVNode)("div",l,[(0,o.createElementVNode)("div",s,[(0,o.createElementVNode)("div",c,[(0,o.createElementVNode)("h3",i,(0,o.toDisplayString)(e.__("Company Edit")),1),(0,o.createVNode)(T,{href:e.route("companies.index"),class:"btn btn-primary"},{default:(0,o.withCtx)((function(){return[m,(0,o.createTextVNode)(" "+(0,o.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])]),(0,o.createElementVNode)("div",d,[(0,o.createElementVNode)("div",u,[(0,o.createElementVNode)("form",{onSubmit:r[5]||(r[5]=(0,o.withModifiers)((function(){return j.updateData&&j.updateData.apply(j,arguments)}),["prevent"]))},[(0,o.createElementVNode)("div",p,[(0,o.createElementVNode)("div",f,[(0,o.createVNode)(z,{name:e.__("Name"),for:"name"},null,8,["name"]),(0,o.withDirectives)((0,o.createElementVNode)("input",{"onUpdate:modelValue":r[0]||(r[0]=function(e){return S.form.name=e}),type:"text",class:(0,o.normalizeClass)(["form-control",{"is-invalid":S.form.errors.name}]),id:"name",placeholder:e.__("Name")},null,10,v),[[o.vModelText,S.form.name]]),(0,o.createVNode)(P,{name:S.form.errors.name},null,8,["name"])]),(0,o.createElementVNode)("div",V,[(0,o.createVNode)(z,{name:e.__("Email address"),for:"email"},null,8,["name"]),(0,o.withDirectives)((0,o.createElementVNode)("input",{"onUpdate:modelValue":r[1]||(r[1]=function(e){return S.form.email=e}),type:"email",class:(0,o.normalizeClass)(["form-control",{"is-invalid":S.form.errors.email}]),id:"email",placeholder:e.__("Email address")},null,10,N),[[o.vModelText,S.form.email]]),(0,o.createVNode)(P,{name:S.form.errors.email},null,8,["name"])])]),(0,o.createElementVNode)("div",y,[(0,o.createElementVNode)("div",E,[(0,o.createVNode)(z,{name:e.__("Country"),for:"country"},null,8,["name"]),(0,o.withDirectives)((0,o.createElementVNode)("select",{"onUpdate:modelValue":r[2]||(r[2]=function(e){return S.form.country=e}),id:"country",class:(0,o.normalizeClass)(["form-control",{"is-invalid":S.form.errors.country}])},[(0,o.createElementVNode)("option",h,(0,o.toDisplayString)(e.__("Select Country")),1),((0,o.openBlock)(!0),(0,o.createElementBlock)(o.Fragment,null,(0,o.renderList)(t.countries,(function(e){return(0,o.openBlock)(),(0,o.createElementBlock)("option",{value:e.id,key:e.id},(0,o.toDisplayString)(e.name),9,_)})),128))],2),[[o.vModelSelect,S.form.country]]),(0,o.createVNode)(P,{name:S.form.errors.country},null,8,["name"])]),(0,o.createElementVNode)("div",g,[(0,o.createVNode)(z,{name:e.__("Avatar"),required:!1},null,8,["name"]),(0,o.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",class:(0,o.normalizeClass)(["form-control border-0 p-0",{"is-invalid":S.form.errors.avatar}]),type:"file",onInput:r[3]||(r[3]=function(e){return S.form.avatar=e.target.files[0]})},null,34),(0,o.createVNode)(P,{name:S.form.errors.avatar},null,8,["name"])])]),(0,o.createElementVNode)("div",w,[(0,o.createElementVNode)("div",k,[(0,o.createVNode)(z,{name:e.__("Change Password"),for:"password_confirmation"},null,8,["name"]),(0,o.withDirectives)((0,o.createElementVNode)("input",{"onUpdate:modelValue":r[4]||(r[4]=function(e){return S.form.password=e}),type:"password",class:(0,o.normalizeClass)(["form-control",{"is-invalid":S.form.errors.password}]),id:"password_confirmation",placeholder:e.__("Change Password")},null,10,b),[[o.vModelText,S.form.password]]),(0,o.createVNode)(P,{name:S.form.errors.password},null,8,["name"])])]),(0,o.createElementVNode)("button",{disabled:S.form.processing,type:"submit",class:"btn btn-primary"},[S.form.processing?((0,o.openBlock)(),(0,o.createBlock)(U,{key:0})):((0,o.openBlock)(),(0,o.createElementBlock)("span",D,[B,(0,o.createTextVNode)(" "+(0,o.toDisplayString)(e.__("Save")),1)]))],8,C)],32)])])])])])],64)}]])}}]);