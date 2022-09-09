"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[2448],{2448:(e,t,l)=>{l.r(t),l.d(t,{default:()=>V});var n=l(821),a={class:"row justify-content-center pt-4"},r={class:"col-12"},o={class:"card"},c={class:"card-header"},s={class:"d-flex justify-content-between"},d={class:"card-title"},i=(0,n.createElementVNode)("i",{class:"fa-solid fa-arrow-left"},null,-1),m={class:"card"},u={style:{width:"100%"},class:"table table-bordered"},p={class:"h5"},y={width:"20%",rowspan:"2"},E={colspan:"2"},k={class:"h5"},_={key:0},g=["src"],h=["innerHTML"];const N={props:{leave_types:Array,employees:Array},data:function(){return{}},methods:{usedLeaveDays:function(e){for(var t=0,l=0;l<e.length;l++)t+=e[l].used_days;return t},totalLeaveDays:function(e){for(var t=0,l=0;l<e.length;l++)t+=e[l].total_days;return t}},mounted:function(){this.checkPagePermission("company")}};const V=(0,l(3744).Z)(N,[["render",function(e,t,l,N,V,f){var v=(0,n.resolveComponent)("Head"),B=(0,n.resolveComponent)("Link");return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,null,[(0,n.createVNode)(v,{title:e.__("Employee Leave Balance")},null,8,["title"]),(0,n.createElementVNode)("div",a,[(0,n.createElementVNode)("div",r,[(0,n.createElementVNode)("div",o,[(0,n.createElementVNode)("div",c,[(0,n.createElementVNode)("div",s,[(0,n.createElementVNode)("h3",d,(0,n.toDisplayString)(e.__("Employee Leave Balance")),1),(0,n.createVNode)(B,{href:e.route("company.reports.index"),class:"btn btn-primary"},{default:(0,n.withCtx)((function(){return[i,(0,n.createTextVNode)(" "+(0,n.toDisplayString)(e.__("Back")),1)]})),_:1},8,["href"])])])]),(0,n.createElementVNode)("div",m,[(0,n.createElementVNode)("table",u,[(0,n.createElementVNode)("tr",p,[(0,n.createElementVNode)("th",y,(0,n.toDisplayString)(e.__("Employee")),1),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(l.leave_types,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)("th",{colspan:"2",key:e.id},(0,n.toDisplayString)(e.name),1)})),128)),(0,n.createElementVNode)("th",E,(0,n.toDisplayString)(e.__("Total Leave")),1)]),(0,n.createElementVNode)("tr",k,[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(l.leave_types.length,(function(t){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:t},[(0,n.createElementVNode)("th",null,(0,n.toDisplayString)(e.__("Used")),1),(0,n.createElementVNode)("th",null,(0,n.toDisplayString)(e.__("Total")),1)],64)})),128)),(0,n.createElementVNode)("th",null,(0,n.toDisplayString)(e.__("Used")),1),(0,n.createElementVNode)("th",null,(0,n.toDisplayString)(e.__("Total")),1)]),((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(l.employees,(function(t){return(0,n.openBlock)(),(0,n.createElementBlock)("tr",{key:t.id},[t.user?((0,n.openBlock)(),(0,n.createElementBlock)("td",_,[(0,n.createVNode)(B,{href:e.route("company.employees.show",t.user_id)},{default:(0,n.withCtx)((function(){return[(0,n.createElementVNode)("img",{src:t.user.avatar,alt:"img",class:"img-circle img-size-32 mr-1"},null,8,g),(0,n.createElementVNode)("span",{innerHTML:t.user.name},null,8,h)]})),_:2},1032,["href"])])):(0,n.createCommentVNode)("",!0),t.leave_balances?((0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:1},[((0,n.openBlock)(!0),(0,n.createElementBlock)(n.Fragment,null,(0,n.renderList)(t.leave_balances,(function(e){return(0,n.openBlock)(),(0,n.createElementBlock)(n.Fragment,{key:e.id},[(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.used_days),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(e.total_days),1)],64)})),128)),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(f.usedLeaveDays(t.leave_balances)),1),(0,n.createElementVNode)("td",null,(0,n.toDisplayString)(f.totalLeaveDays(t.leave_balances)),1)],64)):(0,n.createCommentVNode)("",!0)])})),128))])])])])],64)}]])}}]);