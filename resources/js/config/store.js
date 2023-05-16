import { createStore } from "vuex";

export default createStore({
    state: {
        isMenuVisible: true,
        user: {},
    },
    mutations: {
        toggleMenu(state, isVisible) {
            if (isVisible === undefined)
                state.isMenuVisible = !state.isMenuVisible;
            else state.isMenuVisible = isVisible;
        },
        insertUser(state, user) {
            state.user = user;
        },
    },
});
