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
                    <div class="col-md-3">Client</div>
                    <div class="col-md-12">
                        <input type="text" name="client" class="form-control-sm form-control-range filter" :value="clientFilter">
                    </div>
                </th>
                <th>
                    <div class="col-md-3">Amount</div>
                    <div class="col-md-12">
                        <input type="email" name="amount" class="form-control-sm form-control-range filter" :value="amountFilter">
                    </div>
                </th>
                <th>
                    <div class="col-md-4">Created</div>
                    <div class="col-md-12">
                        <input type="email" name="created" class="form-control-sm form-control-range filter" :value="createdFilter">
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
            <tr v-for="transaction in transactions">
                <td>{{ transaction.id }}</td>
                <td>
                    <div class="d-flex justify-content-start pl-3">
                        <img :src="`/storage/avatars/${transaction.client.avatar}`" width="50">
                        &nbsp;
                        <a :href="`clients/${transaction.client_id}/edit`">
                            {{ getTransactionClientName(transaction) }}
                        </a>
                    </div>
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
            idFilter: '',
            clientFilter:'',
            amountFilter:'',
            createdFilter: '',
        },

        data: () => ({
            showModal: false,
            selectedTransactionId: 0,
            locationRedirect: window.location.href.split('?')[0] + '?page=1'
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
    td {
        text-align: center;
    }
</style>
