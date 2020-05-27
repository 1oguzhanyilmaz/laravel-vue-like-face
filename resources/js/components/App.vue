<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-scroll" v-if="authUser">
        <app-nav></app-nav>
        <div class="flex overflow-y-hidden flex-1">
            <app-sidebar></app-sidebar>

            <div class="w-2/3 overflow-x-hidden">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>
    </div>

</template>

<script>
    import Nav from "./Nav";
    import Sidebar from "./Sidebar";
    import { mapGetters } from 'vuex';

    export default {
        name: "App",
        components: {
            "app-nav": Nav,
            "app-sidebar": Sidebar,
        },
        mounted() {
            this.$store.dispatch('fetchAuthUser');
        },
        created(){
            this.$store.dispatch('setPageTitle', this.$route.meta.title);
        },
        computed:{
            ...mapGetters({
                authUser: 'authUser',
            })
        },
        watch: {
            $route(to, from){
                this.$store.dispatch('setPageTitle', to.meta.title);
            }
        }
    }
</script>

<style scoped>

</style>
