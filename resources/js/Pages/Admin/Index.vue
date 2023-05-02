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
                            <v-tab value="articles" @click="getArticles">
                                Artigos
                            </v-tab>
                            <v-tab value="categories" @click="getCategories">
                                Categorias
                            </v-tab>
                            <v-tab value="users" @click="getUsers">
                                Usuários
                            </v-tab>
                        </v-tabs>
                        <v-card-text>
                            <v-window v-model="tab">
                                <v-window-item value="articles">
                                    <Article
                                        :articles="articles"
                                        :tab="tab"
                                        v-if="loadComponent"
                                    />
                                </v-window-item>
                                <v-window-item value="categories">
                                    <Category
                                        :categories="categories"
                                        :tab="tab"
                                        v-if="loadComponent"
                                    />
                                </v-window-item>
                                <v-window-item value="users">
                                    <Users
                                        :users="users"
                                        :tab="tab"
                                        v-if="loadComponent"
                                    />
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
import Category from "./Category.vue";
import Article from "./Article.vue";

export default {
    name: "IndexAdmin",
    components: { Layout, PageTitle, Users, Category, Article },
    props: { data: Object, title: String },
    data() {
        return {
            tab: this.title,
            users: {},
            categories: {},
            articles: {},
            toast_options: {
                duration: 5000,
            },
            loadComponent: false,
        };
    },
    mounted() {
        this.setData(this.tab);
    },
    methods: {
        getUsers() {
            let vm = this;
            this.loadComponent = false;

            Inertia.get(
                route("admin.user"),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.users = res.props.data;
                        vm.loadComponent = true;
                    },
                }
            );
        },
        getCategories() {
            let vm = this;
            this.loadComponent = false;

            Inertia.get(
                route("admin.category"),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.categories = res.props.data;
                        vm.loadComponent = true;
                    },
                }
            );
        },
        getArticles() {
            let vm = this;
            this.loadComponent = false;

            Inertia.get(
                route("admin.article"),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.articles = res.props.data;
                        vm.loadComponent = true;
                    },
                }
            );
        },
        setData(value = null) {
            if (value == "articles") this.articles = this.data;
            else if (value == "categories") this.categories = this.data;
            else this.users = this.data;

            this.loadComponent = true;
        },
    },
    watch: {
        data: {
            handler() {
                this.setData(this.tab);
            },
            deep: true,
            immediate: true,
        },
    },
};
</script>
