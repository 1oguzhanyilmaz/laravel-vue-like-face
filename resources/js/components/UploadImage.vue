<template>
    <div>
        <img :src="userImage.data.attributes.path"
             :alt="alt"
             ref="userImage"
             :class="classes">

    </div>
</template>

<script>
    import Dropzone from 'dropzone';
    import { mapGetters } from 'vuex';

    export default {
        name: "UploadImage",
        props: ['imageWidth', 'imageHeight', 'location', 'userImage', 'classes', 'alt'],
        data: function(){
            return {
                dropzone: null,
            }
        },
        mounted(){
            if (this.authUser.data.user_id.toString() === this.$route.params.userId){
                this.dropzone = new Dropzone(this.$refs.userImage, this.settings);
            }
            // console.log(this.dropzone);
        },
        computed:{
            ...mapGetters({
                authUser: 'authUser',
            }),
            settings(){
                // console.log(this.uploadedImage);
                const vm = this;
                return {
                    paramName: 'image',
                    url: '/api/user-images',
                    acceptedFiles: 'image/*',
                    params: {
                        'width': this.imageWidth,
                        'height': this.imageHeight,
                        'location': this.location,
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                        // 'x-csrf-token': document.querySelector('meta[name=csrf-token]').getAttributeNode('content').value,
                    },
                    success: function(e, res){
                        // console.log('#################');
                        // console.log(vm.dropzone);
                        // console.log(res);
                        // vm.uploadedImage = 'abc';
                        alert('Uploaded successfully!');
                        // vm.uploadedImage = res;
                        vm.$store.dispatch('fetchAuthUser');
                        vm.$store.dispatch('fetchUser', vm.$route.params.userId);
                        vm.$store.dispatch('fetchUserPosts', vm.$route.params.userId);
                        // console.log('uploaded in success');
                        // console.log(this.uploadedImage.attributes.path);
                    }
                };
            },
        }
    }
</script>

<style scoped>

</style>
