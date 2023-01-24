import{L as y,G as a,Y as u,o as s,g as n,d as o,t as h,c as _,w as p,m as i,n as C,q as w,$ as m,a as g,F as v,l as j,e as x}from"./app.aa8a3a5d.js";import{_ as k}from"./_plugin-vue_export-helper.cdc0426e.js";const q={components:{Link:y},props:{id:{required:!1},type:{required:!1},folder:{required:!0},title:{required:!1},depth:{required:!1}},name:"project-tree",data(){return{showChildren:!1,new_title:null,new_folder:null}},methods:{toggleChildrenOrOpen(t,r){t!=="doc"?this.showChildren=!this.showChildren:a.Inertia.get("/project/file/"+r+"/show")},toggleContent(){this.showContent=!this.showContent},createFile(t){a.Inertia.post("/project/file/create",{folder_id:t,title:this.new_title})},createFolder(t){a.Inertia.post("/project/folder/create",{folder_id:t,folder_name:this.new_folder})}}},V={class:"flex flex-row"},F={class:"p-4 mx-1"},L={key:0,class:"flex-row flex justify-center self-center text-center"},B=o("div",{class:"bg-black p-1 w-16"},null,-1),N=o("div",{class:"h-0 w-0 border-y-8 border-y-transparent border-l-[14px] border-l-blue-600"},null,-1),O=[B,N],I={class:"flex flex-row flex-wrap"},T={key:0,class:"p-4 rounded-sm border-turquoise flex flex-row border-b w-full"};function D(t,r,e,U,d,c){const f=u("Link"),b=u("project-tree",!0);return s(),n("div",V,[o("div",{class:C(e.type==="doc"?"p-1 border-cleomagenta border-2":"w-full border-green-300 border-4")},[o("div",{onClick:r[0]||(r[0]=l=>c.toggleChildrenOrOpen(e.type,e.id)),class:"cursor-pointer flex flex-row"},[o("div",F,h(e.title?e.title:t.name)+" - "+h(e.type),1)]),e.type!=="project"?(s(),_(f,{key:0,class:"text-xl flex cursor-pointer bg-red-500",href:e.type==="doc"?t.route("project.file.delete",{file_id:e.id}):t.route("project.folder.delete",{folder_id:e.id}),method:"delete","preserve-scroll":"","preserve-state":"",as:"button"},{default:p(()=>[x(" X ")]),_:1},8,["href"])):i("",!0)],2),e.type!=="project"?(s(),n("div",L,O)):i("",!0),o("div",I,[e.type==="folder"&&d.showChildren||e.type==="project"&&d.showChildren?(s(),n("div",T,[w(o("input",{"onUpdate:modelValue":r[1]||(r[1]=l=>d.new_title=l),class:"bg-blue-400",placeholder:"Create new file inside this folder:"},null,512),[[m,d.new_title]]),o("div",{onClick:r[2]||(r[2]=l=>c.createFile(e.id)),class:"p-2 bg-red-600 text-xl cursor-pointer"},"+"),w(o("input",{"onUpdate:modelValue":r[3]||(r[3]=l=>d.new_folder=l),class:"bg-yellow-500 ml-1",placeholder:"Create new folder inside this folder:"},null,512),[[m,d.new_folder]]),g(f,{method:"post",as:"button",href:t.route("project.folder.create",{parent_folder_id:e.id,title:this.new_folder}),class:"p-2 bg-turquoise text-xl cursor-pointer"},{default:p(()=>[x(" + ")]),_:1},8,["href"])])):i("",!0),d.showChildren?(s(!0),n(v,{key:1},j(e.folder,l=>(s(),_(b,{folder:l.content,title:l.title,id:l.id,type:l.internal_type,depth:e.depth+1},null,8,["folder","title","id","type","depth"]))),256)):i("",!0)])])}const G=k(q,[["render",D]]);export{G as default};