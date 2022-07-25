(self.webpackChunk=self.webpackChunk||[]).push([[6378],{7484:function(e){e.exports=function(){"use strict";var e=1e3,t=6e4,n=36e5,r="millisecond",o="second",a="minute",i="hour",s="day",l="week",c="month",d="quarter",u="year",m="date",h="Invalid Date",f=/^(\d{4})[-/]?(\d{1,2})?[-/]?(\d{0,2})[Tt\s]*(\d{1,2})?:?(\d{1,2})?:?(\d{1,2})?[.:]?(\d+)?$/,y=/\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g,p={name:"en",weekdays:"Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),months:"January_February_March_April_May_June_July_August_September_October_November_December".split("_")},v=function(e,t,n){var r=String(e);return!r||r.length>=t?e:""+Array(t+1-r.length).join(n)+e},$={s:v,z:function(e){var t=-e.utcOffset(),n=Math.abs(t),r=Math.floor(n/60),o=n%60;return(t<=0?"+":"-")+v(r,2,"0")+":"+v(o,2,"0")},m:function e(t,n){if(t.date()<n.date())return-e(n,t);var r=12*(n.year()-t.year())+(n.month()-t.month()),o=t.clone().add(r,c),a=n-o<0,i=t.clone().add(r+(a?-1:1),c);return+(-(r+(n-o)/(a?o-i:i-o))||0)},a:function(e){return e<0?Math.ceil(e)||0:Math.floor(e)},p:function(e){return{M:c,y:u,w:l,d:s,D:m,h:i,m:a,s:o,ms:r,Q:d}[e]||String(e||"").toLowerCase().replace(/s$/,"")},u:function(e){return void 0===e}},E="en",N={};N[E]=p;var V=function(e){return e instanceof w},g=function e(t,n,r){var o;if(!t)return E;if("string"==typeof t){var a=t.toLowerCase();N[a]&&(o=a),n&&(N[a]=n,o=a);var i=t.split("-");if(!o&&i.length>1)return e(i[0])}else{var s=t.name;N[s]=t,o=s}return!r&&o&&(E=o),o||!r&&E},k=function(e,t){if(V(e))return e.clone();var n="object"==typeof t?t:{};return n.date=e,n.args=arguments,new w(n)},D=$;D.l=g,D.i=V,D.w=function(e,t){return k(e,{locale:t.$L,utc:t.$u,x:t.$x,$offset:t.$offset})};var w=function(){function p(e){this.$L=g(e.locale,null,!0),this.parse(e)}var v=p.prototype;return v.parse=function(e){this.$d=function(e){var t=e.date,n=e.utc;if(null===t)return new Date(NaN);if(D.u(t))return new Date;if(t instanceof Date)return new Date(t);if("string"==typeof t&&!/Z$/i.test(t)){var r=t.match(f);if(r){var o=r[2]-1||0,a=(r[7]||"0").substring(0,3);return n?new Date(Date.UTC(r[1],o,r[3]||1,r[4]||0,r[5]||0,r[6]||0,a)):new Date(r[1],o,r[3]||1,r[4]||0,r[5]||0,r[6]||0,a)}}return new Date(t)}(e),this.$x=e.x||{},this.init()},v.init=function(){var e=this.$d;this.$y=e.getFullYear(),this.$M=e.getMonth(),this.$D=e.getDate(),this.$W=e.getDay(),this.$H=e.getHours(),this.$m=e.getMinutes(),this.$s=e.getSeconds(),this.$ms=e.getMilliseconds()},v.$utils=function(){return D},v.isValid=function(){return!(this.$d.toString()===h)},v.isSame=function(e,t){var n=k(e);return this.startOf(t)<=n&&n<=this.endOf(t)},v.isAfter=function(e,t){return k(e)<this.startOf(t)},v.isBefore=function(e,t){return this.endOf(t)<k(e)},v.$g=function(e,t,n){return D.u(e)?this[t]:this.set(n,e)},v.unix=function(){return Math.floor(this.valueOf()/1e3)},v.valueOf=function(){return this.$d.getTime()},v.startOf=function(e,t){var n=this,r=!!D.u(t)||t,d=D.p(e),h=function(e,t){var o=D.w(n.$u?Date.UTC(n.$y,t,e):new Date(n.$y,t,e),n);return r?o:o.endOf(s)},f=function(e,t){return D.w(n.toDate()[e].apply(n.toDate("s"),(r?[0,0,0,0]:[23,59,59,999]).slice(t)),n)},y=this.$W,p=this.$M,v=this.$D,$="set"+(this.$u?"UTC":"");switch(d){case u:return r?h(1,0):h(31,11);case c:return r?h(1,p):h(0,p+1);case l:var E=this.$locale().weekStart||0,N=(y<E?y+7:y)-E;return h(r?v-N:v+(6-N),p);case s:case m:return f($+"Hours",0);case i:return f($+"Minutes",1);case a:return f($+"Seconds",2);case o:return f($+"Milliseconds",3);default:return this.clone()}},v.endOf=function(e){return this.startOf(e,!1)},v.$set=function(e,t){var n,l=D.p(e),d="set"+(this.$u?"UTC":""),h=(n={},n[s]=d+"Date",n[m]=d+"Date",n[c]=d+"Month",n[u]=d+"FullYear",n[i]=d+"Hours",n[a]=d+"Minutes",n[o]=d+"Seconds",n[r]=d+"Milliseconds",n)[l],f=l===s?this.$D+(t-this.$W):t;if(l===c||l===u){var y=this.clone().set(m,1);y.$d[h](f),y.init(),this.$d=y.set(m,Math.min(this.$D,y.daysInMonth())).$d}else h&&this.$d[h](f);return this.init(),this},v.set=function(e,t){return this.clone().$set(e,t)},v.get=function(e){return this[D.p(e)]()},v.add=function(r,d){var m,h=this;r=Number(r);var f=D.p(d),y=function(e){var t=k(h);return D.w(t.date(t.date()+Math.round(e*r)),h)};if(f===c)return this.set(c,this.$M+r);if(f===u)return this.set(u,this.$y+r);if(f===s)return y(1);if(f===l)return y(7);var p=(m={},m[a]=t,m[i]=n,m[o]=e,m)[f]||1,v=this.$d.getTime()+r*p;return D.w(v,this)},v.subtract=function(e,t){return this.add(-1*e,t)},v.format=function(e){var t=this,n=this.$locale();if(!this.isValid())return n.invalidDate||h;var r=e||"YYYY-MM-DDTHH:mm:ssZ",o=D.z(this),a=this.$H,i=this.$m,s=this.$M,l=n.weekdays,c=n.months,d=function(e,n,o,a){return e&&(e[n]||e(t,r))||o[n].slice(0,a)},u=function(e){return D.s(a%12||12,e,"0")},m=n.meridiem||function(e,t,n){var r=e<12?"AM":"PM";return n?r.toLowerCase():r},f={YY:String(this.$y).slice(-2),YYYY:this.$y,M:s+1,MM:D.s(s+1,2,"0"),MMM:d(n.monthsShort,s,c,3),MMMM:d(c,s),D:this.$D,DD:D.s(this.$D,2,"0"),d:String(this.$W),dd:d(n.weekdaysMin,this.$W,l,2),ddd:d(n.weekdaysShort,this.$W,l,3),dddd:l[this.$W],H:String(a),HH:D.s(a,2,"0"),h:u(1),hh:u(2),a:m(a,i,!0),A:m(a,i,!1),m:String(i),mm:D.s(i,2,"0"),s:String(this.$s),ss:D.s(this.$s,2,"0"),SSS:D.s(this.$ms,3,"0"),Z:o};return r.replace(y,(function(e,t){return t||f[e]||o.replace(":","")}))},v.utcOffset=function(){return 15*-Math.round(this.$d.getTimezoneOffset()/15)},v.diff=function(r,m,h){var f,y=D.p(m),p=k(r),v=(p.utcOffset()-this.utcOffset())*t,$=this-p,E=D.m(this,p);return E=(f={},f[u]=E/12,f[c]=E,f[d]=E/3,f[l]=($-v)/6048e5,f[s]=($-v)/864e5,f[i]=$/n,f[a]=$/t,f[o]=$/e,f)[y]||$,h?E:D.a(E)},v.daysInMonth=function(){return this.endOf(c).$D},v.$locale=function(){return N[this.$L]},v.locale=function(e,t){if(!e)return this.$L;var n=this.clone(),r=g(e,t,!0);return r&&(n.$L=r),n},v.clone=function(){return D.w(this.$d,this)},v.toDate=function(){return new Date(this.valueOf())},v.toJSON=function(){return this.isValid()?this.toISOString():null},v.toISOString=function(){return this.$d.toISOString()},v.toString=function(){return this.$d.toUTCString()},p}(),M=w.prototype;return k.prototype=M,[["$ms",r],["$s",o],["$m",a],["$H",i],["$W",s],["$M",c],["$y",u],["$D",m]].forEach((function(e){M[e[1]]=function(t){return this.$g(t,e[0],e[1])}})),k.extend=function(e,t){return e.$i||(e(t,w,k),e.$i=!0),k},k.locale=g,k.isDayjs=V,k.unix=function(e){return k(1e3*e)},k.en=N[E],k.Ls=N,k.p={},k}()},6378:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>te});var r=n(821),o={class:"row justify-content-center"},a={class:"col-md-4 mt-3"},i={class:"card bg-secondary text-white"},s={class:"card-body"},l={class:"text-center"},c={class:"col-12"},d={class:"card mt-3"},u=(0,r.createElementVNode)("div",{class:"card-header"},[(0,r.createElementVNode)("div",{class:"d-flex justify-content-between"},[(0,r.createElementVNode)("span",null,"Holiday Request List")])],-1),m={class:"card-body table-responsive p-0"},h={class:"table table-valign-middle"},f=(0,r.createElementVNode)("thead",null,[(0,r.createElementVNode)("tr",null,[(0,r.createElementVNode)("th",null,"Employee"),(0,r.createElementVNode)("th",null,"Date"),(0,r.createElementVNode)("th",null,"Action")])],-1),y={key:0},p=["src"],v={href:"#"},$={key:1},E={class:"text-danger ml-1"},N=(0,r.createTextVNode)(") "),V=["onClick"],g=["onClick"],k=["onClick"],D={key:1},w=[(0,r.createElementVNode)("td",{colspan:"5",class:"text-center"},[(0,r.createElementVNode)("h3",null,"No Data Found")],-1)],M={key:0},b={class:"modal-mask"},S={class:"modal-wrapper"},C={class:"modal-dialog",role:"document"},B={class:"modal-content"},_={class:"modal-header"},O=(0,r.createElementVNode)("h5",{class:"modal-title"}," Request Holiday Details ",-1),Y={type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},T={class:"modal-body"},H={class:"table"},x=(0,r.createElementVNode)("td",{width:"30%"},"Employee Name",-1),L={width:"70%"},q={href:"#"},I=(0,r.createElementVNode)("td",{width:"30%"},"Email",-1),j={width:"70%"},A=(0,r.createElementVNode)("td",{width:"30%"},"Holiday Title",-1),F={width:"70%"},W=(0,r.createElementVNode)("td",{width:"30%"},"Date",-1),Z={width:"70%"},R=(0,r.createElementVNode)("td",{width:"30%"},"Total Days",-1),z={width:"70%"},U=(0,r.createElementVNode)("td",{width:"50%"},"Note",-1),J={width:"50%"},P={class:"modal-footer"};var Q=n(9418),G=n(9680),K=n(7484),X=n.n(K);const ee={props:{holidays:Array,company:Object,user:Object},components:{Inertia:G.Inertia,Pagination:Q.Z},data:function(){return{showModal:!1,form:{employee_name:"",employee_email:"",title:"",start:"",end:"",days:"",note:""}}},methods:{requestFor:function(e,t){var n=X()(e).format("DD MMM, YYYY"),r=X()(t).format("DD MMM, YYYY");return"".concat(n," - ").concat(r)},showDetails:function(e){this.form.employee_name=e.employee.user.name,this.form.employee_email=e.employee.user.email,this.form.days=e.days,this.form.title=e.title,this.form.start=e.start,this.form.end=e.end,this.form.note=e.note,this.showModal=!0},acceptRequest:function(e){G.Inertia.post(route("request.holidays.accept"),{id:e})},rejectRequest:function(e){this.$swal({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((function(t){t.isConfirmed&&G.Inertia.delete(route("request.holidays.reject",e))}))}}};const te=(0,n(3744).Z)(ee,[["render",function(e,t,n,Q,G,K){var X=(0,r.resolveComponent)("Head"),ee=(0,r.resolveComponent)("EyeIcon"),te=(0,r.resolveComponent)("CheckIcon"),ne=(0,r.resolveComponent)("CrossIcon"),re=(0,r.resolveComponent)("Pagination"),oe=(0,r.resolveDirective)("tooltip"),ae=(0,r.resolveDirective)("click-outside");return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[(0,r.createVNode)(X,{title:"Company List"}),(0,r.createElementVNode)("div",o,[(0,r.createElementVNode)("div",a,[(0,r.createElementVNode)("div",i,[(0,r.createElementVNode)("div",s,[(0,r.createElementVNode)("div",l,[(0,r.createElementVNode)("h3",null,(0,r.toDisplayString)(n.user.name),1),(0,r.createElementVNode)("h5",null,"Country : "+(0,r.toDisplayString)(n.company.country.name),1)])])])]),(0,r.createElementVNode)("div",c,[(0,r.createElementVNode)("div",d,[u,(0,r.createElementVNode)("div",m,[(0,r.createElementVNode)("table",h,[f,(0,r.createElementVNode)("tbody",null,[n.holidays&&n.holidays.data.length?((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,{key:0},(0,r.renderList)(n.holidays.data,(function(e,t){return(0,r.openBlock)(),(0,r.createElementBlock)("tr",{key:t},[e.employee.user?((0,r.openBlock)(),(0,r.createElementBlock)("td",y,[(0,r.createElementVNode)("img",{src:e.employee.user.avatar,alt:"Product 1",class:"img-circle img-size-32 mr-2"},null,8,p),(0,r.createElementVNode)("a",v,(0,r.toDisplayString)(e.employee.user.name),1)])):(0,r.createCommentVNode)("",!0),e.start&&e.end?((0,r.openBlock)(),(0,r.createElementBlock)("td",$,[(0,r.createTextVNode)((0,r.toDisplayString)(K.requestFor(e.start,e.end))+" (",1),(0,r.createElementVNode)("span",E,(0,r.toDisplayString)(e.days)+" Days ",1),N])):(0,r.createCommentVNode)("",!0),(0,r.createElementVNode)("td",null,[(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createElementBlock)("button",{onClick:function(t){return K.showDetails(e)},class:"btn btn-sm pl-0"},[(0,r.createVNode)(ee)],8,V)),[[oe,"View holiday details"]]),(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createElementBlock)("button",{onClick:function(t){return K.acceptRequest(e.id)},class:"btn btn-sm pl-0"},[(0,r.createVNode)(te)],8,g)),[[oe,"Accept and add to official holiday list"]]),(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createElementBlock)("button",{onClick:function(t){return K.rejectRequest(e.id)},class:"btn btn-sm pl-0"},[(0,r.createVNode)(ne)],8,k)),[[oe,"Reject and delete from holiday request list"]])])])})),128)):((0,r.openBlock)(),(0,r.createElementBlock)("tr",D,w))])]),(0,r.createVNode)(re,{links:n.holidays.links},null,8,["links"])])])])]),G.showModal?((0,r.openBlock)(),(0,r.createElementBlock)("div",M,[(0,r.createVNode)(r.Transition,{name:"fade"},{default:(0,r.withCtx)((function(){return[(0,r.createElementVNode)("div",b,[(0,r.createElementVNode)("div",S,[(0,r.createElementVNode)("div",C,[(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createElementBlock)("div",B,[(0,r.createElementVNode)("div",_,[O,(0,r.createElementVNode)("button",Y,[(0,r.createElementVNode)("span",{"aria-hidden":"true",onClick:t[0]||(t[0]=function(e){return G.showModal=!1})},"×")])]),(0,r.createElementVNode)("div",T,[(0,r.createElementVNode)("table",H,[(0,r.createElementVNode)("tbody",null,[(0,r.createElementVNode)("tr",null,[x,(0,r.createElementVNode)("td",L,[(0,r.createElementVNode)("a",q,(0,r.toDisplayString)(G.form.employee_name),1)])]),(0,r.createElementVNode)("tr",null,[I,(0,r.createElementVNode)("td",j,(0,r.toDisplayString)(G.form.employee_email),1)]),(0,r.createElementVNode)("tr",null,[A,(0,r.createElementVNode)("td",F,(0,r.toDisplayString)(G.form.title),1)]),(0,r.createElementVNode)("tr",null,[W,(0,r.createElementVNode)("td",Z,(0,r.toDisplayString)(K.requestFor(G.form.start,G.form.end)),1)]),(0,r.createElementVNode)("tr",null,[R,(0,r.createElementVNode)("td",z,(0,r.toDisplayString)(G.form.days)+" "+(0,r.toDisplayString)(e.pluralize(G.form.days,"Day")),1)]),(0,r.createElementVNode)("tr",null,[U,(0,r.createElementVNode)("td",J,(0,r.toDisplayString)(G.form.note),1)])])])]),(0,r.createElementVNode)("div",P,[(0,r.createElementVNode)("button",{type:"button",class:"btn btn-secondary",onClick:t[1]||(t[1]=function(e){return G.showModal=!1})},"Close")])])),[[ae,function(){return G.showModal=!1}]])])])])]})),_:1})])):(0,r.createCommentVNode)("",!0)],64)}]])},9418:(e,t,n)=>{"use strict";n.d(t,{Z:()=>s});var r=n(821),o={class:"pagination justify-content-center"},a=["innerHTML"];const i={props:{links:{type:Array,required:!0}}};const s=(0,n(3744).Z)(i,[["render",function(e,t,n,i,s,l){var c=(0,r.resolveComponent)("Link");return(0,r.openBlock)(),(0,r.createElementBlock)("nav",null,[(0,r.createElementVNode)("ul",o,[((0,r.openBlock)(!0),(0,r.createElementBlock)(r.Fragment,null,(0,r.renderList)(n.links,(function(e,t){return(0,r.openBlock)(),(0,r.createElementBlock)(r.Fragment,null,[e.url?((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:(0,r.normalizeClass)(["page-item",{active:e.active}]),key:t},[(0,r.createVNode)(c,{class:"page-link d-inline",href:e.url,innerHTML:e.label},null,8,["href","innerHTML"])],2)):((0,r.openBlock)(),(0,r.createElementBlock)("li",{class:"page-item disabled",key:t,style:{"margin-top":"-7px"}},[(0,r.createElementVNode)("a",{class:"page-link",href:"#",innerHTML:e.label},null,8,a)]))],64)})),256))])])}]])}}]);