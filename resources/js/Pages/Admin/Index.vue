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
                            <v-tab value="users"> Usuários </v-tab>
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
                                    <!-- <UserAdmin /> -->
                                    users
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

export default {
    components: { Layout, PageTitle },
    data() {
        return {
            tab: "Articles",
        };
    },
};
</script>
