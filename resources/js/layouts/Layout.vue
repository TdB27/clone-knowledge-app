<template>
    <div id="app-layout" :class="{ 'hide-menu': !isMenuVisible }">
        <Header title="Cod3r - Base de Conhecimento" :hideToggle="true" />
        <Menu />
        <Content>
            <slot />
        </Content>
        <Footer />
    </div>
</template>

<script>
import Header from "./Header.vue";
import Menu from "./Menu.vue";
import Content from "./Content.vue";
import Footer from "./Footer.vue";

import { mapState } from "vuex";

export default {
    components: { Header, Menu, Content, Footer },
    computed: mapState(["isMenuVisible"]),
    watch: {
        "$page.props.errors": {
            handler(errors) {
                this.toast.clear();
                this.$nextTick(() => {
                    Object.values(errors).forEach((error, i) => {
                        this.toast.error(error, this.toast_options);
                    });
                });
            },
            deep: true,
            immediate: true,
        },
        "$page.props.flash.message": {
            handler(message) {
                if (message) {
                    this.$nextTick(() => {
                        this.toast[message.type](message.text, {});
                    });
                }
            },
            deep: true,
            immediate: true,
        },
    },
};
</script>

<style>
#app-layout {
    height: 100vh;
    display: grid;
    grid-template-rows: 60px 1fr 40px;
    grid-template-columns: 300px 1fr;
    grid-template-areas:
        "header header"
        "menu content"
        "menu footer";
}

#app-layout.hide-menu {
    grid-template-areas:
        "header header"
        "content content"
        "footer footer";
}

hr {
    margin: 20px 0;
}
</style>
