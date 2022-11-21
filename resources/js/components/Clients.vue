<template>
    <div>
        <h1 class="text-3xl text-center font-bold">Clients</h1>
        <div class="pl-8 py-2 -px-2 overflow-auto relative">
            <a href="/clients/create">
                <button class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Create New Client</button>
            </a>
        </div>
        <div class="flex flex-row justify-center items-center ">
            <div style="width: 20%" v-show="!!this.message" class="rounded-md text-center bg-green-300 p-2 alert alert-success">
                <span >{{this.message}}</span>
            </div>
        </div>
        <div id="clients" class="p-2 overflow-auto relative">
            <table class="table-auto shadow-lg bg-white">
                <thead class="bg-gray-100">
                    <th class="text-left px-8 py-4">ID</th>
                    <th class="text-left px-8 py-4">First Name</th>
                    <th class="text-left px-8 py-4">Last Name</th>
                    <th class="text-left px-8 py-4">Email</th>
                    <th class="text-left px-8 py-4">Created At</th>
                    <th class="text-left px-8 py-4">Updated At</th>
                    <th class="text-right py-4">Actions</th>
                    <th class="text-left py-4"></th>
                    <th class="text-left py-4"></th>
                </thead>
                <tbody>
                    <tr class="hover:bg-stone-100" v-for="client in this.clients">
                        <td class="text-left px-8 py-4 ">{{client.id}}</td>
                        <td class="text-left px-8 py-4 ">{{client.first_name}}</td>
                        <td class="text-left px-8 py-4 ">{{client.last_name}}</td>
                        <td class="text-left px-8 py-4 ">{{client.email}}</td>
                        <td class="text-left px-8 py-4 ">{{client.created_at}}</td>
                        <td class="text-left px-8 py-4 ">{{client.updated_at}}</td>
                        <td class="text-left">
                            <a :href="this.clientShowUrl(client.id)">
                                <button class="text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Show</button>
                            </a>
                        </td>
                        <td class="text-left">
                            <a :href="this.clientEditUrl(client.id)">
                                <button class="text-white bg-orange-300 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</button>
                            </a>
                        </td>
                        <td class="text-left">
                            <button class="text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" @click="deleteClient(client.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="pl-8 py-2 px-2  overflow-auto relative">
                <span class="page-stats">
                   {{this.pageStats}}
                </span>
            </div>
            <div class="pl-8 py-2 px-2 overflow-auto relative">
                <button @click="prevPage()" v-if="this.previousPageExists"
                        class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                > Prev </button>
                <button class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" v-else disabled> Prev </button>
                <button @click="nextPage()" v-if="this.nextPageExists"
                        class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                > Prev </button>
                <button class="text-white bg-blue-400 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" v-else disabled> Next </button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Clients",
    data: function(){
        return {
            clients: [],
            totalItems: 0,
            currentPage: 1,
            message: null
        }
    },
    methods: {
        getClients(){
            let page = this.currentPage ?? 1;
            this.message = null;
            axios.get('client-data?pageNumber='+page).then(response => {
                console.log(response.data);
                this.clients = response.data.clients;
                this.totalItems = response.data.total;
            })
        },
        deleteClient(id) {
            axios.delete(`/clients/${id}`).then(() => {
                this.getClients();
                this.message = 'Client deleted!'
            }).catch(() => {
            });
        },
        nextPage(){
            this.currentPage++;
            this.getClients();
        },
        prevPage(){
            this.currentPage--;
            this.getClients();
        },
        clientShowUrl($clientId){
            return '/clients/'+$clientId;
        },
        clientEditUrl($clientId){
            return '/clients/'+$clientId+'/edit'
        },
        clientDeleteUrl($clientId){
            return '/clients/'.$clientId;
        }
    },
    computed: {
        previousPageExists(){
            return this.currentPage !== 1;
        },
        nextPageExists(){
            return (this.currentPage * 10) < this.totalItems;
        },
        pageStats(){
            if (this.totalItems < 10){
                return this.totalItems+" out of "+this.totalItems;
            }

            let startNumber = (this.currentPage -1) * 10;
            let upperRange = this.currentPage * 10;
            let endNumber = upperRange > this.totalItems ? this.totalItems : upperRange;

            return startNumber+"-"+endNumber+" out of "+this.totalItems;
        }
    },
    mounted() {
        this.getClients();
    }
}

</script>

<style scoped>
    table {
        width: 100%;
    }
</style>
