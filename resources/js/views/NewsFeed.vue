<template>
    <div class="flex flex-col items-center py-4">
        <app-new-post></app-new-post>
        <app-post></app-post>
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
        }
    }
</script>

<style scoped>

</style>
