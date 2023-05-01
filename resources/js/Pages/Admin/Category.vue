<template>
    <div class="category-admin">
        <v-form>
            <input type="hidden" id="category-id" v-model="category.id" />
            <v-col>
                <v-text-field
                    label="Nome da Categoria"
                    v-model="category.name"
                    required
                    variant="solo"
                    placeholder="Informe o Nome da Categoria..."
                ></v-text-field>
            </v-col>
            <v-col>
                <v-select
                    v-model="category.parent_id"
                    :items="categoriesWithPath"
                    item-title="path"
                    item-value="id"
                    label="Categoria Pai"
                ></v-select>
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
            :columns="['Código', 'Nome', 'Caminho', 'Ações']"
            :pagination_data="categories"
        >
            <tr v-for="i in categories.data" :key="i.id">
                <td>{{ i.id }}</td>
                <td>{{ i.name }}</td>
                <td>{{ i.path }}</td>
                <td>
                    <v-btn
                        variant="tonal"
                        color="warning"
                        class="mr-2"
                        @click="loadCategory(i)"
                    >
                        <i class="fa fa-pencil"></i>
                    </v-btn>
                    <v-btn
                        variant="tonal"
                        color="error"
                        @click="loadCategory(i, 'remove')"
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

export default {
    name: "categoryAdmin",
    components: { Table },
    props: {
        categories: Object,
    },
    data() {
        return {
            mode: "save",
            category: {},
            categoriesWithPath: [],
        };
    },
    updated() {
        this.reset();
        this.categories.data = categoriesWithPath(this.categories.data);
        this.loadCategories();
    },
    methods: {
        loadCategories() {
            axios.get(route("admin.category.get-all")).then((res) => {
                this.categoriesWithPath = categoriesWithPath(
                    res.data.categories
                );
            });
        },
        reset() {
            this.category = {};
            this.mode = "save";
        },
        save() {
            const method = this.category.id ? "put" : "post";
            const url = this.category.id
                ? route("admin.category.update", [this.category.id])
                : route("admin.category.store");

            Inertia[method](url, this.category);
        },
        destroy() {
            Inertia.delete(
                route("admin.category.destroy", [this.category.id]),
                {
                    onSuccess() {
                        if (vm.categories.categories.data.length == 0) {
                            window.location = route("admin.category");
                        }
                    },
                }
            );
        },
        loadCategory(category, mode = "save") {
            this.category = { ...category };
            this.mode = mode;
        },
    },
};
</script>
