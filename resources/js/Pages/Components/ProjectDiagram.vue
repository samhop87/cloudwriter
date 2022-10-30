<template>
<div id="canvas" class="jtk-demo-canvas canvas-wide flowchart-demo jtk-surface jtk-surface-nopan relative">
        <div v-for="(row, index) in project" class="p-10 flex flex-row flew-wrap w-full" :class="determineRow(index)">
            <div v-for="(item, index) in row"
                 class="window jtk-node w-auto h-16 flex border-2 border-turquoise rounded justify-center items-center
                  text-center absolute cursor-pointer bg-white text-black font-display p-1"
                 :id="'flowchartWindow' + index"
                 @click="openFolder"
                 ref="item"
                 :class="determineIndent(index)">
                {{ "flowchartWindow" + index }}
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
        determineIndent(index) {
            let indents = ['left-1/4', 'left-1/2', 'left-3/4']
            let clone = indents[this.itemCount]
            this.itemCount++

            return clone
        },
        determineRow(index) {
            let indents = ['', 'top-1/4', 'top-1/2']
            this.rowCount++
            if (this.rowCount != 0) {
                this.itemCount = 0
            }

            return indents[index]
        },
        mountPlumb() {
            // Apparently have to do this, tiresomely
            var that = this
            JSPlumb.ready(function() {
                let instance = window.jsp = JSPlumb.getInstance({
                    // default drag options
                    DragOptions: { cursor: 'pointer', zIndex: 2000 },
                    // the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
                    // case it returns the 'labelText' member that we set on each connection in the 'init' method below.
                    ConnectionOverlays: [
                        [ "Arrow", {
                            location: 1,
                            visible:true,
                            width:11,
                            length:11,
                            id:"ARROW",
                            events:{
                                click:function() { alert("you clicked on the arrow overlay")}
                            }
                        } ],
                        [ "Label", {
                            location: 0.1,
                            id: "label",
                            cssClass: "aLabel",
                            events:{
                                tap:function() { alert("hey"); }
                            }
                        }]
                    ],
                    Container: "canvas"
                });
                let basicType = {
                    connector: "StateMachine",
                    paintStyle: { stroke: "red", strokeWidth: 4 },
                    hoverPaintStyle: { stroke: "blue" },
                    overlays: [
                        "Arrow"
                    ]
                };
                instance.registerConnectionType("basic", basicType);
                // this is the paint style for the connecting lines..
                let connectorPaintStyle = {
                        strokeWidth: 10,
                        stroke: "#61B7CF",
                        // joinstyle: "round",
                        outlineStroke: "white",
                        outlineWidth: 2
                    },
                    // .. and this is the hover style.
                    connectorHoverStyle = {
                        strokeWidth: 3,
                        stroke: "#216477",
                        outlineWidth: 5,
                        outlineStroke: "white"
                    },
                    endpointHoverStyle = {
                        fill: "#216477",
                        stroke: "#216477"
                    },
                    // the definition of source endpoints (the small blue ones)
                    sourceEndpoint = {
                        endpoint: "Dot",
                        paintStyle: {
                            stroke: "#7AB02C",
                            fill: "transparent",
                            radius: 7,
                            strokeWidth: 2
                        },
                        isSource: true,
                        connector: [ "Flowchart", { stub: [40, 60], gap: 10, cornerRadius: 5, alwaysRespectStubs: true } ],
                        connectorStyle: connectorPaintStyle,
                        hoverPaintStyle: endpointHoverStyle,
                        connectorHoverStyle: connectorHoverStyle,
                        dragOptions: {},
                        overlays: [
                            [ "Label", {
                                location: [0.5, 1.5],
                                label: "Drag",
                                cssClass: "endpointSourceLabel",
                                visible:false
                            } ]
                        ]
                    },
                    // the definition of target endpoints (will appear when the user drags a connection)
                    targetEndpoint = {
                        endpoint: "Dot",
                        paintStyle: { fill: "#7AB02C", radius: 7 },
                        hoverPaintStyle: endpointHoverStyle,
                        maxConnections: -1,
                        dropOptions: { hoverClass: "hover", activeClass: "active" },
                        isTarget: true,
                        overlays: [
                            [ "Label", { location: [0.5, -0.5], label: "Drop", cssClass: "endpointTargetLabel", visible:false } ]
                        ]
                    },
                    init = function (connection) {
                        connection.getOverlay("label").setLabel(connection.sourceId.substring(15) + "-" + connection.targetId.substring(15));
                    };

                let _addEndpoints = function (toId, sourceAnchors, targetAnchors) {
                    for (let i = 0; i < sourceAnchors.length; i++) {
                        let sourceUUID = toId + sourceAnchors[i]; // creates the uuid for each connector endpoint
                        // uses the second half of the ID as identifier for endpoints, then adds to instance
                        instance.addEndpoint("flowchart" + toId, sourceEndpoint, {
                            anchor: sourceAnchors[i], uuid: sourceUUID
                        });
                    }
                    for (let j = 0; j < targetAnchors.length; j++) {
                        let targetUUID = toId + targetAnchors[j];
                        instance.addEndpoint("flowchart" + toId, targetEndpoint, { anchor: targetAnchors[j], uuid: targetUUID });
                    }
                };

                // suspend drawing and initialise.
                instance.batch(function () {

                    // _addEndpoints("Window4", ["TopCenter", "BottomCenter"], ["LeftMiddle", "RightMiddle"]);
                    // _addEndpoints("Window2", ["LeftMiddle", "BottomCenter"], ["TopCenter", "RightMiddle"]);
                    // _addEndpoints("Window3", ["RightMiddle", "BottomCenter"], ["LeftMiddle", "TopCenter"]);
                    // _addEndpoints("Window1", ["LeftMiddle", "RightMiddle"], ["TopCenter", "BottomCenter"]);



                    let sourceAnchors = [
                        "RightMiddle", "",
                    ]

                    let targetAnchors = [
                        "LeftMiddle", "",
                    ]
                    // define where connections are made with and from our divs
                    // this is where we define how things are drawn together. should be custom right angle for new rows,
                    // and side by side for everything else.
                    that.project.every(function (currentValue, index) {

                        Object.values(currentValue).forEach(function (item, index) {
                            _addEndpoints("Window" + item[4], sourceAnchors, targetAnchors);
                        })

                    })

                    console.log('hits here also')

                    // listen for new connections; initialise them the same way we initialise the connections at startup.
                    instance.bind("connection", function (connInfo, originalEvent) {
                        init(connInfo.connection);
                    });

                    // make all the window divs draggable
                    // instance.draggable(JSPlumb.getSelector(".flowchart-demo .window"), { grid: [20, 20] });
                    // THIS DEMO ONLY USES getSelector FOR CONVENIENCE. Use your library's appropriate selector
                    // method, or document.querySelectorAll:
                    // THIS IS THE DRAGGABLE
                    // JSPlumb.draggable(document.querySelectorAll(".window"), { grid: [20, 20] });

                    // connect a few up
                    // target is LeftMiddle for each, source is RightMiddle
                    // instance.connect({uuids: ["Window4RightMiddle", "Window5LeftMiddle"]});
                    that.$refs.item.forEach(function (item, index) {
                        if (that.$refs.item[index+1]) {
                            instance.connect({source:that.$refs.item[index], target:that.$refs.item[index+1]})
                        }
                    })

                    // instance.connect({uuids: ["Window2LeftMiddle", "Window4LeftMiddle"]});
                    // instance.connect({uuids: ["Window4TopCenter", "Window4RightMiddle"]});
                    // instance.connect({uuids: ["Window3RightMiddle", "Window2RightMiddle"]});
                    // instance.connect({uuids: ["Window4BottomCenter", "Window1TopCenter"]});
                    // instance.connect({uuids: ["Window3BottomCenter", "Window1BottomCenter"] });
                    //

                    //
                    // listen for clicks on connections, and offer to delete connections on click.
                    //
                    instance.bind("click", function (conn, originalEvent) {
                        // if (confirm("Delete connection from " + conn.sourceId + " to " + conn.targetId + "?"))
                        //   instance.detach(conn);
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

<style>
.flowchart-demo .window {
    box-shadow: 2px 2px 19px #aaa;
    -o-box-shadow: 2px 2px 19px #aaa;
    -webkit-box-shadow: 2px 2px 19px #aaa;
    -moz-box-shadow: 2px 2px 19px #aaa;
    -moz-border-radius: 0.5em;
    opacity: 0.8;
    z-index: 20;
    -webkit-transition: -webkit-box-shadow 0.15s ease-in;
    -moz-transition: -moz-box-shadow 0.15s ease-in;
    -o-transition: -o-box-shadow 0.15s ease-in;
    transition: box-shadow 0.15s ease-in;
}

.flowchart-demo .window:hover {
    box-shadow: 2px 2px 19px #444;
    -o-box-shadow: 2px 2px 19px #444;
    -webkit-box-shadow: 2px 2px 19px #444;
    -moz-box-shadow: 2px 2px 19px #444;
    opacity: 0.6;
}

.flowchart-demo .active {
    border: 1px dotted green;
}

.flowchart-demo .hover {
    border: 1px dotted red;
}

.flowchart-demo .jtk-connector {
    z-index: 4;
}

.flowchart-demo .jtk-endpoint, .endpointTargetLabel, .endpointSourceLabel {
    z-index: 21;
    cursor: pointer;
}

.flowchart-demo .aLabel {
    background-color: white;
    padding: 0.4em;
    font: 12px sans-serif;
    color: #444;
    z-index: 21;
    border: 1px dotted gray;
    opacity: 0.8;
    cursor: pointer;
}

.flowchart-demo .aLabel.jtk-hover {
    background-color: #5C96BC;
    color: white;
    border: 1px solid white;
}

.window.jtk-connected {
    border: 1px solid green;
}

.jtk-drag {
    outline: 4px solid pink !important;
}

path, .jtk-endpoint {
    cursor: pointer;
}

.jtk-overlay {
    background-color:transparent;
}
/* ---------------------------------------------------------------------------------------------------- */
/* --- page structure --------------------------------------------------------------------------------- */
/* ---------------------------------------------------------------------------------------------------- */

/*body {*/
/*    background-color: #FFF;*/
/*    color: #434343;*/
/*    font-family: "Lato", sans-serif;*/
/*    font-size: 14px;*/
/*    font-weight: 400;*/
/*    height: 100%;*/
/*    padding: 0;*/
/*}*/

.jtk-bootstrap {
    min-height:100vh;
    display:flex;
    flex-direction: column;
}

.jtk-bootstrap .jtk-page-container {
    display:flex;
    width:100vw;
    justify-content: center;
    flex:1;
}

.jtk-bootstrap .jtk-container {
    width: 60%;
    max-width:800px;
}

.jtk-bootstrap-wide .jtk-container {
    width: 80%;
    max-width:1187px;
}

.jtk-demo-main {
    position: relative;
    margin-top:98px;
    display:flex;
    flex-direction:column;
}

.jtk-demo-main .description {
    font-size: 13px;
    margin-top: 25px;
    padding: 13px;
    margin-bottom: 22px;
    background-color: #f4f5ef;
}

.jtk-demo-main .description li {
    list-style-type: disc !important;
}

.jtk-demo-canvas {
    height:750px;
    /*max-height:700px;*/
    border:1px solid #CCC;
    background-color:white;
    /*display: flex;*/
    flex-grow:1;
}

.canvas-wide {
    margin-left:0;
}

.miniview {
    position: absolute;
    top: 25px;
    right: 25px;
    z-index: 100;
}


.jtk-demo-dataset {
    text-align: left;
    max-height: 600px;
    overflow: auto;
}

.demo-title {
    float:left;
    font-size:18px;
}

.controls {
    top: 25px;
    color: #FFF;
    margin-right: 10px;
    position: absolute;
    left: 25px;
    z-index: 1;
    display:flex;
}

.controls i {
    background-color: #5184a0;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 4px;
    padding: 4px;
}

li {
    list-style-type: none;
}

/* ---------------------------------------------------------------------------------------------------- */
/* --- jsPlumb setup ---------------------------------------------------------------------------------- */
/* ---------------------------------------------------------------------------------------------------- */

.jtk-surface-pan {
    display:none;
}

.jtk-connector {
    z-index:9;
}

.jtk-connector:hover, .jtk-connector.jtk-hover {
    z-index:10;
}

.jtk-endpoint {
    z-index:12;
    opacity:0.8;
    cursor:pointer;
}

.jtk-overlay {
    background-color: white;
    color: #434343;
    font-weight: 400;
    padding: 4px;
    z-index:10;

}

.jtk-overlay.jtk-hover {
    color: #434343;
}

path {
    cursor:pointer;
}

.delete {
    padding: 2px;
    cursor: pointer;
    float: left;
    font-size: 10px;
    line-height: 20px;
}

.add, .edit {
    cursor: pointer;
    float:right;
    font-size: 10px;
    line-height: 20px;
    margin-right:2px;
    padding: 2px;
}

.edit:hover {
    color: #ff8000;
}

.selected-mode {
    color:#E4F013;
}

.connect {
    width:10px;
    height:10px;
    background-color:#f76258;
    position:absolute;
    bottom: 13px;
    right: 5px;
}

/* header styles */
.demo-links div {
    display:inline;
    margin-right:7px;
    margin-left:7px;
}

.demo-links i {
    padding:4px;
}

.jtk-node {
    z-index: 11;
    overflow: hidden;
}

.jtk-node .name {
    color: white;
    cursor: move;
    font-size: 13px;
    line-height: 24px;
    padding: 6px;
    text-align: center;
}

.jtk-node .name span {
    cursor:pointer;
}

[undo], [redo] { background-color:darkgray !important; }
[can-undo='true'] [undo], [can-redo='true'] [redo] { background-color: #3E7E9C  !important; }

</style>
