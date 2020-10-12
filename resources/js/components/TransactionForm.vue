<template>
    <div class="row">
        <form
            :action="formAction"
            v-bind:method="formMethod"
            class="col-md-12"
        >
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="id" :value="formData.id">

            <div class="form-row pb-2">
                <div class="form-group col">
                    <label>Client</label>
                    <v-select
                        :options="clients"
                        @search="onSearch"
                        @input="setSelected"
                        :value="selected"
                    >
                        <template slot="no-options">
                            Type in client's id or name...
                        </template>
                        <template slot="option" slot-scope="option">
                            <div class="d-center">
                                <img :src='`/storage/avatars/${option.avatar}`' width="30"/>
                                {{ option.label }}
                            </div>
                        </template>
                        <template slot="selected-option" slot-scope="option">
                            <div class="selected d-center">
                                <img :src='`/storage/avatars/${option.avatar}`' width="30"/>
                                {{ option.label }}
                            </div>
                        </template>
                    </v-select>
                    <input type="hidden" name="client_id" :value="formData.client_id" required>
                </div>
            </div>
            <div class="form-row" v-if="hasErrors">
                <div class="col-md-12 alert alert-danger">
                    <ul>
                        <li v-for="error in errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label>Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" :value="formData.amount" required>
                </div>
            </div>
            <div class="form-row d-flex justify-content-center pt-2">
                <div class="form-col">
                    <base-btn
                        variant="outline-primary"
                        text="Save"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "TransactionForm",

        props: {
            transaction: null,
            formAction: '',
            formMethod: '',
            errors: Array
        },

        data: () => ({
            formData: {
                id: '',
                client_id: '',
                amount: '',
            },
            selected: null,
            clients: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }),

        mounted() {
            this.formData = this.transaction || this.formData;

            if (this.transaction && this.transaction.client){
                this.setSelected({
                    code: this.transaction.client.id,
                    label: `${this.transaction.client.first_name}  ${this.transaction.client.last_name}`,
                    avatar: this.transaction.client.avatar,
                });
            }
        },

        computed: {
            hasErrors() {
                return this.errors && this.errors.length > 0;
            }
        },
        methods: {
            onSearch(search, loading) {
                loading(true);
                axios
                    .get(`/clients/search/${search}`)
                    .then(res => {
                       loading(false);
                       this.clients = res.data;
                    });
            },
            setSelected(value) {
                if (value) {
                    this.formData.client_id = value.code;
                    this.selected = value;
                } else {
                    this.selected = null;
                    this.formData.client_id = null;
                }
            }
        }
    }
</script>

<style scoped>

</style>
