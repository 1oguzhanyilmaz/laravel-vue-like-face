<template>
    <div class="flex flex-col items-center py-4">
        <p>{{ newsStatus.newsPostsStatus }}</p>
        <app-new-post></app-new-post>

        <p v-if="newsStatus.postsStatus === 'loading'">Loading posts...</p>

        <app-post v-for="post in posts.data" :key="post.data.post_id" :post="post"></app-post>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import NewPost from "../components/NewPost";
    import Post from "../components/Post";

    export default {
        name: "NewsFeed",
        components: {
            "app-new-post": NewPost,
            "app-post": Post,
        },
        mounted() {
            this.$store.dispatch('fetchNewsPosts');
        },
        computed: {
            ...mapGetters({
                posts: 'newsPosts',
                newsStatus: 'newsStatus',
            }),
        }
    }
</script>

<style scoped>

</style>
