<template>
<div id="canvas" class="jtk-demo-canvas canvas-wide flowchart-demo jtk-surface jtk-surface-nopan relative" v-if="!loading">
        <div class="p-10 flex flex-row flex-wrap w-full my-7 justify-around">
            <div v-for="(item, index) in project"
                 class="window jtk-node w-auto h-20 flex border-2 border-turquoise rounded justify-center items-center
                  text-center cursor-pointer bg-white text-black font-display p-4 m-6"
                 :id="'flowchartWindow' + index"
                 @click="fireModal(index)"
                 ref="item">
                {{ item.title }}
            </div>
        </div>
</div>
    <div>
        <vue-final-modal v-model="showModal" classes="modal-container" content-class="modal-content">
            <div class="modal__close" @click="showModal = false">
                x
            </div>
            <span class="modal__title">Hello, vue-final-modal</span>
            <div class="modal__content flex flex-row flex-wrap">
                <div v-if="loadedDocuments"
                     v-for="(doc, index) in loadedDocuments"
                     @click="openFile(doc.id)"
                     class="cursor-pointer border-black border-2 rounded-md flex w-1/3 m-4 p-4"
                >
                    {{ doc.title }}
                </div>
            </div>
            <div @click=createFile(loadedFolderId) class="w-1/4 flex justify-center text-center rounded-md font-bold bg-green-500 text-white border-4
             border-black hover:border-gray-300 cursor-pointer">
                Add new +
            </div>
        </vue-final-modal>
<!--        <div @click="showModal = true">Open modal</div>-->
    </div>
</template>

<script>
import { jsPlumb as JSPlumb } from 'jsplumb'
import { $vfm, VueFinalModal, ModalsContainer } from 'vue-final-modal'
import {Inertia} from "@inertiajs/inertia";

export default {
    components: {
        VueFinalModal,
        ModalsContainer
    },
    props: {
        'project': {
            required: true
        }
    },
    name: 'JsPlumb',
    data () {
        return {
            rowCount: 0, // used to determine indents
            itemCount: 0,
            openedFolders: [],
            loading: false,
            showModal: false,
            loadedDocuments: [],
            loadedFolderId: null,
            newTitle: null,
        }
    },
    mounted () {
        this.mountPlumb()
    },
    methods: {
        createFile(folder_id) {
            Inertia.post('/project/file/create', {folder_id: folder_id, title: 'test-title' })
        },
        openFile(id) {
            Inertia.get('/project/file/' + id + '/show')
        },
        createFolder(folder_id) {
            Inertia.post('/project/folder/create', {folder_id: folder_id, folder_name: this.new_folder})
        },
        fireModal(value) {
            this.loadedDocuments = this.project[value]['content']
            this.loadedFolderId = this.project[value]['id']
            this.showModal = true
        },
        folderOpened(value) {
            return this.openedFolders.includes(value)
        },
        toggleFolder(value) {
            if (this.openedFolders.includes(value)) {
                let index = this.openedFolders.indexOf(value)
                if (index > -1) {
                    this.openedFolders.splice(index, 1)
                }
            } else {
                this.openedFolders.push(value)
            }
        },
        mountPlumb() {
            var that = this
            JSPlumb.ready(function() {
                let instance = window.jsp = JSPlumb.getInstance({
                    // the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
                    // case it returns the 'labelText' member that we set on each connection in the 'init' method below.
                    ConnectionOverlays: [
                        [ "Diamond", {
                            location: 0.5,
                            visible:true,
                            width:20,
                            length:20,
                            id:"DIAMOND",
                            // events:{
                            //     click:function() { alert("you clicked on the arrow overlay")}
                            // }
                        } ],
                    ],
                    Container: "canvas"
                });
                let basicType = {
                    connector: "Flowchart",
                    overlays: [
                        "Diamond"
                    ]
                };
                instance.registerConnectionType("basic", basicType);
                let init = function (connection) {
                    connection.getOverlay("label").setLabel(connection.sourceId.substring(15) + "-" + connection.targetId.substring(15));
                };
                // suspend drawing and initialise.
                instance.batch(function () {
                    // listen for new connections; initialise them the same way we initialise the connections at startup.
                    instance.bind("connection", function (connInfo, originalEvent) {
                        init(connInfo.connection);
                    });

                    // Connect up divs
                    that.$refs.item.forEach(function (item, index) {
                        if (that.$refs.item[index+1]) {
                            instance.connect({
                                source:that.$refs.item[index],
                                target:that.$refs.item[index+1],
                                anchors: ['Right', 'Left'],
                                connector: "Flowchart",
                                deleteEndpointsOnDetach: false,
                                detachable: false,
                                endpoint: "Rectangle",
                                endpointStyle: { fill: "rgb(219,65,99)", width: 5},
                                paintStyle: { strokeWidth: 3, stroke: "rgb(219,65,99)"}, // connector styles
                            })
                        }
                    })

                    // listen for clicks on connections
                    instance.bind("click", function (conn, originalEvent) {
                        alert('hahaha')
                        // conn.toggleType("basic");
                    });
                });

                JSPlumb.fire("jsPlumbDemoLoaded", instance);
            })
        },
    },
    computed: {

    }
}
</script>

<style scoped>
::v-deep .modal-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
::v-deep .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    margin: 0 1rem;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    background: #fff;
}
.modal__title {
    margin: 0 2rem 0 0;
    font-size: 1.5rem;
    font-weight: 700;
}
.modal__close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
}
</style>

<style scoped>
.dark-mode div::v-deep .modal-content {
    border-color: #2d3748;
    background-color: #1a202c;
}
</style>
