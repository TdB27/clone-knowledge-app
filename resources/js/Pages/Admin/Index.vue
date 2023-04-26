<template>
    <div>
        <Layout>
            <div class="admin-pages">
                <PageTitle
                    icon="fa fa-cogs"
                    main="Administração do Sistema"
                    sub="Cadastro & Cia"
                />
                <div class="admin-pages-tabs">
                    <v-card>
                        <v-tabs v-model="tab">
                            <v-tab value="articles"> Artigos </v-tab>
                            <v-tab value="categories"> Categorias </v-tab>
                            <v-tab value="users" @click="getUsers">
                                Usuários
                            </v-tab>
                        </v-tabs>
                        <v-card-text>
                            <v-window v-model="tab">
                                <v-window-item value="articles">
                                    articles
                                </v-window-item>
                                <v-window-item value="categories">
                                    categories
                                </v-window-item>
                                <v-window-item value="users">
                                    <Users :users="users" />
                                </v-window-item>
                            </v-window>
                        </v-card-text>
                    </v-card>
                </div>
            </div>
        </Layout>
    </div>
</template>

<script>
import Layout from "@/layouts/Layout.vue";
import PageTitle from "@/layouts/PageTitle.vue";
import { Inertia } from "@inertiajs/inertia";
import Users from "./User.vue";

export default {
    name: "IndexAdmin",
    components: { Layout, PageTitle, Users },
    props: { data: Object, title: String },
    data() {
        return {
            tab: this.title,
            users: {},
        };
    },
    watch: {
        tab(value) {
            this.verifyTab(value);
        },
    },
    mounted() {
        this.verifyTab(this.tab);
    },
    methods: {
        getUsers() {
            let vm = this;
            Inertia.get(
                route("admin.user"),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.users = res.props.data;
                    },
                }
            );
        },
        verifyTab(value = null) {
            if (value == "articles") console.log("articles");
            else if (value == "categories") console.log("categories");
            else this.users = this.data;
        },
    },
};
</script>
