import h from"./Home.627424e9.js";import{f as g}from"./frontScroll.f5d15c0a.js";import{o as n,g as l,d as e,e as f,m as r,q as a,a3 as d,n as m}from"./app.a47647b1.js";import{_ as p}from"./_plugin-vue_export-helper.cdc0426e.js";const _={methods:{invalid:function(i){let o=[];for(const u in i)o.push(u);return o}}},b={mixins:[g,_],layout:h,props:{user:Object},data(){return{form:{name:null,email:null,message:null},sending:!1,sent:!1,validation:[]}},mounted(){this.frontScroll(this.$refs.top)},methods:{submit(){this.sending=!0,axios.post("/api/send-email",this.form).then(({data:i})=>{this.sending=!1,this.sent=!0,this.form.name=null,this.form.email=null,this.form.message=null}).catch(i=>{this.validation=this.invalid(i.response.data.errors),this.sending=!1,this.sent=!1})}}},x={ref:"top"},y={class:"w-full bg-turquoise flex flex-col justify-center items-center"},v={class:"py-8 mt-4"},w=e("h1",{class:"sm:text-4xl text-mobile-display text-xl"},"Get in touch",-1),k={class:"my-4"},q=["href"],V={class:"w-5/6 md:w-3/4 lg:w-1/2 rounded-md bg-white p-8 mb-16"},B={class:"block mb-6"},C=e("span",{class:"text-gray-700"},"Your name",-1),j={key:0,class:"ml-3 text-xs text-red-400"},N={class:"block mb-6"},P=e("span",{class:"text-gray-700"},"Email address",-1),S={key:0,class:"ml-3 text-xs text-red-400"},T={class:"block mb-6"},U=e("span",{class:"text-gray-700"},"Message",-1),E={key:0,class:"ml-3 text-xs text-red-400"},M={key:0,class:"mb-6"},Y={key:1},z=e("p",null," Your message was sent! ",-1),A=[z];function D(i,o,u,F,s,c){return n(),l("div",x,[e("div",y,[e("div",v,[w,e("p",k,[f("If "),e("a",{href:i.route("home")},"our FAQ",8,q),f(" can't help you, get in touch with any questions. ")])]),e("div",V,[e("div",null,[e("label",B,[C,s.validation.includes("name")?(n(),l("span",j," Please fill out your name ")):r("",!0),a(e("input",{type:"text","onUpdate:modelValue":o[0]||(o[0]=t=>s.form.name=t),class:m([s.validation.includes("name")?"border-red-200 border-4":"border-gray-300","flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"]),placeholder:"Joe Bloggs"},null,2),[[d,s.form.name]])]),e("label",N,[P,s.validation.includes("email")?(n(),l("span",S," Please give a valid email address. ")):r("",!0),a(e("input",{"onUpdate:modelValue":o[1]||(o[1]=t=>s.form.email=t),type:"email",class:m([s.validation.includes("email")?"border-red-200 border-4":"border-gray-300","flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"]),placeholder:"joe.bloggs@example.com",required:""},null,2),[[d,s.form.email]])]),e("label",T,[U,s.validation.includes("message")?(n(),l("span",E," Please write a query or message ")):r("",!0),a(e("textarea",{"onUpdate:modelValue":o[2]||(o[2]=t=>s.form.message=t),class:m([s.validation.includes("name")?"border-red-200 border-4":"border-gray-300","flex w-full mt-1 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"]),rows:"3",placeholder:"Type your question here"},null,2),[[d,s.form.message]])]),s.sent?r("",!0):(n(),l("div",M,[e("button",{onClick:o[3]||(o[3]=(...t)=>c.submit&&c.submit(...t)),class:"h-10 px-5 text-indigo-100 bg-indigo-700 rounded-lg transition-colors duration-150 focus:shadow-outline hover:bg-indigo-800"}," Submit ")])),s.sent?(n(),l("div",Y,A)):r("",!0)])])])],512)}const O=p(b,[["render",D]]);export{O as default};
