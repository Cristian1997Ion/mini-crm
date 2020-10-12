<template>
    <div class="content">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Amount</th>
                <th>Created At</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="transaction in transactions">
                <td>{{ transaction.id }}</td>
                <td>
                    <a :href="`clients/${transaction.client_id}/edit`">
                        <img :src="`/storage/avatars/${transaction.client.avatar}`" width="50">
                        {{ getTransactionClientName(transaction) }}
                    </a>
                </td>
                <td>{{ transaction.amount }}</td>
                <td>{{ transaction.created_at }}</td>
                <td>
                    <base-btn
                        tag="a"
                        :href="`/transactions/${transaction.id}/edit`"
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
                        @click.native="deleteTransaction(transaction.id)"
                    />
                </td>
            </tr>
            </tbody>
        </table>
        <alert-modal
            title="Warning"
            message="Are you sure you want to remove this transaction?"
            @send-message="handleConfirm"
            @hide-modal="handleHideModal"
            :show-modal="showModal"
        />
    </div>
</template>

<script>
    export default {
        name: "TransactionsTable.vue",

        props: {
            transactions: {
                type: Array,
                default: []
            },
        },

        data: () => ({
            showModal: false,
            selectedTransactionId: 0,
        }),

        methods: {
            getTransactionClientName(transaction) {
                return transaction.client.first_name + ' ' + transaction.client.last_name;
            },
            deleteTransaction(id) {
                this.selectedTransactionId = id;
                this.showModal = true;
            },
            handleConfirm() {
                if (this.selectedTransactionId > 0) {
                    axios
                        .delete(`/transactions/${this.selectedTransactionId}`)
                        .then(function () {
                            location.reload();
                        })
                }
            },
            handleHideModal() {
                this.selectedTransactionId = 0;
                this.showModal = false;
            }
        }
    }
</script>

<style scoped>

</style>
