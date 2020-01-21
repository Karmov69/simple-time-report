require("./bootstrap");

const app = new Vue({
    el: "#app",
    components: {
        "app-create-user": require("./components/CreateUser.vue")
    }
});