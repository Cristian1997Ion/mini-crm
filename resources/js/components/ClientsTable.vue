<template>
    <table class="table table-striped">
        <thead class="thead-dark">
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
                    :href="`/clients/edit&id=${client.id}`"
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
                />
            </td>
        </tr>
        </tbody>
    </table>
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

        mounted() {
        }
    }
</script>

<style scoped>

</style>
