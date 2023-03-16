import{_ as h}from"./_plugin-vue_export-helper.cdc0426e.js";import{o as a,g as o,d as s,t as l,n as d,F as n,l as p}from"./app.a47647b1.js";const m={props:["shapes","modelValue"],emits:["update:modelValue"],data(){return{selectedShape:null}},methods:{shapeImage(e){return"/images/shapes/"+e},selectShape(e){if(this.selectedShape===e){this.selectedShape=null,this.$emit("shapeSelected",null),this.$emit("update:modelValue",null);return}this.selectedShape=e,this.$emit("shapeSelected",e),this.$emit("update:modelValue",e)}}},u={class:"text-cleomagenta"},_={class:"py-10"},g=["onClick"],x={href:"#"},f={class:"relative flex items-end overflow-hidden rounded-xl"},S=["src"],v={class:"mt-1 p-2"},$={class:"text-slate-700 text-lg"},b={class:"mt-1 text-md text-slate-400"};function k(e,w,i,C,c,r){return a(),o("div",null,[s("p",u,l(e.$page.props.errors.shapeChoice),1),s("section",_,[s("div",{class:d(["mx-auto grid max-w-6xl grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4",e.$page.props.errors.shapeChoice?"border-red-200 border-4 rounded-md":""])},[(a(!0),o(n,null,p(i.shapes,t=>(a(),o("article",{onClick:V=>r.selectShape(t.id),key:t.id,class:d([{"border-4 border-black":c.selectedShape===t.id},"rounded-xl bg-white p-3 shadow-lg hover:shadow-xl"])},[s("a",x,[s("div",f,[s("img",{src:r.shapeImage(t.image),alt:"Hotel Photo"},null,8,S)]),s("div",v,[s("h2",$,l(t.name),1),s("p",b,l(t.description),1)])])],10,g))),128))],2)])])}const F=h(m,[["render",k]]);export{F as default};