"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[874],{1094:(e,t,o)=>{o.d(t,{Z:()=>n});var a=o(3645),r=o.n(a)()((function(e){return e[1]}));r.push([e.id,'.switch[data-v-8ae4c526]{display:inline-block;height:19px;position:relative;width:35px}.switch input[data-v-8ae4c526]{display:none}.slider[data-v-8ae4c526]{background-color:#ccc;bottom:0;cursor:pointer;left:0;right:0;top:0}.slider[data-v-8ae4c526],.slider[data-v-8ae4c526]:before{position:absolute;transition:.4s}.slider[data-v-8ae4c526]:before{background-color:#fff;bottom:2px;content:"";height:15px;left:3px;width:15px}input.success:checked+.slider[data-v-8ae4c526]{background-color:#28a745}input:checked+.slider[data-v-8ae4c526]:before{transform:translateX(15px)}.slider.round[data-v-8ae4c526]{border-radius:34px}.slider.round[data-v-8ae4c526]:before{border-radius:50%}',""]);const n=r},874:(e,t,o)=>{o.r(t),o.d(t,{default:()=>H});var a=o(821),r=function(e){return(0,a.pushScopeId)("data-v-8ae4c526"),e=e(),(0,a.popScopeId)(),e},n={class:"row justify-content-center"},l={class:"col-12"},c={class:"card mt-3"},s={class:"card-header"},d={class:"d-flex justify-content-between"},i=r((function(){return(0,a.createElementVNode)("h3",{class:"card-tile"},"Leave Type Edit",-1)})),u=r((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1)})),m=(0,a.createTextVNode)(" Back "),p={class:"card-body row justify-content-center"},f={class:"col-lg-6"},v={class:"mb-3 row"},h={class:"col-md-6"},V=r((function(){return(0,a.createElementVNode)("option",{value:"",class:"d-none"},"Select Company",-1)})),N=["value"],b={class:"col-md-6"},y={class:"mb-3 row"},E={class:"col-lg-6"},k={class:"col-lg-6"},g={class:"mb-3 row"},w={class:"col-lg-6"},x=(0,a.createTextVNode)(),C=r((function(){return(0,a.createElementVNode)("br",null,null,-1)})),T={class:"switch"},_=["checked"],B=r((function(){return(0,a.createElementVNode)("span",{class:"slider round"},null,-1)})),D={class:"col-lg-6"},M={class:"custom-control custom-checkbox"},S=["checked"],L=r((function(){return(0,a.createElementVNode)("label",{class:"custom-control-label",for:"auto_approve"},"Allow auto approve",-1)})),U=["disabled"],q={key:1},j=[r((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)})),(0,a.createTextVNode)(" Save ")];const z={props:{users:{type:Array,required:!0},leaveType:{type:Object,required:!0}},data:function(){return{form:this.$inertia.form({user_id:this.leaveType.company.user_id,name:this.leaveType.name,color:this.leaveType.color,balance:this.leaveType.balance,auto_approve:!!this.leaveType.auto_approve,status:!!this.leaveType.status})}},methods:{updateData:function(){this.form.put(route("leaveTypes.update",this.leaveType.id))},statusChange:function(e){this.form.status=e.target.checked}}};var Z=o(3379),I=o.n(Z),A=o(1094),F={insert:"head",singleton:!1};I()(A.Z,F);A.Z.locals;const H=(0,o(3744).Z)(z,[["render",function(e,t,o,r,z,Z){var I=(0,a.resolveComponent)("Head"),A=(0,a.resolveComponent)("Link"),F=(0,a.resolveComponent)("Label"),H=(0,a.resolveComponent)("ErrorMessage"),O=(0,a.resolveComponent)("Loading");return(0,a.openBlock)(),(0,a.createElementBlock)(a.Fragment,null,[(0,a.createVNode)(I,{title:"Leave Type Edit"}),(0,a.createElementVNode)("div",n,[(0,a.createElementVNode)("div",l,[(0,a.createElementVNode)("div",c,[(0,a.createElementVNode)("div",s,[(0,a.createElementVNode)("div",d,[i,(0,a.createVNode)(A,{href:e.route("leaveTypes.index"),class:"btn btn-primary"},{default:(0,a.withCtx)((function(){return[u,m]})),_:1},8,["href"])])]),(0,a.createElementVNode)("div",p,[(0,a.createElementVNode)("div",f,[(0,a.createElementVNode)("form",{onSubmit:t[7]||(t[7]=(0,a.withModifiers)((function(){return Z.updateData&&Z.updateData.apply(Z,arguments)}),["prevent"]))},[(0,a.createElementVNode)("div",v,[(0,a.createElementVNode)("div",h,[(0,a.createVNode)(F,{name:"Company"}),(0,a.withDirectives)((0,a.createElementVNode)("select",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return z.form.user_id=e}),id:"company",class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.user_id}])},[V,((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,null,(0,a.renderList)(o.users,(function(e){return(0,a.openBlock)(),(0,a.createElementBlock)("option",{value:e.id,key:e.id},(0,a.toDisplayString)(e.name),9,N)})),128))],2),[[a.vModelSelect,z.form.user_id]]),(0,a.createVNode)(H,{name:z.form.errors.user_id},null,8,["name"])]),(0,a.createElementVNode)("div",b,[(0,a.createVNode)(F,{name:"Type Name"}),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return z.form.name=e}),type:"text",class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.name}]),id:"name"},null,2),[[a.vModelText,z.form.name]]),(0,a.createVNode)(H,{name:z.form.errors.name},null,8,["name"])])]),(0,a.createElementVNode)("div",y,[(0,a.createElementVNode)("div",E,[(0,a.createVNode)(F,{name:"Color",required:!1}),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[2]||(t[2]=function(e){return z.form.color=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.color}]),type:"color"},null,2),[[a.vModelText,z.form.color]]),(0,a.createVNode)(H,{name:z.form.errors.color},null,8,["name"])]),(0,a.createElementVNode)("div",k,[(0,a.createVNode)(F,{name:"Leave Balance Day",required:!1}),(0,a.withDirectives)((0,a.createElementVNode)("input",{min:"1","onUpdate:modelValue":t[3]||(t[3]=function(e){return z.form.balance=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.balance}]),type:"number"},null,2),[[a.vModelText,z.form.balance]]),(0,a.createVNode)(H,{name:z.form.errors.balance},null,8,["name"])])]),(0,a.createElementVNode)("div",g,[(0,a.createElementVNode)("div",w,[(0,a.createVNode)(F,{name:"Status",required:!1}),x,C,(0,a.createElementVNode)("label",T,[(0,a.withDirectives)((0,a.createElementVNode)("input",{onChange:t[4]||(t[4]=function(){return Z.statusChange&&Z.statusChange.apply(Z,arguments)}),"onUpdate:modelValue":t[5]||(t[5]=function(e){return z.form.status=e}),type:"checkbox",class:"success toggle-switch",checked:z.form.status},null,40,_),[[a.vModelCheckbox,z.form.status]]),B])]),(0,a.createElementVNode)("div",D,[(0,a.createElementVNode)("div",M,[(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[6]||(t[6]=function(e){return z.form.auto_approve=e}),type:"checkbox",class:"custom-control-input",id:"auto_approve",checked:z.form.auto_approve},null,8,S),[[a.vModelCheckbox,z.form.auto_approve]]),L])])]),(0,a.createElementVNode)("button",{disabled:z.form.processing,type:"submit",class:"btn btn-primary"},[z.form.processing?((0,a.openBlock)(),(0,a.createBlock)(O,{key:0})):((0,a.openBlock)(),(0,a.createElementBlock)("span",q,j))],8,U)],32)])])])])])],64)}],["__scopeId","data-v-8ae4c526"]])}}]);