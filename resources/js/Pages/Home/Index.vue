<template>
    <div>
        <Layout>
            <div class="stats">
                <Stat
                    title="Categorias"
                    :value="stat.categories"
                    icon="fa fa-folder"
                    color="#d54d50"
                />
                <Stat
                    title="Artigos"
                    :value="stat.articles"
                    icon="fa fa-file"
                    color="#3bc480"
                />
                <Stat
                    title="Usuários"
                    :value="stat.users"
                    icon="fa fa-user"
                    color="#3282cd"
                />
            </div>
        </Layout>
    </div>
</template>

<script>
import Layout from "@/layouts/Layout.vue";
import Stat from "./Stat.vue";

export default {
    components: { Layout, Stat },
    props: { stat: Object },
    mounted() {
        this.$store.commit("insertUser", this.$page.props.auth.user);
    },
};
</script>

<style scoped>
.stats {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
</style>
