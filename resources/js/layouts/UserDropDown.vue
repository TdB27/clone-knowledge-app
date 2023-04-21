<template>
    <div class="user-dropdown">
        <div class="user-button">
            <span class="d-none d-sm-block">{{ user.name }}</span>
            <i class="fa fa-angle-down"></i>
        </div>
        <div class="user-dropdown-content">
            <a href="./admin" v-if="user.admin">
                <i class="fa fa-cogs"></i> Administração
            </a>
            <Link class="title" :href="route('logout')">
                <i class="fa fa-sign-out"></i> Sair
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { mapState } from "vuex";

export default {
    name: "UserDropdown",
    components: { Link },
    computed: mapState(["user"]),
};
</script>

<style scoped>
.user-dropdown {
    height: 100%;
    position: relative;
}

.user-dropdown:hover {
    background-color: rgba(0, 0, 0, 0.2);
}

.user-button {
    display: flex;
    align-items: center;
    color: #fff;
    height: 100%;
    padding: 0 20px;
    cursor: pointer;
}

.user-button span {
    margin-right: 10px;
}

.user-dropdown-content {
    position: absolute;
    right: 0;
    background-color: #f9f9f9;
    min-width: 170px;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    padding: 10px;
    z-index: 1;

    display: flex;
    flex-direction: column;
    flex-wrap: wrap;

    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.5s linear;
}

.user-dropdown:hover .user-dropdown-content {
    visibility: visible;
    opacity: 1;
}

.user-dropdown-content a {
    text-decoration: none;
    color: #000;
    padding: 10px;
}

.user-dropdown-content a:hover {
    background-color: #ededed;
    text-decoration: none;
    color: #000;
}
</style>
