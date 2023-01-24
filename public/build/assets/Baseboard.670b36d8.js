import{_ as c}from"./Authenticated.77fc3ee7.js";import{o as t,g as s,a,b as p,w as n,F as l,H as u,d as e,m as r,l as h,c as _}from"./app.aa8a3a5d.js";import m from"./UserProjects.14e7081a.js";import"./ApplicationLogo.aecb3056.js";import"./_plugin-vue_export-helper.cdc0426e.js";const g=e("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Baseboard ",-1),f={key:0,class:"bg-yellow-200"},b={class:"mx-auto max-w-7xl py-12 px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8"},x=e("h2",{class:"text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"},[e("span",{class:"block"},"Ready to dive in?"),e("span",{class:"block text-cleomagenta"},"Authorise the app with Google Drive")],-1),y={class:"mt-8 flex lg:mt-0 lg:flex-shrink-0"},v={class:"inline-flex rounded-md shadow"},k=["href"],w={class:"p-6"},j=e("h2",{class:"text-3xl"},"Creation Wizard",-1),B=e("div",{class:"w-full border border-cleomagenta my-3"},null,-1),$=e("div",null,[e("p",null,"Here you can create new projects using Cloudwriter's AI-driven creation wizard. You can define every aspect of your story, from initial concept and scaffold the plot from beginning to end. Or you can just begin a blank slate - it's up to you. ")],-1),A={class:"mt-8 flex lg:mt-0 lg:flex-shrink-0"},C={class:"inline-flex rounded-md shadow"},H=["href"],N=e("div",{class:"p-6"},[e("h2",{class:"text-3xl"},"My Projects"),e("div",{class:"w-full border border-cleomagenta my-2"})],-1),V={key:1},z={key:2},F=e("p",null,"You haven't begun a project yet.",-1),G=[F],L={__name:"Baseboard",props:{projects:Object},setup(i){return(o,O)=>(t(),s(l,null,[a(p(u),{title:"Baseboard"}),a(c,null,{header:n(()=>[g]),default:n(()=>[o.$page.props.auth.user.drive_token?r("",!0):(t(),s("div",f,[e("div",b,[x,e("div",y,[e("div",v,[o.$page.props.auth.user.drive_token?r("",!0):(t(),s("a",{key:0,href:o.route("baseboard.admin.generate-auth"),class:"inline-flex items-center justify-center rounded-md border border-transparent bg-cleomagenta px-5 py-3 text-base font-medium text-white hover:bg-red-700"}," Authorise App ",8,k))])])])])),e("div",w,[j,B,$,e("div",A,[e("div",C,[o.$page.props.auth.user.drive_token?(t(),s("a",{key:0,href:o.route("project.create"),class:"inline-flex items-center justify-center rounded-md border border-transparent bg-cleomagenta px-5 py-3 text-base font-medium text-white hover:bg-red-700"}," Get started ",8,H)):r("",!0)])])]),N,o.$page.props.auth.user.drive_token?(t(),s("div",V,[(t(!0),s(l,null,h(i.projects.data,d=>(t(),_(m,{project:d,class:"px-6 py-3"},null,8,["project"]))),256))])):(t(),s("div",z,G))]),_:1})],64))}};export{L as default};
