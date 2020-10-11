<template>
    <div class="content">
        <form
            :action="formAction"
            v-bind:method="formMethod"
            enctype="multipart/form-data"
            class="col-md-8"
        >
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="id" :value="client.id">

            <div class="form-row pb-2">
                <input type="file" class="d-none" name="avatar" id="avatarInput" @change="useAvatar($event)">
                <div class="col-md-12 justify-content-center d-flex">
                    <img :src="client.avatar" alt="default" width="150" height="150" id="avatarImage"/>
                </div>
                <div class="col-md-12 justify-content-center d-flex">
                    <div class="row">
                        <div class="col">
                            <base-btn
                                variant="primary"
                                text="change"
                                size="sm"
                                type="button"
                                @click.native="changeAvatar"
                            />
                        </div>
                        <div class="col" v-if="hasAvatar">
                            <base-btn
                                variant="danger"
                                text="remove"
                                size="sm"
                                type="button"
                                @click.native="removeAvatar(client.id)"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row pb-2 justify-content-center d-flex" v-if="hasErrors">
                <div class="col-md-6 alert alert-danger">
                    <ul>
                        <li v-for="error in errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" required :value="client.first_name">
                </div>
                <div class="form-group col">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" required :value="client.last_name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required :value="client.email">
                </div>
            </div>

            <div class="form-row">
                <div class="col justify-content-center d-flex">
                    <base-btn
                        variant="outline-primary"
                        size="lg"
                        :text="actionText"
                    />
                </div>
            </div>
        </form>
        <alert-modal
            title="Warning"
            message="Do you really want to remove client's avatar?"
            :show-modal="showModal"
            @send-message="handleSendConfirm"
        />
    </div>

</template>

<script>
    export default {
        name: "ClientForm",

        props: {
            client: {
                type: Object,
                default: null,
            },
            formAction: '',
            formMethod: '',
            errors: Array
        },

        data: () => ({
            showModal: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }),

        computed: {
            hasAvatar() {
                return this.client && this.client.avatar;
            },
            actionText() {
                return this.client && this.client.id ? 'Update' : 'Create';
            },
            hasErrors() {
                return this.errors && this.errors.length > 0;
            }
        },

        methods: {
            changeAvatar() {
                document.getElementById('avatarInput').click();
            },
            useAvatar(event) {
                let image = event.target.files[0];
                if (!image) { return;}

                let reader = new FileReader();

                reader.onload = function(event) {
                    document.getElementById('avatarImage').src = event.target.result;
                };

                reader.readAsDataURL(image);
            },
            removeAvatar() {
                this.showModal = true;
            },
            handleSendConfirm() {
                axios
                    .put(`/clients/${this.client.id}/removeAvatar`)
                    .then(function () {
                        location.reload();
                    });
            }
        }
    }
</script>

<style scoped>

</style>
