<template>
    <div class="flex flex-col items-center" v-if="status.user === 'success' && user">
        <div class="relative mb-8">

            <!-- ### Background Image ### -->
            <div class="w-100 h-64 overflow-hidden z-10">
                <app-upload-image
                    image-width="1200"
                    image-height="500"
                    location="cover"
                    alt="user background image"
                    classes="object-cover w-full"
                    :user-image="user.data.attributes.cover_image"
                ></app-upload-image>
            </div>

            <!-- ### User Profile & Name ### -->
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <app-upload-image
                        image-width="750"
                        image-height="750"
                        location="profile"
                        alt="user profile image"
                        classes="w-32 h-32 border-4 border-gray-200 shadow-lg object-cover rounded-full"
                        :user-image="user.data.attributes.profile_image"
                    ></app-upload-image>
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
            </div>

            <!-- ### Add friend Button ### -->
            <div class="absolute flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
                <button v-if="friendButtonText && friendButtonText !== 'Accept'"
                        class="py-1 px-3 bg-gray-400 rounded"
                        @click="$store.dispatch('sendFriendRequest', $route.params.userId)">
                    {{ friendButtonText }}
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                        class="mr-2 py-1 px-3 bg-blue-500 rounded"
                        @click="$store.dispatch('acceptFriendRequest', $route.params.userId)">
                    Accept
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                        class="py-1 px-3 bg-gray-400 rounded"
                        @click="$store.dispatch('ignoreFriendRequest', $route.params.userId)">
                    Ignore
                </button>
            </div>
        </div>

        <div v-if="status.posts === 'loading'">Loading posts...</div>
        <div v-else-if="posts.length < 1">No Posts...</div>
        <app-post v-else v-for="(post, postKey) in posts.data" :key="postKey" :post="post"></app-post>

    </div>
</template>

<script>
    import Post from "../../components/Post";
    import UploadImage from "../../components/UploadImage";
    import { mapGetters } from 'vuex';

    export default {
        name: "Show",
        components: {
            'app-post': Post,
            'app-upload-image': UploadImage,
        },
        mounted() {
            this.$store.dispatch('fetchUser', this.$route.params.userId);
            this.$store.dispatch('fetchUserPosts', this.$route.params.userId);
        },
        computed: {
            ...mapGetters({
                user: 'user',
                posts: 'posts',
                status: 'status',
                friendButtonText: 'friendButtonText',
            }),
        }
    }
</script>

<style scoped>

</style>
