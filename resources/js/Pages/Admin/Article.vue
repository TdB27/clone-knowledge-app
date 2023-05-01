<template>
    <div class="article-admin">
        <v-form>
            <input type="hidden" id="article-id" v-model="article.id" />
            <v-col>
                <v-text-field
                    label="Nome do Artigo"
                    v-model="article.name"
                    required
                    variant="solo"
                    placeholder="Informe o Nome do Artigo..."
                ></v-text-field>
            </v-col>
            <v-col>
                <v-text-field
                    label="Descrição do Artigo"
                    v-model="article.description"
                    required
                    variant="solo"
                    placeholder="Informe a Descrição do Artigo..."
                ></v-text-field>
            </v-col>
            <v-col>
                <v-text-field
                    label="Imagem (URL)"
                    v-model="article.img_url"
                    required
                    variant="solo"
                    placeholder="Informe a URL da Imagem..."
                ></v-text-field>
            </v-col>
            <v-col>
                <v-select
                    v-model="article.category_id"
                    :items="categories"
                    item-title="path"
                    item-value="id"
                    label="Categoria do Artigo"
                ></v-select>
            </v-col>
            <v-col>
                <v-select
                    v-model="article.user_id"
                    :items="users"
                    item-title="name"
                    item-value="id"
                    label="Autor do Artigo"
                ></v-select>
            </v-col>
            <v-col>
                <QuillEditor
                    v-model:content="article.content"
                    theme="snow"
                    toolbar="full"
                    contentType="html"
                    placeholder="Informe o conteúdo do artigo..."
                />
            </v-col>
            <v-row>
                <v-col xs="12">
                    <v-btn
                        variant="tonal"
                        v-if="mode === 'save'"
                        color="primary"
                        @click="save"
                    >
                        Salvar
                    </v-btn>
                    <v-btn
                        variant="tonal"
                        v-if="mode === 'remove'"
                        color="error"
                        @click="destroy"
                    >
                        Excluir
                    </v-btn>
                    <v-btn variant="outlined" class="ml-2" @click="reset">
                        Cancelar
                    </v-btn>
                </v-col>
            </v-row>
        </v-form>
        <hr />
        <Table
            :columns="['Código', 'Nome', 'Descrição', 'Ações']"
            :pagination_data="articles"
        >
            <tr v-for="i in articles.data" :key="i.id">
                <td>{{ i.id }}</td>
                <td>{{ i.name }}</td>
                <td>{{ i.description }}</td>
                <td>
                    <v-btn
                        variant="tonal"
                        color="warning"
                        class="mr-2"
                        @click="loadArticle(i)"
                    >
                        <i class="fa fa-pencil"></i>
                    </v-btn>
                    <v-btn
                        variant="tonal"
                        color="error"
                        @click="loadArticle(i, 'remove')"
                    >
                        <i class="fa fa-trash"></i>
                    </v-btn>
                </td>
            </tr>
        </Table>
    </div>
</template>

<script>
import Table from "@/components/Table.vue";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { categoriesWithPath } from "@/config/global";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
    name: "articleAdmin",
    components: { Table, QuillEditor },
    props: {
        articles: Object,
        tab: String,
    },
    data() {
        return {
            mode: "save",
            article: {},
            categories: [],
            users: [],
        };
    },
    updated() {
        if (this.tab === "articles") {
            this.reset();
            this.loadCategories();
            this.loadUsers();
        }
    },
    methods: {
        loadCategories() {
            axios.get(route("admin.category.get-all")).then((res) => {
                this.categories = categoriesWithPath(res.data.categories);
            });
        },
        loadUsers() {
            axios.get(route("admin.user.get-all")).then((res) => {
                this.users = res.data.users;
            });
        },
        reset() {
            this.article = {};
            this.mode = "save";

            let element = document.getElementsByClassName("ql-editor");
            element[0].innerHTML = "";
        },
        save() {
            const method = this.article.id ? "put" : "post";
            const url = this.article.id
                ? route("admin.article.update", [this.article.id])
                : route("admin.article.store");

            Inertia[method](url, this.article);
        },
        destroy() {
            const vm = this;

            Inertia.delete(route("admin.article.destroy", [this.article.id]), {
                onSuccess() {
                    if (vm.articles.data.length == 0) {
                        window.location = route("admin.article");
                    }
                },
            });
        },
        loadArticle(article, mode = "save") {
            this.article = { ...article };
            this.mode = mode;
        },
    },
};
</script>
