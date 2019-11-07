<template>
    <div>
        <form class="flex justify-between" v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>

            <button type="button" class="btn btn-link text-red-500 hover:text-red-400 px-0" data-dismiss="modal">Cancel</button>
        </form>
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        props: ['user'],

        components: { ImageUpload },

        data() {
            return {
                avatar: this.user.avatar
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/users/${this.user.username}/avatar`, data)
                     .then(() => flash('Avatar uploaded!'));
            }
        }
    }
</script>
