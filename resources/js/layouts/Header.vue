<template>
    <header class="header">
        <a class="toggle" @click="toggleMenu">
            <i class="fa fa-lg" :class="icon"></i>
        </a>
        <h1 class="title">
            <Link class="title" :href="route('home')">
                {{ title }}
            </Link>
        </h1>
        <UserDropDown />
    </header>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import UserDropDown from "./UserDropDown.vue";

export default {
    name: "HeaderLayout",
    components: { UserDropDown, Link },
    props: {
        title: String,
    },
    computed: {
        icon() {
            return this.$store.state.isMenuVisible
                ? "fa-angle-left"
                : "fa-angle-down";
        },
    },
    methods: {
        toggleMenu() {
            this.$store.commit("toggleMenu");
        },
    },
};
</script>

<style scoped>
.header {
    grid-area: header;
    background: linear-gradient(to right, #1e469a, #49a7c1);

    display: flex;
    justify-content: center;
    align-items: center;
}

.title {
    font-size: 1.2rem;
    color: #fff;
    font-weight: 100;
    flex-grow: 1;
    text-align: center;
}

.title a,
.title a:hover {
    color: #fff;
    text-decoration: none;
}

header.header > a.toggle {
    width: 60px;
    height: 100%;
    color: #fff;
    justify-self: flex-start;
    text-decoration: none;

    display: flex;
    justify-content: center;
    align-items: center;
}

header.header > a.toggle:hover {
    color: #fff;
    background-color: rgba(0, 0, 0, 0.2);
}
</style>
