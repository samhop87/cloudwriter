<template>
    <div style="width:100%;">
        <div style="width:100%;margin-top: 10px;height:100%;">
            <grid-layout :layout.sync="layout"
                         class="grid"
                         :col-num="12"
                         :row-height="30"
                         :is-draggable="draggable"
                         :is-resizable="resizable"
                         :is-bounded="bounded"
                         :vertical-compact="true"
                         :use-css-transforms="true"
            >
                <grid-item v-for="item in layout"
                           :static="item.static"
                           :x="item.x"
                           :y="item.y"
                           :w="item.w"
                           :h="item.h"
                           :i="item.i"
                >
                    <span class="text">{{item.i}}</span>
                </grid-item>
            </grid-layout>
        </div>
    </div>
</template>

<script>
import { GridLayout, GridItem } from "vue3-grid-layout"
import helpers from "@/Mixins/helpers";
export default {
    mixins: [helpers],
    name: 'project-tree',
    components: {
        GridLayout,
        GridItem
    },
    props: {
        id: {
            required: false
        },
        type: {
            required: false
        },
        folder: {
            required: true
        },
        title: {
            required: false
        },
    },
    created() {
        for (let i = 0; i < this.folder.length; i++) {
            let clone = this.cloneObject(this.sample);
            clone.i = this.folder[i].title
            this.layout[i] = clone
        }
    },
    data() {
        return {
            layout: [],
            sample: {
                "x": 0,
                "y": 0,
                "w": 2,
                "h": 2,
                "i": null,
            },
            draggable: true,
            resizable: true,
            bounded: true
        }
    }
}
</script>

<style scoped>
.vue-grid-layout {
    background: #eee;
}
.vue-grid-item:not(.vue-grid-placeholder) {
    background: #ccc;
    border: 1px solid black;
}
.grid::before {
    content: '';
    background-size: calc(calc(100% - 5px) / 12) 40px;
    background-image: linear-gradient(
        to right,
        lightgrey 1px,
        transparent 1px
    ),
    linear-gradient(to bottom, lightgrey 1px, transparent 1px);
    height: calc(100% - 5px);
    width: calc(100% - 5px);
    position: absolute;
    background-repeat: repeat;
    margin:5px;
}
.vue-grid-item .resizing {
    opacity: 0.9;
}
.vue-grid-item .static {
    background: #cce;
}
.vue-grid-item .text {
    font-size: 24px;
    text-align: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    height: 100%;
    width: 100%;
}
.vue-grid-item .no-drag {
    height: 100%;
    width: 100%;
}
.vue-grid-item .minMax {
    font-size: 12px;
}
.vue-grid-item .add {
    cursor: pointer;
}
.vue-draggable-handle {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 0;
    left: 0;
    background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10'><circle cx='5' cy='5' r='5' fill='#999999'/></svg>") no-repeat;
    background-position: bottom right;
    padding: 0 8px 8px 0;
    background-repeat: no-repeat;
    background-origin: content-box;
    box-sizing: border-box;
    cursor: pointer;
}
.layoutJSON {
    background: #ddd;
    border: 1px solid black;
    margin-top: 10px;
    padding: 10px;
}
.columns {
    -moz-columns: 120px;
    -webkit-columns: 120px;
    columns: 120px;
}
</style>
