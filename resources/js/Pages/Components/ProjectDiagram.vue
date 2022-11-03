<template>
<div id="canvas" class="jtk-demo-canvas canvas-wide flowchart-demo jtk-surface jtk-surface-nopan relative">
        <div class="p-10 flex flex-row flex-wrap w-full my-7 justify-around">
            <div v-for="(item, index) in project"
                 class="window jtk-node w-auto h-20 flex border-2 border-turquoise rounded justify-center items-center
                  text-center cursor-pointer bg-white text-black font-display p-4 m-6"
                 :id="'flowchartWindow' + index"
                 @click="openFolder"
                 ref="item">
                {{ item.title }}
            </div>
        </div>
</div>
</template>

<script>
import { jsPlumb as JSPlumb } from 'jsplumb'
export default {
    props: {
        'project': {
            required: true
        }
    },
    name: 'JsPlumb',
    data () {
        return {
            rowCount: 0, // used to determine indents
            itemCount: 0
        }
    },
    mounted () {
        this.mountPlumb()
    },
    methods: {
        openFolder() {
            alert('hola')
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
                            events:{
                                click:function() { alert("you clicked on the arrow overlay")}
                            }
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

                    // listen for clicks on connections, and offer to delete connections on click.
                    instance.bind("click", function (conn, originalEvent) {
                        // if (confirm("Delete connection from " + conn.sourceId + " to " + conn.targetId + "?"))
                        //   instance.detach(conn);
                        alert('hahaha')
                        conn.toggleType("basic");
                    });

                    instance.bind("connectionDrag", function (connection) {
                        console.log("connection " + connection.id + " is being dragged. suspendedElement is ", connection.suspendedElement, " of type ", connection.suspendedElementType);
                    });

                    instance.bind("connectionDragStop", function (connection) {
                        console.log("connection " + connection.id + " was dragged");
                    });

                    instance.bind("connectionMoved", function (params) {
                        console.log("connection " + params.connection.id + " was moved");
                    });
                });

                JSPlumb.fire("jsPlumbDemoLoaded", instance);
            })
        },
    }
}
</script>
