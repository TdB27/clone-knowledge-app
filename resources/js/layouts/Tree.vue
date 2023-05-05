<template>
    <li>
        <a
            class="item"
            :class="['item-' + item.id, { actived }]"
            @click="toggle(item.id)"
        >
            <i
                v-if="isFolder"
                class="icon fa fa-lg"
                :class="isOpen ? 'fa-angle-down' : 'fa-angle-right'"
            ></i>
            <span> {{ item.name }} </span>
        </a>
        <ul v-show="isOpen" v-if="isFolder">
            <tree
                class="item-children"
                v-for="(child, index) in item.children"
                :key="index"
                :item="child"
            ></tree>
        </ul>
    </li>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "Tree",
    props: {
        item: Object,
    },
    data() {
        return {
            isOpen: false,
            actived: false,
        };
    },
    computed: {
        isFolder() {
            return this.item.children && this.item.children.length;
        },
    },
    methods: {
        toggle(id) {
            if (this.isFolder) {
                this.isOpen = !this.isOpen;
            }

            let item = document.querySelectorAll(".item");
            item.forEach((i) => {
                i.classList.remove("actived");
            });

            let vm = this;
            Inertia.get(
                route("article.get-by-categories", { id }),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.actived = !vm.actived;
                    },
                }
            );
        },
    },
};
</script>

<style scoped>
li {
    line-height: 1.5em;
    list-style-type: none;
}

.item {
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 5px 0;
    color: #fff;
    padding-left: 2.5rem;

    position: relative;
}

.icon {
    position: absolute;
    left: 10px;
    opacity: 0.5;
}

.item.actived::before,
.item:hover::before {
    content: "";
    width: 100vw;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(255, 255, 255, 0.2);
}

.item-children {
    padding-left: 1em;
}
</style>
