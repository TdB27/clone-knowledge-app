<template>
    <div class="auth-content">
        <div class="auth-modal">
            <img src="../../assets/logo.png" width="200" alt="Logo" />
            <hr />
            <div class="auth-title">
                {{ showSignup ? "Cadastro" : "Login" }}
            </div>

            <input
                type="text"
                v-if="showSignup"
                v-model="user.name"
                placeholder="Nome"
            />
            <input
                type="email"
                name="email"
                v-model="user.email"
                placeholder="E-mail"
            />
            <input
                type="password"
                name="password"
                v-model="user.password"
                placeholder="Senha"
            />
            <input
                type="password"
                v-if="showSignup"
                v-model="user.confirmPassword"
                placeholder="Confirmação de Senha"
            />

            <button v-if="showSignup" @click="signup">Registar</button>
            <button v-else @click="signin">Entrar</button>

            <a href @click.prevent="showSignup = !showSignup">
                <span @click="reset" v-if="showSignup">
                    Já tem Cadastro? Acesse o Login!
                </span>
                <span @click="reset" v-else>
                    Não tem Cadastro? Registre-se aqui!
                </span>
            </a>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
export default {
    name: "Login",
    components: { Head },
    props: { errors: Object, flash: Object },
    data() {
        return {
            showSignup: true,
            user: {},
            toast_options: {
                duration: 5000,
            },
        };
    },
    methods: {
        reset() {
            this.user = {};
        },
        signin() {
            Inertia.post(route("authenticate"), this.user);
        },
        signup() {
            let vm = this;
            Inertia.post(route("web.user.store"), this.user, {
                onSuccess(res) {
                    vm.reset();
                },
            });
        },
    },
    watch: {
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

<style scoped>
.auth-content {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.auth-modal {
    background-color: #fff;
    width: 350px;
    padding: 35px;
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);

    display: flex;
    flex-direction: column;
    align-items: center;
}

.auth-title {
    font-size: 1.2rem;
    font-weight: 100;
    margin-top: 10px;
    margin-bottom: 15px;
}

.auth-modal input {
    border: 1px solid #bbb;
    width: 100%;
    margin-bottom: 15px;
    padding: 3px 8px;
    outline: none;
}

.auth-modal button {
    align-self: flex-end;
    background-color: #2460ae;
    color: #fff;
    padding: 5px 15px;
    margin-bottom: 8px;
}

.auth-modal hr {
    border: 0;
    width: 100%;
    height: 1px;
    background-image: linear-gradient(
        to right,
        rgba(120, 120, 120, 0),
        rgba(120, 120, 120, 0.75),
        rgba(120, 120, 120, 0)
    );
}
</style>
