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
                                    articles
                                </v-window-item>
                                <v-window-item value="categories">
                                    <Category :categories="categories" />
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
import Category from "./Category.vue";

export default {
    name: "IndexAdmin",
    components: { Layout, PageTitle, Users, Category },
    props: { data: Object, title: String },
    data() {
        return {
            tab: this.title,
            users: {},
            categories: {},
            toast_options: {
                duration: 5000,
            },
        };
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
        getCategories() {
            let vm = this;
            Inertia.get(
                route("admin.category"),
                {},
                {
                    preserveState: true,
                    onSuccess(res) {
                        vm.categories = res.props.data;
                    },
                }
            );
        },
        verifyTab(value = null) {
            if (value == "articles") console.log("articles");
            else if (value == "categories") this.categories = this.data;
            else this.users = this.data;
        },
    },
    watch: {
        data: {
            handler() {
                this.verifyTab(this.tab);
            },
            deep: true,
            immediate: true,
        },
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
