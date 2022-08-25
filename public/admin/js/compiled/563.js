"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[563],{563:(e,t,n)=>{n.r(t),n.d(t,{default:()=>R});var l=n(821),a={class:"row justify-content-center pt-4"},o={class:"col-12"},r={class:"card"},c={class:"card-header"},s={class:"d-flex justify-content-between"},i={class:"card-title"},d=(0,l.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),m={class:"card"},u={class:"row justify-content-center"},p={class:"col-lg-3"},y={class:"form-group"},k={for:"",class:"mr-sm-2"},E={value:"",class:"d-none"},g=["value"],N={class:"col-lg-3"},V={class:"form-group"},f=["disabled"],v={key:1},_=(0,l.createElementVNode)("i",{class:"fa-solid fa-check mr-1"},null,-1),h={class:"card-body"},B=(0,l.createElementVNode)("hr",null,null,-1),b={style:{width:"100%"},class:"table table-bordered"},D={class:"h5"},L={width:"20%",rowspan:"2"},S={colspan:"2"},w={class:"h5"},C={key:0},F=["src"],T=["innerHTML"];const x={props:{leave_types:Array,team_employees:Array,companies:Array,filter_company:Number},data:function(){return{company:this.filter_company||"",buttonLoading:!1}},methods:{usedLeaveDays:function(e){for(var t=0,n=0;n<e.length;n++)t+=e[n].used_days;return t},totalLeaveDays:function(e){for(var t=0,n=0;n<e.length;n++)t+=e[n].total_days;return t},getReport:function(){var e=this;this.buttonLoading=!0,this.$inertia.get(route("reports.team.leave.balance"),{company:this.company},{onSuccess:function(){e.buttonLoading=!1}})}},computed:{buttonDisabled:function(){return""==this.company}},mounted:function(){this.checkPagePermission("admin")}};const R=(0,n(3744).Z)(x,[["render",function(e,t,n,x,R,j){var A=(0,l.resolveComponent)("Head"),H=(0,l.resolveComponent)("Link"),M=(0,l.resolveComponent)("Loading");return(0,l.openBlock)(),(0,l.createElementBlock)(l.Fragment,null,[(0,l.createVNode)(A,{title:e.__("Employee Leave Balance")},null,8,["title"]),(0,l.createElementVNode)("div",a,[(0,l.createElementVNode)("div",o,[(0,l.createElementVNode)("div",r,[(0,l.createElementVNode)("div",c,[(0,l.createElementVNode)("div",s,[(0,l.createElementVNode)("h3",i,(0,l.toDisplayString)(e.__("Team Leave Balance")),1),(0,l.createVNode)(H,{href:e.route("company.reports.index"),class:"btn btn-primary"},{default:(0,l.withCtx)((function(){return[d,(0,l.createTextVNode)(" "+(0,l.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])])]),(0,l.createElementVNode)("div",m,[(0,l.createElementVNode)("div",u,[(0,l.createElementVNode)("div",p,[(0,l.createElementVNode)("div",y,[(0,l.createElementVNode)("label",k,(0,l.toDisplayString)(e.__("Company")),1),(0,l.withDirectives)((0,l.createElementVNode)("select",{class:"custom-select mr-sm-2","onUpdate:modelValue":t[0]||(t[0]=function(e){return R.company=e})},[(0,l.createElementVNode)("option",E,(0,l.toDisplayString)(e.__("Select Company")),1),((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(n.companies,(function(e){return(0,l.openBlock)(),(0,l.createElementBlock)("option",{key:e.id,value:e.id},(0,l.toDisplayString)(e.user.name),9,g)})),128))],512),[[l.vModelSelect,R.company]])])]),(0,l.createElementVNode)("div",N,[(0,l.createElementVNode)("div",V,[(0,l.createElementVNode)("button",{disabled:j.buttonDisabled,onClick:t[1]||(t[1]=function(){return j.getReport&&j.getReport.apply(j,arguments)}),type:"button",class:"btn btn-primary",style:{"margin-top":"30px"}},[R.buttonLoading?((0,l.openBlock)(),(0,l.createBlock)(M,{key:0})):((0,l.openBlock)(),(0,l.createElementBlock)("span",v,[_,(0,l.createTextVNode)(" "+(0,l.toDisplayString)(e.__("Get Report")),1)]))],8,f)])])])]),n.leave_types.length&&n.team_employees?((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,{key:0},(0,l.renderList)(n.team_employees,(function(t,a){return(0,l.openBlock)(),(0,l.createElementBlock)("div",{class:"card",key:a},[(0,l.createElementVNode)("div",h,[(0,l.createElementVNode)("h5",null,(0,l.toDisplayString)(t[0].team.name),1),B,(0,l.createElementVNode)("table",b,[(0,l.createElementVNode)("tr",D,[(0,l.createElementVNode)("th",L,(0,l.toDisplayString)(e.__("Employee")),1),((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(n.leave_types,(function(e){return(0,l.openBlock)(),(0,l.createElementBlock)("th",{colspan:"2",key:e.id},(0,l.toDisplayString)(e.name),1)})),128)),(0,l.createElementVNode)("th",S,(0,l.toDisplayString)(e.__("Total Leave")),1)]),(0,l.createElementVNode)("tr",w,[((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(n.leave_types.length,(function(t){return(0,l.openBlock)(),(0,l.createElementBlock)(l.Fragment,{key:t},[(0,l.createElementVNode)("th",null,(0,l.toDisplayString)(e.__("Used")),1),(0,l.createElementVNode)("th",null,(0,l.toDisplayString)(e.__("Total")),1)],64)})),128)),(0,l.createElementVNode)("th",null,(0,l.toDisplayString)(e.__("Used")),1),(0,l.createElementVNode)("th",null,(0,l.toDisplayString)(e.__("Total")),1)]),((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(t,(function(t){return(0,l.openBlock)(),(0,l.createElementBlock)("tr",{key:t.id},[t.user?((0,l.openBlock)(),(0,l.createElementBlock)("td",C,[(0,l.createVNode)(H,{href:e.route("employees.show",t.user.id)},{default:(0,l.withCtx)((function(){return[(0,l.createElementVNode)("img",{src:t.user.avatar,alt:"img",class:"img-circle img-size-32 mr-1"},null,8,F),(0,l.createElementVNode)("span",{innerHTML:t.user.name},null,8,T)]})),_:2},1032,["href"])])):(0,l.createCommentVNode)("",!0),t.leave_balances?((0,l.openBlock)(),(0,l.createElementBlock)(l.Fragment,{key:1},[((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(t.leave_balances,(function(e){return(0,l.openBlock)(),(0,l.createElementBlock)(l.Fragment,{key:e.id},[(0,l.createElementVNode)("td",null,(0,l.toDisplayString)(e.used_days),1),(0,l.createElementVNode)("td",null,(0,l.toDisplayString)(e.total_days),1)],64)})),128)),(0,l.createElementVNode)("td",null,(0,l.toDisplayString)(j.usedLeaveDays(t.leave_balances)),1),(0,l.createElementVNode)("td",null,(0,l.toDisplayString)(j.totalLeaveDays(t.leave_balances)),1)],64)):(0,l.createCommentVNode)("",!0)])})),128))])])])})),128)):(0,l.createCommentVNode)("",!0)])])],64)}]])}}]);