<template>
    <div>
        <img :src="imageObject.data.attributes.path"
             :alt="alt"
             ref="userImage"
             :class="classes">

    </div>
</template>

<script>
    import Dropzone from 'dropzone';

    export default {
        name: "UploadImage",
        props: ['imageWidth', 'imageHeight', 'location', 'userImage', 'classes', 'alt'],
        data: function(){
            return {
                dropzone: null,
                uploadedImage: null,
            }
        },
        mounted(){
            this.dropzone = new Dropzone(this.$refs.userImage, this.settings);
            console.log(this.dropzone);
        },
        computed:{
            settings(){
                console.log(this.uploadedImage);
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
                        vm.uploadedImage = res;
                        // console.log('uploaded in success');
                        // console.log(this.uploadedImage.attributes.path);
                    }
                };
            },
            imageObject(){
                // console.log('Computed : uploaded image');
                // console.log(this.uploadedImage);
                return (this.uploadedImage !== null) ?  this.uploadedImage : this.userImage;
            }
        }
    }
</script>

<style scoped>

</style>
