<template>
    <aside class="menu" v-show="isMenuVisible">
        <ul class="tree">
            <tree v-for="(t, index) in treeData" :key="index" :item="t"></tree>
        </ul>
    </aside>
</template>

<script>
import axios from "axios";
import { mapState } from "vuex";
import Tree from "./Tree.vue";

export default {
    name: "MenuLayout",
    components: { Tree },
    inject: ["mq"],
    data() {
        return {
            treeData: [],
        };
    },
    computed: {
        ...mapState(["isMenuVisible"]),
    },
    mounted() {
        this.getTreeData();

        if (this.mq.current === "xs" || this.mq.current === "sm") {
            this.$store.commit("toggleMenu", false);
        }
    },
    watch: {
        "$page.props.flash.message"() {
            this.getTreeData();
        },
    },
    methods: {
        getTreeData() {
            const url = route("categories.get-tree");
            axios.get(url).then((res) => {
                this.treeData = this.mountTree(res.data.categories);
            });
        },
        mountTree(categories, tree) {
            if (!tree) tree = categories.filter((c) => !c.parent_id);

            tree = tree.map((parentNode) => {
                const isChild = (node) => node.parent_id == parentNode.id;
                parentNode.children = this.mountTree(
                    categories,
                    categories.filter(isChild)
                );
                return parentNode;
            });
            return tree;
        },
    },
};
</script>

<style scoped>
.menu {
    grid-area: menu;
    background: linear-gradient(to right, #232526, #414345);

    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.tree {
    padding: 1rem 0;
}
</style>
