<template>
    <div class="flex flex-col items-center">

        <!-- ### User Details ### -->
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img src="https://source.unsplash.com/weekly?water" alt="user img" class="object-cover w-full">
            </div>

            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ8aAprNBYJ0V0RG9lWxu6D4H7noO4yz6mpSD2n5E3Yr-vWphO_&usqp=CAU" alt="" class="w-32 h-32 border-4 border-gray-200 shadow-lg object-cover rounded-full">
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
            </div>
        </div>

        <!-- ### User Posts ### -->
        <p v-if="postLoading">Loading posts...</p>
        <app-post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"></app-post>

        <p v-if="!postLoading && posts.data.length < 1">No Posts...</p>
    </div>
</template>

<script>
    import Post from "../../components/Post";

    export default {
        name: "Show",
        components: {
            'app-post': Post,
        },
        data: function () {
            return {
                user: null,
                posts: null,
                userLoading: true,
                postLoading: true,
            }
        },
        mounted() {
            axios.get('/api/users/' + this.$route.params.userId)
                .then((res) => {
                    this.user = res.data;
                })
                .catch(error => {
                    console.log("Unable to get the user from the server.");
                })
                .finally(() => {
                    this.userLoading = false;
                });

            axios.get('/api/users/' + this.$route.params.userId + '/posts')
                .then((res) => {
                    this.posts = res.data;
                })
                .catch(error => {
                    console.log('Unable to get posts');
                })
                .finally(() => {
                    this.postLoading = false;
                });
        }
    }
</script>

<style scoped>

</style>
