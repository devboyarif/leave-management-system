"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[3611],{3682:(e,t,n)=>{n.d(t,{Z:()=>l});var a=n(3645),o=n.n(a)()((function(e){return e[1]}));o.push([e.id,'.switch[data-v-d1c525be]{display:inline-block;height:19px;position:relative;width:35px}.switch input[data-v-d1c525be]{display:none}.slider[data-v-d1c525be]{background-color:#ccc;bottom:0;cursor:pointer;left:0;right:0;top:0}.slider[data-v-d1c525be],.slider[data-v-d1c525be]:before{position:absolute;transition:.4s}.slider[data-v-d1c525be]:before{background-color:#fff;bottom:2px;content:"";height:15px;left:3px;width:15px}input.success:checked+.slider[data-v-d1c525be]{background-color:#28a745}input:checked+.slider[data-v-d1c525be]:before{transform:translateX(15px)}.slider.round[data-v-d1c525be]{border-radius:34px}.slider.round[data-v-d1c525be]:before{border-radius:50%}',""]);const l=o},3611:(e,t,n)=>{n.r(t),n.d(t,{default:()=>re});var a=n(821),o=function(e){return(0,a.pushScopeId)("data-v-d1c525be"),e=e(),(0,a.popScopeId)(),e},l={class:"row"},r={class:"col-6"},c={class:"d-flex align-items-center mb-1 mt-3"},s={class:"form-row align-items-end mr-3"},i={class:"col-auto"},d={for:"",class:"mr-sm-2"},u=["value"],m={class:"col-auto"},g={class:"row justify-content-center"},p={class:"col-8"},f={class:"card mt-3"},E={class:"card-header"},h={class:"d-flex justify-content-between"},v={class:"card-body table-responsive p-0"},V={class:"table table-valign-middle"},N={key:0,class:"badge badge-primary"},b={class:"switch"},k=["onChange","checked"],y=o((function(){return(0,a.createElementVNode)("span",{class:"slider round"},null,-1)})),_={class:"d-flex"},D=["onClick"],S=["onClick"],B={key:1},C={colspan:"5",class:"text-center"},w={class:"col-4"},L={class:"card mt-3"},x={class:"card-header"},M={class:"d-flex justify-content-between"},I={key:0},T={key:1},F={class:"card-body"},U={class:"mb-3"},$={value:"",class:"d-none"},A=["value"],Z={class:"mb-3"},j={value:"",class:"d-none"},z=["value"],P={class:"mb-3"},R={value:"ltr"},Y={value:"rtl"},q={class:"mb-3"},H=(0,a.createTextVNode)(),X=o((function(){return(0,a.createElementVNode)("br",null,null,-1)})),G={class:"switch"},J=o((function(){return(0,a.createElementVNode)("span",{class:"slider round"},null,-1)})),K=["disabled"],O={key:1},Q=o((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)})),W=o((function(){return(0,a.createElementVNode)("i",{class:"fa-solid fa-times"},null,-1)}));const ee={layout:"Setting",props:{languages:Array,langInfos:Array,defaultLanguage:Number},data:function(){return{isEditMode:!1,selectedId:"",default_language:this.defaultLanguage,languageStatus:!1,form:this.$inertia.form({name:"",code:"",direction:"ltr",status:!0})}},methods:{saveData:function(){this.isEditMode?this.updateData():this.createData()},createData:function(){var e=this;console.log(this.form),this.form.post(route("languages.store"),{onSuccess:function(){return e.form.reset()}})},editLanguage:function(e){console.log(e),this.isEditMode=!0,this.selectedId=e.id,this.form.name=e.name,this.form.code=e.code,this.form.direction=e.direction},cancelEdit:function(){this.isEditMode=!1,this.form.reset()},updateData:function(){var e=this;this.form.put(route("languages.update",this.selectedId),{onSuccess:function(){e.isEditMode=!1,e.form.reset()}})},deleteData:function(e){var t=this;this.$swal({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(n){n.isConfirmed&&t.$inertia.delete(route("languages.destroy",e))}))},languageStatusUpdate:function(e){this.$inertia.put(route("languages.status.update",e))},statusChange:function(e){this.form.status=e.target.checked},setDefaultLanguage:function(){this.$inertia.put(route("languages.set.default",this.default_language))}},mounted:function(){this.checkPagePermission("admin")}};var te=n(3379),ne=n.n(te),ae=n(3682),oe={insert:"head",singleton:!1};ne()(ae.Z,oe);ae.Z.locals;const le=(0,n(3744).Z)(ee,[["render",function(e,t,n,o,ee,te){var ne=(0,a.resolveComponent)("Head"),ae=(0,a.resolveComponent)("CogIcon"),oe=(0,a.resolveComponent)("Link"),le=(0,a.resolveComponent)("EditIcon"),re=(0,a.resolveComponent)("DeleteIcon"),ce=(0,a.resolveComponent)("Label"),se=(0,a.resolveComponent)("ErrorMessage"),ie=(0,a.resolveComponent)("Loading"),de=(0,a.resolveDirective)("tooltip");return(0,a.openBlock)(),(0,a.createElementBlock)(a.Fragment,null,[(0,a.createVNode)(ne,{title:e.__("Language List")},null,8,["title"]),(0,a.createElementVNode)("div",l,[(0,a.createElementVNode)("div",r,[(0,a.createElementVNode)("div",c,[(0,a.createElementVNode)("div",s,[(0,a.createElementVNode)("div",i,[(0,a.createElementVNode)("label",d,(0,a.toDisplayString)(e.__("Set Default Language")),1),(0,a.withDirectives)((0,a.createElementVNode)("select",{class:"custom-select mr-sm-2",id:"inlineFormCustomSelect","onUpdate:modelValue":t[0]||(t[0]=function(e){return ee.default_language=e})},[((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,null,(0,a.renderList)(n.languages,(function(e){return(0,a.openBlock)(),(0,a.createElementBlock)("option",{key:e.id,value:e.id},(0,a.toDisplayString)(e.name),9,u)})),128))],512),[[a.vModelSelect,ee.default_language]])]),(0,a.createElementVNode)("div",m,[(0,a.createElementVNode)("button",{onClick:t[1]||(t[1]=function(){return te.setDefaultLanguage&&te.setDefaultLanguage.apply(te,arguments)}),type:"button",class:"btn btn-primary",style:{"margin-top":"30px"}},(0,a.toDisplayString)(e.__("Save")),1)])])])])]),(0,a.createElementVNode)("div",g,[(0,a.createElementVNode)("div",p,[(0,a.createElementVNode)("div",f,[(0,a.createElementVNode)("div",E,[(0,a.createElementVNode)("div",h,[(0,a.createElementVNode)("span",null,(0,a.toDisplayString)(e.__("Language List")),1)])]),(0,a.createElementVNode)("div",v,[(0,a.createElementVNode)("table",V,[(0,a.createElementVNode)("thead",null,[(0,a.createElementVNode)("tr",null,[(0,a.createElementVNode)("th",null,(0,a.toDisplayString)(e.__("Name")),1),(0,a.createElementVNode)("th",null,(0,a.toDisplayString)(e.__("Code")),1),(0,a.createElementVNode)("th",null,(0,a.toDisplayString)(e.__("Direction")),1),(0,a.createElementVNode)("th",null,(0,a.toDisplayString)(e.__("Status")),1),(0,a.createElementVNode)("th",null,(0,a.toDisplayString)(e.__("Action")),1)])]),(0,a.createElementVNode)("tbody",null,[n.languages&&n.languages.length?((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,{key:0},(0,a.renderList)(n.languages,(function(t,o){return(0,a.openBlock)(),(0,a.createElementBlock)("tr",{key:o},[(0,a.createElementVNode)("td",null,[(0,a.createTextVNode)((0,a.toDisplayString)(t.name)+" ",1),t.id==n.defaultLanguage?((0,a.openBlock)(),(0,a.createElementBlock)("span",N,(0,a.toDisplayString)(e.__("Default")),1)):(0,a.createCommentVNode)("",!0)]),(0,a.createElementVNode)("td",null,(0,a.toDisplayString)(t.code),1),(0,a.createElementVNode)("td",null,(0,a.toDisplayString)(t.direction),1),(0,a.createElementVNode)("td",null,[(0,a.createElementVNode)("label",b,[(0,a.createElementVNode)("input",{onChange:function(e){return te.languageStatusUpdate(t.id)},type:"checkbox",class:"success toggle-switch",checked:t.status},null,40,k),y])]),(0,a.createElementVNode)("td",_,[(0,a.withDirectives)(((0,a.openBlock)(),(0,a.createBlock)(oe,{href:e.route("languages.translation.edit",t.id),class:"btn btn-sm pl-0"},{default:(0,a.withCtx)((function(){return[(0,a.createVNode)(ae)]})),_:2},1032,["href"])),[[de,e.__("Translate Language")]]),(0,a.withDirectives)(((0,a.openBlock)(),(0,a.createElementBlock)("button",{onClick:function(e){return te.editLanguage(t)},class:"btn btn-sm"},[(0,a.createVNode)(le)],8,D)),[[de,e.__("Language Edit")]]),(0,a.withDirectives)(((0,a.openBlock)(),(0,a.createElementBlock)("button",{onClick:function(e){return te.deleteData(t.id)},class:"btn btn-sm"},[(0,a.createVNode)(re)],8,S)),[[de,e.__("Language Delete")]])])])})),128)):((0,a.openBlock)(),(0,a.createElementBlock)("tr",B,[(0,a.createElementVNode)("td",C,[(0,a.createElementVNode)("h6",null,(0,a.toDisplayString)(e.__("No Data Found")),1)])]))])])])])]),(0,a.createElementVNode)("div",w,[(0,a.createElementVNode)("div",L,[(0,a.createElementVNode)("div",x,[(0,a.createElementVNode)("div",M,[ee.isEditMode?((0,a.openBlock)(),(0,a.createElementBlock)("span",T,(0,a.toDisplayString)(e.__("Language Edit")),1)):((0,a.openBlock)(),(0,a.createElementBlock)("span",I,(0,a.toDisplayString)(e.__("Language Create")),1))])]),(0,a.createElementVNode)("div",F,[(0,a.createElementVNode)("form",{onSubmit:t[8]||(t[8]=(0,a.withModifiers)((function(){return te.saveData&&te.saveData.apply(te,arguments)}),["prevent"]))},[(0,a.createElementVNode)("div",U,[(0,a.createVNode)(ce,{name:e.__("Name")},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("select",{class:(0,a.normalizeClass)(["form-control",{"is-invalid":ee.form.errors.name}]),"onUpdate:modelValue":t[2]||(t[2]=function(e){return ee.form.name=e})},[(0,a.createElementVNode)("option",$,(0,a.toDisplayString)(e.__("Select Language")),1),((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,null,(0,a.renderList)(n.langInfos,(function(e,t){return(0,a.openBlock)(),(0,a.createElementBlock)("option",{key:t,value:e.name},(0,a.toDisplayString)(e.name),9,A)})),128))],2),[[a.vModelSelect,ee.form.name]]),(0,a.createVNode)(se,{name:ee.form.errors.name},null,8,["name"])]),(0,a.createElementVNode)("div",Z,[(0,a.createVNode)(ce,{name:e.__("Code")},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("select",{class:(0,a.normalizeClass)(["form-control",{"is-invalid":ee.form.errors.code}]),"onUpdate:modelValue":t[3]||(t[3]=function(e){return ee.form.code=e})},[(0,a.createElementVNode)("option",j,(0,a.toDisplayString)(e.__("Select Language Code")),1),((0,a.openBlock)(!0),(0,a.createElementBlock)(a.Fragment,null,(0,a.renderList)(n.langInfos,(function(e,t){return(0,a.openBlock)(),(0,a.createElementBlock)("option",{key:t,value:t},(0,a.toDisplayString)(t),9,z)})),128))],2),[[a.vModelSelect,ee.form.code]]),(0,a.createVNode)(se,{name:ee.form.errors.code},null,8,["name"])]),(0,a.createElementVNode)("div",P,[(0,a.createVNode)(ce,{name:e.__("Direction")},null,8,["name"]),(0,a.withDirectives)((0,a.createElementVNode)("select",{class:(0,a.normalizeClass)(["form-control",{"is-invalid":ee.form.errors.direction}]),"onUpdate:modelValue":t[4]||(t[4]=function(e){return ee.form.direction=e})},[(0,a.createElementVNode)("option",R,(0,a.toDisplayString)(e.__("LTR")),1),(0,a.createElementVNode)("option",Y,(0,a.toDisplayString)(e.__("RTL")),1)],2),[[a.vModelSelect,ee.form.direction]]),(0,a.createVNode)(se,{name:ee.form.errors.direction},null,8,["name"])]),(0,a.createElementVNode)("div",q,[(0,a.createVNode)(ce,{name:e.__("Status"),required:!1},null,8,["name"]),H,X,(0,a.createElementVNode)("label",G,[(0,a.withDirectives)((0,a.createElementVNode)("input",{onChange:t[5]||(t[5]=function(){return te.statusChange&&te.statusChange.apply(te,arguments)}),"onUpdate:modelValue":t[6]||(t[6]=function(e){return ee.form.status=e}),type:"checkbox",class:"success toggle-switch",checked:""},null,544),[[a.vModelCheckbox,ee.form.status]]),J])]),(0,a.createElementVNode)("button",{disabled:ee.form.processing,type:"submit",class:"btn btn-primary"},[ee.form.processing?((0,a.openBlock)(),(0,a.createBlock)(ie,{key:0,message:"Saving..."})):((0,a.openBlock)(),(0,a.createElementBlock)("span",O,[Q,(0,a.createTextVNode)(" "+(0,a.toDisplayString)(e.__("Save")),1)]))],8,K),ee.isEditMode?((0,a.openBlock)(),(0,a.createElementBlock)("button",{key:0,onClick:t[7]||(t[7]=function(){return te.cancelEdit&&te.cancelEdit.apply(te,arguments)}),type:"button",class:"btn btn-danger ml-2"},[W,(0,a.createTextVNode)(" "+(0,a.toDisplayString)(e.__("Cancel")),1)])):(0,a.createCommentVNode)("",!0)],32)])])])])],64)}],["__scopeId","data-v-d1c525be"]]),re=le}}]);