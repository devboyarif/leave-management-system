"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[3125],{3125:(e,t,l)=>{l.r(t),l.d(t,{default:()=>W});var o=l(821),n={class:"row justify-content-center"},a={class:"col-12"},r={class:"card mt-3"},i={class:"card-header"},c={class:"d-flex justify-content-between"},s={class:"card-title"},d=(0,o.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),m={class:"card-body table-responsive p-0"},u={class:"table table-valign-middle"},p={key:0},y=["src"],E={href:"#"},h={key:1},N={class:"text-danger ml-1"},V=["onClick"],k=["onClick"],f=["onClick"],_={key:1},g={colspan:"5",class:"text-center"},D={key:0},v={class:"modal-mask"},b={class:"modal-wrapper"},w={class:"modal-dialog",role:"document"},B={class:"modal-content"},C={class:"modal-header"},S={class:"modal-title"},M={type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},q={class:"modal-body"},x={class:"table"},T={width:"30%"},H={width:"70%"},L={href:"#"},Y={width:"30%"},j={width:"70%"},F={width:"30%"},R={width:"70%"},I={width:"30%"},z={width:"70%"},A={width:"30%"},Z={width:"70%"},P={width:"50%"},O={width:"50%"},$={class:"modal-footer"};var G=l(9418),J=l(9680),K=l(7484),Q=l.n(K);const U={props:{holidays:Array,company:Object,user:Object},components:{Inertia:J.Inertia,Pagination:G.Z},data:function(){return{showModal:!1,form:{employee_name:"",employee_email:"",title:"",start:"",end:"",days:"",note:""}}},methods:{requestFor:function(e,t){var l=Q()(e).format("DD MMM, YYYY"),o=Q()(t).format("DD MMM, YYYY");return"".concat(l," - ").concat(o)},showDetails:function(e){this.form.employee_name=e.employee.user.name,this.form.employee_email=e.employee.user.email,this.form.days=e.days,this.form.title=e.title,this.form.start=e.start,this.form.end=e.end,this.form.note=e.note,this.showModal=!0},acceptRequest:function(e){J.Inertia.post(route("company.request.holidays.accept"),{id:e})},rejectRequest:function(e){this.$swal({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(t){t.isConfirmed&&J.Inertia.delete(route("company.request.holidays.reject",e))}))}}};const W=(0,l(3744).Z)(U,[["render",function(e,t,l,G,J,K){var Q=(0,o.resolveComponent)("Head"),U=(0,o.resolveComponent)("Link"),W=(0,o.resolveComponent)("EyeIcon"),X=(0,o.resolveComponent)("CheckIcon"),ee=(0,o.resolveComponent)("CrossIcon"),te=(0,o.resolveComponent)("Pagination"),le=(0,o.resolveDirective)("tooltip"),oe=(0,o.resolveDirective)("click-outside");return(0,o.openBlock)(),(0,o.createElementBlock)(o.Fragment,null,[(0,o.createVNode)(Q,{title:e.__("Holiday Request List")},null,8,["title"]),(0,o.createElementVNode)("div",n,[(0,o.createElementVNode)("div",a,[(0,o.createElementVNode)("div",r,[(0,o.createElementVNode)("div",i,[(0,o.createElementVNode)("div",c,[(0,o.createElementVNode)("h3",s,(0,o.toDisplayString)(e.__("Holiday Request List")),1),(0,o.createVNode)(U,{href:e.route("company.holidays.index"),class:"btn btn-primary"},{default:(0,o.withCtx)((function(){return[d,(0,o.createTextVNode)(" "+(0,o.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])]),(0,o.createElementVNode)("div",m,[(0,o.createElementVNode)("table",u,[(0,o.createElementVNode)("thead",null,[(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("th",null,(0,o.toDisplayString)(e.__("Employee")),1),(0,o.createElementVNode)("th",null,(0,o.toDisplayString)(e.__("Holiday Title")),1),(0,o.createElementVNode)("th",null,(0,o.toDisplayString)(e.__("Date")),1),(0,o.createElementVNode)("th",null,(0,o.toDisplayString)(e.__("Action")),1)])]),(0,o.createElementVNode)("tbody",null,[l.holidays&&l.holidays.data.length?((0,o.openBlock)(!0),(0,o.createElementBlock)(o.Fragment,{key:0},(0,o.renderList)(l.holidays.data,(function(t,l){return(0,o.openBlock)(),(0,o.createElementBlock)("tr",{key:l},[t.employee.user?((0,o.openBlock)(),(0,o.createElementBlock)("td",p,[(0,o.createElementVNode)("img",{src:t.employee.user.avatar,alt:"Product 1",class:"img-circle img-size-32 mr-2"},null,8,y),(0,o.createElementVNode)("a",E,(0,o.toDisplayString)(t.employee.user.name),1)])):(0,o.createCommentVNode)("",!0),(0,o.createElementVNode)("td",null,(0,o.toDisplayString)(t.title),1),t.start&&t.end?((0,o.openBlock)(),(0,o.createElementBlock)("td",h,[(0,o.createTextVNode)((0,o.toDisplayString)(K.requestFor(t.start,t.end))+" (",1),(0,o.createElementVNode)("span",N,(0,o.toDisplayString)(t.days)+" "+(0,o.toDisplayString)(e.pluralize(t.days,e.__("Day"))),1),(0,o.createTextVNode)(") "+(0,o.toDisplayString)(t.days)+" "+(0,o.toDisplayString)(e.pluralize(t.days,e.__("Day"))),1)])):(0,o.createCommentVNode)("",!0),(0,o.createElementVNode)("td",null,[(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("button",{onClick:function(e){return K.showDetails(t)},class:"btn btn-sm pl-0"},[(0,o.createVNode)(W)],8,V)),[[le,e.__("View holiday details")]]),(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("button",{onClick:function(e){return K.acceptRequest(t.id)},class:"btn btn-sm pl-0"},[(0,o.createVNode)(X)],8,k)),[[le,e.__("Accept and add to official holiday list")]]),(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("button",{onClick:function(e){return K.rejectRequest(t.id)},class:"btn btn-sm pl-0"},[(0,o.createVNode)(ee)],8,f)),[[le,e.__("Reject and delete from holiday request list")]])])])})),128)):((0,o.openBlock)(),(0,o.createElementBlock)("tr",_,[(0,o.createElementVNode)("td",g,[(0,o.createElementVNode)("h6",null,(0,o.toDisplayString)(e.__("No Data Found")),1)])]))])]),(0,o.createVNode)(te,{links:l.holidays.links},null,8,["links"])])])])]),J.showModal?((0,o.openBlock)(),(0,o.createElementBlock)("div",D,[(0,o.createVNode)(o.Transition,{name:"fade"},{default:(0,o.withCtx)((function(){return[(0,o.createElementVNode)("div",v,[(0,o.createElementVNode)("div",b,[(0,o.createElementVNode)("div",w,[(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("div",B,[(0,o.createElementVNode)("div",C,[(0,o.createElementVNode)("h5",S,(0,o.toDisplayString)(e.__("Request Holiday Details")),1),(0,o.createElementVNode)("button",M,[(0,o.createElementVNode)("span",{"aria-hidden":"true",onClick:t[0]||(t[0]=function(e){return J.showModal=!1})},"×")])]),(0,o.createElementVNode)("div",q,[(0,o.createElementVNode)("table",x,[(0,o.createElementVNode)("tbody",null,[(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",T,(0,o.toDisplayString)(e.__("Employee Name")),1),(0,o.createElementVNode)("td",H,[(0,o.createElementVNode)("a",L,(0,o.toDisplayString)(J.form.employee_name),1)])]),(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",Y,(0,o.toDisplayString)(e.__("Email")),1),(0,o.createElementVNode)("td",j,(0,o.toDisplayString)(J.form.employee_email),1)]),(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",F,(0,o.toDisplayString)(e.__("Holiday Title")),1),(0,o.createElementVNode)("td",R,(0,o.toDisplayString)(J.form.title),1)]),(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",I,(0,o.toDisplayString)(e.__("Date")),1),(0,o.createElementVNode)("td",z,(0,o.toDisplayString)(K.requestFor(J.form.start,J.form.end)),1)]),(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",A,(0,o.toDisplayString)(e.__("Total Days")),1),(0,o.createElementVNode)("td",Z,(0,o.toDisplayString)(J.form.days)+" "+(0,o.toDisplayString)(e.pluralize(J.form.days,"Day")),1)]),(0,o.createElementVNode)("tr",null,[(0,o.createElementVNode)("td",P,(0,o.toDisplayString)(e.__("Note")),1),(0,o.createElementVNode)("td",O,(0,o.toDisplayString)(J.form.note),1)])])])]),(0,o.createElementVNode)("div",$,[(0,o.createElementVNode)("button",{type:"button",class:"btn btn-secondary",onClick:t[1]||(t[1]=function(e){return J.showModal=!1})},(0,o.toDisplayString)(e.__("Close")),1)])])),[[oe,function(){return J.showModal=!1}]])])])])]})),_:1})])):(0,o.createCommentVNode)("",!0)],64)}]])},9418:(e,t,l)=>{l.d(t,{Z:()=>i});var o=l(821),n={class:"pagination justify-content-center"},a=["innerHTML"];const r={props:{links:{type:Array,required:!0}}};const i=(0,l(3744).Z)(r,[["render",function(e,t,l,r,i,c){var s=(0,o.resolveComponent)("Link");return(0,o.openBlock)(),(0,o.createElementBlock)("nav",null,[(0,o.createElementVNode)("ul",n,[((0,o.openBlock)(!0),(0,o.createElementBlock)(o.Fragment,null,(0,o.renderList)(l.links,(function(e,t){return(0,o.openBlock)(),(0,o.createElementBlock)(o.Fragment,null,[e.url?((0,o.openBlock)(),(0,o.createElementBlock)("li",{class:(0,o.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,o.createVNode)(s,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,o.openBlock)(),(0,o.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,o.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,a)]))],64)})),256))])])}]])}}]);