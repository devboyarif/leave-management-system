"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[181],{4925:(e,t,o)=>{o.d(t,{Z:()=>n});var a=o(3645),r=o.n(a)()((function(e){return e[1]}));r.push([e.id,'.switch[data-v-684ae0fa]{display:inline-block;height:19px;position:relative;width:35px}.switch input[data-v-684ae0fa]{display:none}.slider[data-v-684ae0fa]{background-color:#ccc;bottom:0;cursor:pointer;left:0;right:0;top:0}.slider[data-v-684ae0fa],.slider[data-v-684ae0fa]:before{position:absolute;transition:.4s}.slider[data-v-684ae0fa]:before{background-color:#fff;bottom:2px;content:"";height:15px;left:3px;width:15px}input.success:checked+.slider[data-v-684ae0fa]{background-color:#28a745}input:checked+.slider[data-v-684ae0fa]:before{transform:translateX(15px)}.slider.round[data-v-684ae0fa]{border-radius:34px}.slider.round[data-v-684ae0fa]:before{border-radius:50%}',""]);const n=r},2181:(e,t,o)=>{o.r(t),o.d(t,{default:()=>F});var a=o(821),r=function(e){return(0,a.pushScopeId)("data-v-684ae0fa"),e=e(),(0,a.popScopeId)(),e},n={class:"row justify-content-center"},l={class:"col-6"},c={class:"card mt-3"},s={class:"card-header"},d={class:"d-flex justify-content-between"},i=r((function(){return(0,a.createElementVNode)("h3",null,"Leave Type Create",-1)})),u=r((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1)})),m=(0,a.createTextVNode)(" Back "),f={class:"card-body"},p={class:"mb-3 row"},v={class:"col-md-6"},h=r((function(){return(0,a.createElementVNode)("option",{value:"",class:"d-none"},"Select Company",-1)})),V=["value"],b={class:"col-md-6"},N={class:"mb-3 row"},E={class:"col-lg-6"},y={class:"col-lg-6"},k={class:"mb-3 row"},w={class:"col-lg-6"},x=(0,a.createTextVNode)(),g=r((function(){return(0,a.createElementVNode)("br",null,null,-1)})),C={class:"switch"},_=r((function(){return(0,a.createElementVNode)("span",{class:"slider round"},null,-1)})),B={class:"col-lg-6"},D={class:"custom-control custom-checkbox"},T=r((function(){return(0,a.createElementVNode)("label",{class:"custom-control-label",for:"half_day"},"Allow half day",-1)})),M={class:"custom-control custom-checkbox"},S=r((function(){return(0,a.createElementVNode)("label",{class:"custom-control-label",for:"auto_approve"},"Allow auto approve",-1)})),L=["disabled"],U={key:0,class:"fa-solid fa-check"},q=(0,a.createTextVNode)(" Save ");const z={props:{users:{type:Array,required:!0}},data:function(){return{form:this.$inertia.form({user_id:"",name:null,color:"#ABB8C3",balance:7,allow_half_day:!1,auto_approve:!1,status:!0})}},methods:{createData:function(){this.form.post(route("leaveTypes.store"))},statusChange:function(e){this.form.status=e.target.checked}}};var A=o(3379),Z=o.n(A),I=o(4925),j={insert:"head",singleton:!1};Z()(I.Z,j);I.Z.locals;const F=(0,o(3744).Z)(z,[["render",function(e,t,o,r,z,A){var Z=(0,a.resolveComponent)("Head"),I=(0,a.resolveComponent)("Link"),j=(0,a.resolveComponent)("Label"),F=(0,a.resolveComponent)("ErrorMessage"),H=(0,a.resolveComponent)("Loading");return(0,a.openBlock)(),(0,a.createElementBlock)(a.Fragment,null,[(0,a.createVNode)(Z,{title:"Leave Type Create"}),(0,a.createElementVNode)("div",n,[(0,a.createElementVNode)("div",l,[(0,a.createElementVNode)("div",c,[(0,a.createElementVNode)("div",s,[(0,a.createElementVNode)("div",d,[i,(0,a.createVNode)(I,{href:e.route("leaveTypes.index"),class:"btn btn-primary"},{default:(0,a.withCtx)((function(){return[u,m]})),_:1},8,["href"])])]),(0,a.createElementVNode)("div",f,[(0,a.createElementVNode)("form",{onSubmit:t[8]||(t[8]=(0,a.withModifiers)((function(){return A.createData&&A.createData.apply(A,arguments)}),["prevent"]))},[(0,a.createElementVNode)("div",p,[(0,a.createElementVNode)("div",v,[(0,a.createVNode)(j,{name:"Company"}),(0,a.withDirectives)((0,a.createElementVNode)("select",{"onUpdate:modelValue":t[0]||(t[0]=function(e){return z.form.user_id=e}),id:"company",class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.user_id}])},[h,((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,null,(0,a.renderList)(o.users,(function(e){return(0,a.openBlock)(),(0,a.createElementBlock)("option",{value:e.id,key:e.id},(0,a.toDisplayString)(e.name),9,V)})),128))],2),[[a.vModelSelect,z.form.user_id]]),(0,a.createVNode)(F,{name:z.form.errors.user_id},null,8,["name"])]),(0,a.createElementVNode)("div",b,[(0,a.createVNode)(j,{name:"Type Name"}),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[1]||(t[1]=function(e){return z.form.name=e}),type:"text",class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.name}]),id:"name"},null,2),[[a.vModelText,z.form.name]]),(0,a.createVNode)(F,{name:z.form.errors.name},null,8,["name"])])]),(0,a.createElementVNode)("div",N,[(0,a.createElementVNode)("div",E,[(0,a.createVNode)(j,{name:"Color",required:!1}),(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[2]||(t[2]=function(e){return z.form.color=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.color}]),type:"color"},null,2),[[a.vModelText,z.form.color]]),(0,a.createVNode)(F,{name:z.form.errors.color},null,8,["name"])]),(0,a.createElementVNode)("div",y,[(0,a.createVNode)(j,{name:"Leave Balance Day",required:!1}),(0,a.withDirectives)((0,a.createElementVNode)("input",{min:"1","onUpdate:modelValue":t[3]||(t[3]=function(e){return z.form.balance=e}),class:(0,a.normalizeClass)(["form-control",{"is-invalid":z.form.errors.balance}]),type:"number"},null,2),[[a.vModelText,z.form.balance]]),(0,a.createVNode)(F,{name:z.form.errors.balance},null,8,["name"])])]),(0,a.createElementVNode)("div",k,[(0,a.createElementVNode)("div",w,[(0,a.createVNode)(j,{name:"Status",required:!1}),x,g,(0,a.createElementVNode)("label",C,[(0,a.withDirectives)((0,a.createElementVNode)("input",{onChange:t[4]||(t[4]=function(){return A.statusChange&&A.statusChange.apply(A,arguments)}),"onUpdate:modelValue":t[5]||(t[5]=function(e){return z.form.status=e}),type:"checkbox",class:"success toggle-switch",checked:""},null,544),[[a.vModelCheckbox,z.form.status]]),_])]),(0,a.createElementVNode)("div",B,[(0,a.createElementVNode)("div",D,[(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[6]||(t[6]=function(e){return z.form.allow_half_day=e}),type:"checkbox",class:"custom-control-input",id:"half_day"},null,512),[[a.vModelCheckbox,z.form.allow_half_day]]),T]),(0,a.createElementVNode)("div",M,[(0,a.withDirectives)((0,a.createElementVNode)("input",{"onUpdate:modelValue":t[7]||(t[7]=function(e){return z.form.auto_approve=e}),type:"checkbox",class:"custom-control-input",id:"auto_approve"},null,512),[[a.vModelCheckbox,z.form.auto_approve]]),S])])]),(0,a.createElementVNode)("button",{disabled:z.form.processing,type:"submit",class:"btn btn-primary"},[z.form.processing?((0,a.openBlock)(),(0,a.createBlock)(H,{key:1})):((0,a.openBlock)(),(0,a.createElementBlock)("i",U)),q],8,L)],32)])])])])],64)}],["__scopeId","data-v-684ae0fa"]])}}]);