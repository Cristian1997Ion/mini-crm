<template>
    <div class="content">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
            <tr>
                <th class="col-md-2">
                    <div class="row">
                        <div class="col-md-12">ID</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input
                                type="number"
                                min="0" name="id"
                                class="form-control-sm form-control-range filter" :value="idFilter">
                        </div>
                    </div>
                </th>
                <th>
                    <div class="col-md-3">Name</div>
                    <div class="col-md-12">
                        <input type="text" name="name" class="form-control-sm form-control-range filter" :value="nameFilter">
                    </div>
                </th>
                <th>
                    <div class="col-md-3">Email</div>
                    <div class="col-md-12">
                        <input type="email" name="email" class="form-control-sm form-control-range filter" :value="emailFilter">
                    </div>
                </th>
                <th class="col-md-1">
                    <div class="row">
                        <div class="col-md-12">Options</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <base-btn
                                variant="outline-light"
                                text="filter"
                                size="sm"
                                @click.native="filter"
                            ></base-btn>
                        </div>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="client in clients">
                <td>{{ client.id }}. <img :src="`/storage/avatars/${client.avatar}`" width="50"></td>
                <td>{{ `${client.first_name} ${client.last_name}` }}</td>
                <td>{{ client.email }}</td>
                <td>
                    <base-btn
                        tag="a"
                        :href="`/clients/${client.id}/edit`"
                        variant="outline-primary"
                        size="sm"
                        title="Edit client's info"
                        icon-classes="oi oi-pencil"
                    />
                    <base-btn
                        variant="outline-danger"
                        size="sm"
                        title="Delete client"
                        icon-classes="oi oi-x"
                        @click.native="deleteClient(client.id)"
                    />
                </td>
            </tr>
            </tbody>
        </table>
        <alert-modal
            title="Warning"
            message="Are you sure you want to remove this client?"
            @send-message="handleConfirm"
            @hide-modal="handleHideModal"
            :show-modal="showModal"
        />
    </div>
</template>

<script>
    export default {
        name: "ClientsTable.vue",

        props: {
            clients: {
                type: Array,
                default: []
            },
            idFilter: '',
            nameFilter: '',
            emailFilter: ''
        },

        data: () => ({
            showModal: false,
            selectedClientId: 0,
            locationRedirect: window.location.href.split('?')[0] + '?page=1'
        }),

        methods: {
            deleteClient(id) {
                this.selectedClientId = id;
                this.showModal = true;
            },
            handleConfirm() {
                if (this.selectedClientId > 0) {
                    axios
                        .delete(`/clients/${this.selectedClientId}`)
                        .then(function () {
                            location.reload();
                        })
                }
            },
            handleHideModal() {
                this.selectedClientId = 0;
                this.showModal = false;
            },
            filter() {
                let filters =  document.querySelectorAll('.filter');
                for (let i = 0; i < filters.length; i++) {
                    this.locationRedirect += '&' + filters[i].getAttribute('name') + '=' + filters[i].value;
                }

                location.href = this.locationRedirect;
            }
        }
    }
</script>

<style scoped>

</style>
