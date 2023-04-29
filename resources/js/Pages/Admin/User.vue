<template>
    <div class="user-admin">
        <v-form>
            <input type="hidden" id="user-id" v-model="user.id" />
            <v-row>
                <v-col md="6" sm="12">
                    <v-text-field
                        label="Nome"
                        v-model="user.name"
                        required
                        variant="solo"
                        placeholder="Informe o Nome do Usuário..."
                    ></v-text-field>
                </v-col>
                <v-col md="6" sm="12">
                    <v-text-field
                        v-model="user.email"
                        label="Email"
                        required
                        variant="solo"
                        placeholder="Informe o Email do Usuário..."
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-checkbox
                v-if="mode === 'save'"
                v-model="user.admin"
                label="Administrador"
                class="my-3"
            >
            </v-checkbox>
            <v-row v-if="mode === 'save'">
                <v-col md="6" sm="12">
                    <v-text-field
                        v-model="user.password"
                        label="Senha"
                        type="password"
                        required
                        variant="solo"
                        placeholder="Informe o Senha do Usuário..."
                    ></v-text-field>
                </v-col>
                <v-col md="6" sm="12">
                    <v-text-field
                        label="Confirmação de Senha"
                        v-model="user.confirmPassword"
                        type="password"
                        required
                        variant="solo"
                        placeholder="Confirme a Senha do Usuário..."
                    ></v-text-field>
                </v-col>
            </v-row>
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
            :columns="['Código', 'Nome', 'E-mail', 'Administrador', 'Ações']"
            :pagination_data="users"
        >
            <tr v-for="i in users.data" :key="i.id">
                <td>{{ i.id }}</td>
                <td>{{ i.name }}</td>
                <td>{{ i.email }}</td>
                <td>{{ i.admin == 1 ? "Sim" : "Não" }}</td>
                <td>
                    <v-btn
                        variant="tonal"
                        color="warning"
                        class="mr-2"
                        @click="loadUser(i)"
                    >
                        <i class="fa fa-pencil"></i>
                    </v-btn>
                    <v-btn
                        variant="tonal"
                        color="error"
                        @click="loadUser(i, 'remove')"
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

export default {
    name: "UserAdmin",
    components: { Table },
    props: {
        users: Object,
    },
    data() {
        return {
            mode: "save",
            user: {},
        };
    },
    methods: {
        reset() {
            console.log("entrou aqui");
            this.user = {};
            this.mode = "save";
        },
        save() {
            const method = this.user.id ? "put" : "post";
            const url = this.user.id
                ? route("admin.user.update", [this.user.id])
                : route("admin.user.store");

            const vm = this;
            Inertia[method](url, this.user, {
                onSuccess() {
                    vm.reset();
                },
            });
        },
        destroy() {
            const vm = this;

            Inertia.delete(route("admin.user.destroy", [this.user.id]), {
                onSuccess() {
                    if (vm.users.data.length == 0) {
                        window.location = route("admin.user");
                    }
                    vm.reset();
                },
            });
        },
        loadUser(user, mode = "save") {
            user.admin = user.admin == 1 ? true : false;

            this.user = { ...user };
            this.mode = mode;
        },
    },
};
</script>

<style>
.v-selection-control__input > i.v-icon {
    border: 1px solid #000;
    position: relative;
}

.v-selection-control__input > i.v-icon.mdi-checkbox-marked:before,
.v-selection-control__input > i.v-icon.mdi-checkbox-marked:after {
    content: "";
    position: absolute;
    background-color: #000;
}

.v-selection-control__input > i.v-icon.mdi-checkbox-marked:before {
    width: 2px;
    height: 40%;
    left: 6px;
    top: 10px;
    transform: rotate(315deg);
}

.v-selection-control__input > i.v-icon.mdi-checkbox-marked:after {
    width: 2px;
    height: 60%;
    right: 6px;
    top: 5px;
    transform: rotate(45deg);
}
</style>
