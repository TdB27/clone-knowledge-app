<template>
    <div>
        <v-table>
            <thead>
                <tr>
                    <th v-for="(col, i) in columns" :key="i">
                        {{ col }}
                    </th>
                </tr>
            </thead>
            <tbody ref="tableBody">
                <slot />
            </tbody>
        </v-table>
        <div v-if="emptyTable" style="text-align: center">
            Nenhum registro encontrado
        </div>
        <div class="pa-1 d-flex w-100 justify-center">
            <!-- Paginação -->
            <div v-if="pagination_data && pagination_data.data?.length">
                <small>
                    Mostrando {{ pagination_data.from ?? 0 }} até
                    {{ pagination_data.to ?? 0 }} de
                    {{ pagination_data.total ?? 0 }}
                    registros.
                </small>
                <ul class="pagination mb-0 mt-2">
                    <li
                        v-for="(link, i) in pagination_data.links"
                        :key="i"
                        class="page-item"
                        :class="getLinkCSSClass(link)"
                    >
                        <Link
                            class="page-link mx-1"
                            :class="getLinkCSSClass(link)"
                            :href="link.url"
                            v-html="link.label"
                        />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    name: "Table",
    props: { columns: Array, pagination_data: Object },
    components: { Link },
    data() {
        return {
            emptyTable: true,
        };
    },
    mounted() {
        this.emptyTable = this.$refs.tableBody.rows.length < 1;

        // Mutation Observer para escutar mudanças no corpo da tabela para verificar se está vazia ou não
        const observer = new MutationObserver((mutations) => {
            this.emptyTable = this.$refs.tableBody.rows.length < 1;
        });

        observer.observe(this.$refs.tableBody, {
            childList: true,
        });
    },
    methods: {
        getLinkCSSClass(link) {
            let css = "";

            if (link.active) {
                css = " active ";
            }

            if (isNaN(link.label) && link.url === null) {
                css += " disabled ";
            }

            return css;
        },
    },
};
</script>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    list-style: none;
}

.page-link {
    padding: 6px 12px;
    font-size: small;
    text-decoration: none;

    background-color: #ece0fd;
    color: #6200f1;
}

.page-link.active {
    background-color: #6200f1;
    color: #ece0fd;
}

.disabled {
    cursor: not-allowed;
    opacity: 0.8;
    color: #4b5563;
}

.page-item:first-child .page-link {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.page-item:last-child .page-link {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}
</style>
