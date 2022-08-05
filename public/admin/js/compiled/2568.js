"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2568],{6976:(e,t,o)=>{o.d(t,{Z:()=>n});var a=o(3645),r=o.n(a)()((function(e){return e[1]}));r.push([e.id,'.switch[data-v-fb56454e]{display:inline-block;height:19px;position:relative;width:35px}.switch input[data-v-fb56454e]{display:none}.slider[data-v-fb56454e]{background-color:#ccc;bottom:0;cursor:pointer;left:0;right:0;top:0}.slider[data-v-fb56454e],.slider[data-v-fb56454e]:before{position:absolute;transition:.4s}.slider[data-v-fb56454e]:before{background-color:#fff;bottom:2px;content:"";height:15px;left:3px;width:15px}input.success:checked+.slider[data-v-fb56454e]{background-color:#28a745}input:checked+.slider[data-v-fb56454e]:before{transform:translateX(15px)}.slider.round[data-v-fb56454e]{border-radius:34px}.slider.round[data-v-fb56454e]:before{border-radius:50%}',""]);const n=r},2568:(e,t,o)=>{o.r(t),o.d(t,{default:()=>z});var a=o(821),r=function(e){return(0,a.pushScopeId)("data-v-fb56454e"),e=e(),(0,a.popScopeId)(),e},n={class:"row justify-content-center"},l={class:"col-12"},c={class:"card mt-3"},s={class:"card-header"},d={class:"d-flex justify-content-between"},i={class:"card-title"},u=r((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1)})),m={class:"card-body row justify-content-center"},p={class:"col-lg-6"},f={class:"mb-3 row"},v={class:"col-md-12"},b={class:"mb-3 row"},h={class:"col-lg-6"},V={class:"col-lg-6"},N={class:"mb-3 row"},y={class:"col-lg-6"},E=(0,a.createTextVNode)(),k=r((function(){return(0,a.createElementVNode)("br",null,null,-1)})),g={class:"switch"},_=["checked"],x=r((function(){return(0,a.createElementVNode)("span",{class:"slider round"},null,-1)})),w={class:"col-lg-6"},C={class:"custom-control custom-checkbox"},T=["checked"],D={class:"custom-control-label",for:"auto_approve"},S=["disabled"],B={key:1},M=r((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)}));const L={props:{leaveType:{type:Object,required:!0}},data:function(){return{form:this.$inertia.form({name:this.leaveType.name,color:this.leaveType.color,balance:this.leaveType.balance,auto_approve:!!this.leaveType.auto_approve,status:!!this.leaveType.status})}},methods:{updateData:function(){this.form.put(route("company.leaveTypes.update",this.leaveType.id))},statusChange:function(e){this.form.status=e.target.checked}},mounted:function(){this.checkPagePermission("company")}};var U=o(3379),j=o.n(U),q=o(6976),Z={insert:"head",singleton:!1};j()(q.Z,Z);q.Z.locals;const z=(0,o(3744).Z)(L,[["render",function(e,t,o,r,L,U){var j=(0,a.resolveComponent)("Head"),q=(0,a.resolveComponent)("Link"),Z=(0,a.resolveComponent)("Label"),z=(0,a.resolveComponent)("ErrorMessage"),I=(0,a.resolveComponent)("Loading");return(0,a.openBlock)(),(0,a.createElementBlock)(a.Fragment,null,[(0,a.createVNode)(j,{contextmenu:e.__("Edit Leave Type")},null,8,["contextmenu"]),(0,a.createElementVNode)("div",n,[(0,a.createElementVNode)("div",l,[(0,a.createElementVNode)("div",c,[(0,a.createElementVNode)("div",s,[(0,a.createElementVNode)("div",d,[(0,a.createElementVNode)("h3",i,(0,a.toDisplayString)(e.__("Edit Leave Type")),1),(0,a.createVNode)(q,{href:e.route("company.leaveTypes.index"),class:"btn btn-primary"},{default:(0,a.withCtx)((function(){return[u,(0,a.createTextVNode)(" "+(0,a.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])]),(0,a.createElementVNode)("div",m,[(0,a.createElementVNode)("div",p,[(0,a.createElementVNode)("form",{onSubmit:t[6]||(t[6]=(0,a.withModifiers)((function(){return U.updateData&&U.updateData.apply(U,arguments)}),["prevent"]))},[(0,a.createElementVNode)("div",f,[(0,a.createElementVNode)("div",v,[(0,a.createVNode)(Z,{name:e.__("Name")},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return L.form.name=e}),type:"text",class:(0,a.normalizeClass)(["form-control",{"is-invalid":L.form.errors.name}]),id:"name"},null,2),[[a.vModelText,L.form.name]]),(0,a.createVNode)(z,{name:L.form.errors.name},null,8,["name"])])]),(0,a.createElementVNode)("div",b,[(0,a.createElementVNode)("div",h,[(0,a.createVNode)(Z,{name:e.__("Color"),required:!1},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return L.form.color=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":L.form.errors.color}]),type:"color"},null,2),[[a.vModelText,L.form.color]]),(0,a.createVNode)(z,{name:L.form.errors.color},null,8,["name"])]),(0,a.createElementVNode)("div",V,[(0,a.createVNode)(Z,{name:e.__("Leave Balance Day"),required:!1},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("input",{min:"1","onUpdate:modelValue":t[2]||(t[2]=function(e){return L.form.balance=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":L.form.errors.balance}]),type:"number"},null,2),[[a.vModelText,L.form.balance]]),(0,a.createVNode)(z,{name:L.form.errors.balance},null,8,["name"])])]),(0,a.createElementVNode)("div",N,[(0,a.createElementVNode)("div",y,[(0,a.createVNode)(Z,{name:e.__("Status"),required:!1},null,8,["name"]),E,k,(0,a.createElementVNode)("label",g,[(0,a.withDirectives)((0,a.createElementVNode)("input",{onChange:t[3]||(t[3]=function(){return U.statusChange&&U.statusChange.apply(U,arguments)}),"onUpdate:modelValue":t[4]||(t[4]=function(e){return L.form.status=e}),type:"checkbox",class:"success toggle-switch",checked:L.form.status},null,40,_),[[a.vModelCheckbox,L.form.status]]),x])]),(0,a.createElementVNode)("div",w,[(0,a.createElementVNode)("div",C,[(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[5]||(t[5]=function(e){return L.form.auto_approve=e}),type:"checkbox",class:"custom-control-input",id:"auto_approve",checked:L.form.auto_approve},null,8,T),[[a.vModelCheckbox,L.form.auto_approve]]),(0,a.createElementVNode)("label",D,(0,a.toDisplayString)(e.__("Allow auto approve")),1)])])]),(0,a.createElementVNode)("button",{disabled:L.form.processing,type:"submit",class:"btn btn-primary"},[L.form.processing?((0,a.openBlock)(),(0,a.createBlock)(I,{key:0})):((0,a.openBlock)(),(0,a.createElementBlock)("span",B,[M,(0,a.createTextVNode)(" "+(0,a.toDisplayString)(e.__("Save")),1)]))],8,S)],32)])])])])])],64)}],["__scopeId","data-v-fb56454e"]])}}]);