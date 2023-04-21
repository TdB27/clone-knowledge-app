<template>
    <div>
        <Layout>
            <h1>Logado</h1>
        </Layout>
    </div>
</template>

<script>
import Layout from "../layouts/Layout.vue";

export default {
    components: { Layout },
    props: { user: Object },
    mounted() {
        this.$store.commit("insertUser", this.user);
    },
};
</script>
