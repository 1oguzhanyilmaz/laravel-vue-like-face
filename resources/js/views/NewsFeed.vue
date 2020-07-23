<template>
    <div class="flex flex-col items-center py-4">
        <app-new-post></app-new-post>

        <p v-if="loading">Loading posts...</p>
        <app-post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"></app-post>
    </div>
</template>

<script>
    import NewPost from "../components/NewPost";
    import Post from "../components/Post";

    export default {
        name: "NewsFeed",
        components: {
            "app-new-post": NewPost,
            "app-post": Post,
        },
        data: function(){
            return {
                posts: [],
                loading: true,
            }
        },
        mounted() {
            axios.get('/api/posts')
                .then((res) => {
                    this.posts = res.data;
                    this.loading = false;
                })
                .catch(error => {
                    console.log('Unable to get posts');
                    this.loading = false;
                });
        }
    }
</script>

<style scoped>

</style>
