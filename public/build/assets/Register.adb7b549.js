import{u as p,o as c,c as f,w as m,a as s,b as a,H as _,d as l,L as w,n as V,e as b,f as d}from"./app.3660e48d.js";import{_ as v,a as g}from"./Guest.36a35ac0.js";import{_ as y,a as r,b as i}from"./ValidationErrors.47403105.js";import"./ApplicationLogo.a0f2bef1.js";import"./_plugin-vue_export-helper.cdc0426e.js";const x=["onSubmit"],k={class:"mt-4"},h={class:"mt-4"},$={class:"mt-4"},q={class:"flex items-center justify-end mt-4"},N=d(" Already registered? "),U=d(" Register "),P={__name:"Register",setup(B){const e=p({name:"",email:"",password:"",password_confirmation:"",terms:!1}),n=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(u,o)=>(c(),f(v,null,{default:m(()=>[s(a(_),{title:"Register"}),s(y,{class:"mb-4"}),l("form",{onSubmit:b(n,["prevent"])},[l("div",null,[s(r,{for:"name",value:"Name"}),s(i,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:a(e).name,"onUpdate:modelValue":o[0]||(o[0]=t=>a(e).name=t),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"])]),l("div",k,[s(r,{for:"email",value:"Email"}),s(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:a(e).email,"onUpdate:modelValue":o[1]||(o[1]=t=>a(e).email=t),required:"",autocomplete:"username"},null,8,["modelValue"])]),l("div",h,[s(r,{for:"password",value:"Password"}),s(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:a(e).password,"onUpdate:modelValue":o[2]||(o[2]=t=>a(e).password=t),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),l("div",$,[s(r,{for:"password_confirmation",value:"Confirm Password"}),s(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:a(e).password_confirmation,"onUpdate:modelValue":o[3]||(o[3]=t=>a(e).password_confirmation=t),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),l("div",q,[s(a(w),{href:u.route("login"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:m(()=>[N]),_:1},8,["href"]),s(g,{class:V(["ml-4",{"opacity-25":a(e).processing}]),disabled:a(e).processing},{default:m(()=>[U]),_:1},8,["class","disabled"])])],40,x)]),_:1}))}};export{P as default};
