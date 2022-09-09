"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[8128],{1582:(e,r,o)=>{o.d(r,{Z:()=>s});var t=o(3645),a=o.n(t)()((function(e){return e[1]}));a.push([e.id,"#image[data-v-0436b23c]{-o-object-fit:cover;object-fit:cover}",""]);const s=a},8128:(e,r,o)=>{o.r(r),o.d(r,{default:()=>me});var t=o(821),a=function(e){return(0,t.pushScopeId)("data-v-0436b23c"),e=e(),(0,t.popScopeId)(),e},s={class:"container"},l={class:"main-body"},n={class:"row gutters-sm"},c={class:"col-md-4 mb-3"},d={class:"card"},i={class:"card-body"},m={class:"d-flex flex-column align-items-center text-center"},p=["src"],u={class:"mt-3"},f=a((function(){return(0,t.createElementVNode)("p",{class:"text-secondary mb-1"},"Admin",-1)})),N={class:"text-secondary mb-1"},v={class:"col-md-8"},V={class:"card mb-3"},E={class:"card-body"},w={class:"row"},g={class:"col-sm-3"},h={class:"mb-0"},y={class:"col-sm-9 text-secondary"},b=a((function(){return(0,t.createElementVNode)("hr",null,null,-1)})),_={class:"row"},k={class:"col-sm-3"},F={class:"mb-0"},C={class:"col-sm-9 text-secondary"},S={class:"row gutters-sm"},D={class:"col-sm-6 mb-3"},x={class:"card h-100"},U={class:"card-header"},B={class:"card-body"},P={class:"row justify-content-center"},j={class:"col-sm-8"},M={class:"form-group"},z={class:"form-group"},T={class:"form-group"},I={class:"custom-file"},L={class:"custom-file-label",for:"customFile"},Z={class:"form-group"},A={class:"offset-sm-3 col-sm-9"},q=["disabled"],O={key:1},R=a((function(){return(0,t.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)})),$={class:"col-sm-6 mb-3"},H={class:"card h-100"},G={class:"card-header"},J={class:"card-body"},K={class:"row justify-content-center"},Q={class:"col-sm-8"},W={id:"password_visibility"},X={class:"form-group"},Y={class:"form-group"},ee={class:"form-group"},re={class:"form-group"},oe={class:"offset-sm-3 col-sm-9"},te=["disabled"],ae={key:1},se=a((function(){return(0,t.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1)}));const le={props:{user:{type:Object,required:!0}},data:function(){return{preview_image:this.user.avatar,form:this.$inertia.form({name:this.user.name,email:this.user.email,avatar:null}),passwordForm:this.$inertia.form({current_password:"",password:"",password_confirmation:""})}},methods:{profileUpdate:function(){this.form.post(route("user.profile.update"))},passwordUpdate:function(){var e=this;this.passwordForm.post(route("user.password.update"),{onSuccess:function(){return e.passwordForm.reset()}})}}};var ne=o(3379),ce=o.n(ne),de=o(1582),ie={insert:"head",singleton:!1};ce()(de.Z,ie);de.Z.locals;const me=(0,o(3744).Z)(le,[["render",function(e,r,o,a,le,ne){var ce=(0,t.resolveComponent)("Head"),de=(0,t.resolveComponent)("Label"),ie=(0,t.resolveComponent)("ErrorMessage"),me=(0,t.resolveComponent)("Loading");return(0,t.openBlock)(),(0,t.createElementBlock)(t.Fragment,null,[(0,t.createVNode)(ce,{title:e.__("Profile")},null,8,["title"]),(0,t.createElementVNode)("div",s,[(0,t.createElementVNode)("div",l,[(0,t.createElementVNode)("div",n,[(0,t.createElementVNode)("div",c,[(0,t.createElementVNode)("div",d,[(0,t.createElementVNode)("div",i,[(0,t.createElementVNode)("div",m,[(0,t.createElementVNode)("img",{id:"image",src:le.preview_image,alt:"Admin",class:"rounded-circle position-relative",width:"150",height:"150"},null,8,p),(0,t.createElementVNode)("div",u,[(0,t.createElementVNode)("h4",null,(0,t.toDisplayString)(o.user.name),1),f,(0,t.createElementVNode)("p",N,(0,t.toDisplayString)(e.__("Member Since"))+": 1 july 2020",1)])])])])]),(0,t.createElementVNode)("div",v,[(0,t.createElementVNode)("div",V,[(0,t.createElementVNode)("div",E,[(0,t.createElementVNode)("div",w,[(0,t.createElementVNode)("div",g,[(0,t.createElementVNode)("h6",h,(0,t.toDisplayString)(e.__("Name")),1)]),(0,t.createElementVNode)("div",y,(0,t.toDisplayString)(o.user.name),1)]),b,(0,t.createElementVNode)("div",_,[(0,t.createElementVNode)("div",k,[(0,t.createElementVNode)("h6",F,(0,t.toDisplayString)(e.__("Email")),1)]),(0,t.createElementVNode)("div",C,(0,t.toDisplayString)(o.user.email),1)])])])])]),(0,t.createElementVNode)("div",S,[(0,t.createElementVNode)("div",D,[(0,t.createElementVNode)("div",x,[(0,t.createElementVNode)("div",U,(0,t.toDisplayString)(e.__("Profile Setting")),1),(0,t.createElementVNode)("div",B,[(0,t.createElementVNode)("div",P,[(0,t.createElementVNode)("div",j,[(0,t.createElementVNode)("form",{class:"form-horizontal",autocomplete:"off",onSubmit:r[3]||(r[3]=(0,t.withModifiers)((function(){return ne.profileUpdate&&ne.profileUpdate.apply(ne,arguments)}),["prevent"]))},[(0,t.createElementVNode)("div",M,[(0,t.createVNode)(de,{name:e.__("Name")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[0]||(r[0]=function(e){return le.form.name=e}),type:"text",class:(0,t.normalizeClass)(["form-control",{"is-invalid":le.form.errors.name}]),placeholder:"Enter New Name"},null,2),[[t.vModelText,le.form.name]]),(0,t.createVNode)(ie,{name:le.form.errors.name},null,8,["name"])]),(0,t.createElementVNode)("div",z,[(0,t.createVNode)(de,{name:e.__("Email")},null,8,["name"]),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[1]||(r[1]=function(e){return le.form.email=e}),type:"email",class:(0,t.normalizeClass)(["form-control",{"is-invalid":le.form.errors.email}]),placeholder:"Enter New Email"},null,2),[[t.vModelText,le.form.email]]),(0,t.createVNode)(ie,{name:le.form.errors.email},null,8,["name"])]),(0,t.createElementVNode)("div",T,[(0,t.createVNode)(de,{name:e.__("Change Avatar"),forName:"change_image",required:!1},null,8,["name"]),(0,t.createElementVNode)("div",I,[(0,t.createElementVNode)("input",{accept:"image/jpeg, image/jpg/ image/png",onInput:r[2]||(r[2]=function(e){return le.form.avatar=e.target.files[0]}),autocomplete:"image",onchange:"document.getElementById('image').src = window.URL.createObjectURL(this.files[0])",type:"file",class:"custom-file-input",id:"customFile"},null,32),(0,t.createElementVNode)("label",L,(0,t.toDisplayString)(e.__("Choose file")),1)])]),(0,t.createElementVNode)("div",Z,[(0,t.createElementVNode)("div",A,[(0,t.createElementVNode)("button",{disabled:le.form.processing,type:"submit",class:"btn btn-primary"},[le.form.processing?((0,t.openBlock)(),(0,t.createBlock)(me,{key:0})):((0,t.openBlock)(),(0,t.createElementBlock)("span",O,[R,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Update Profile")),1)]))],8,q)])])],32)])])])])]),(0,t.createElementVNode)("div",$,[(0,t.createElementVNode)("div",H,[(0,t.createElementVNode)("div",G,(0,t.toDisplayString)(e.__("Change Password")),1),(0,t.createElementVNode)("div",J,[(0,t.createElementVNode)("div",K,[(0,t.createElementVNode)("div",Q,[(0,t.createElementVNode)("form",{class:"form-horizontal",autocomplete:"off",onSubmit:r[7]||(r[7]=(0,t.withModifiers)((function(){return ne.passwordUpdate&&ne.passwordUpdate.apply(ne,arguments)}),["prevent"]))},[(0,t.createElementVNode)("div",W,[(0,t.createElementVNode)("div",X,[(0,t.createVNode)(de,{name:"Current Password"}),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[4]||(r[4]=function(e){return le.passwordForm.current_password=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":le.passwordForm.errors.current_password}]),placeholder:"Enter Current Password"},null,2),[[t.vModelText,le.passwordForm.current_password]]),(0,t.createVNode)(ie,{name:le.passwordForm.errors.current_password},null,8,["name"])]),(0,t.createElementVNode)("div",Y,[(0,t.createVNode)(de,{name:"New Password"}),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[5]||(r[5]=function(e){return le.passwordForm.password=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":le.passwordForm.errors.password}]),placeholder:"Enter New Password"},null,2),[[t.vModelText,le.passwordForm.password]]),(0,t.createVNode)(ie,{name:le.passwordForm.errors.password},null,8,["name"])]),(0,t.createElementVNode)("div",ee,[(0,t.createVNode)(de,{name:"Confirm Password"}),(0,t.withDirectives)((0,t.createElementVNode)("input",{"onUpdate:modelValue":r[6]||(r[6]=function(e){return le.passwordForm.password_confirmation=e}),type:"password",class:(0,t.normalizeClass)(["form-control",{"is-invalid":le.passwordForm.errors.password_confirmation}]),placeholder:"Confirm New Password"},null,2),[[t.vModelText,le.passwordForm.password_confirmation]]),(0,t.createVNode)(ie,{name:le.passwordForm.errors.password_confirmation},null,8,["name"])])]),(0,t.createElementVNode)("div",re,[(0,t.createElementVNode)("div",oe,[(0,t.createElementVNode)("button",{disabled:le.passwordForm.processing,type:"submit",class:"btn btn-primary"},[le.passwordForm.processing?((0,t.openBlock)(),(0,t.createBlock)(me,{key:0})):((0,t.openBlock)(),(0,t.createElementBlock)("span",ae,[se,(0,t.createTextVNode)(" "+(0,t.toDisplayString)(e.__("Update Password")),1)]))],8,te)])])],32)])])])])])])])])],64)}],["__scopeId","data-v-0436b23c"]])}}]);