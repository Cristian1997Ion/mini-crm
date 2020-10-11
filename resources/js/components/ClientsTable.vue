<template>
    <div class="content">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="client in clients">
                <td>{{ client.id }}</td>
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
        },

        data: () => ({
            showModal: false,
            selectedClientId: 0,
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

        }
    }
</script>

<style scoped>

</style>
