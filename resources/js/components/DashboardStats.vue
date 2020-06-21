<template>
    <div>
        <div v-for="index in 3" :key="index" class="row d-flex justify-content-around m-1">
            <div class="d-flex justify-center align-items-center col-lg shadow bgc m-1">
                <div class="flex-grow-1 m-3 p-3 text-white">
                    <h4 class="h4 font-weight-bolder">{{ venues_count }}</h4>
                    <span class="h5">Venues</span>
                </div>
                <div class="flex-grow-1 m-3 p-3 text-white text-right text-right align-middle">
                    <span><i class="fas fa-home fa-4x"></i></span>
                </div>
            </div>
            <router-link class="d-flex justify-center align-items-center col-lg shadow bgc m-1" to="/dashboard/database">
                <div class="flex-fill m-3 p-3 text-white">
                    <span class="h5">Database</span>
                </div>
                <div class="flex-fill m-3 p-3 text-white text-right align-middle">
                    <span><i class="fas fa-cog fa-4x"></i></span>
                </div>
            </router-link>
            <div class="d-flex justify-center align-items-center col-lg shadow bgc m-1">
                <div class="flex-fill m-3 p-3 text-white">
                    <h4 class="h4 font-weight-bolder">4.5/10 GB</h4>
                    <span class="h5">Space used</span>
                </div>
                <div class="flex-fill m-3 p-3 text-white text-right align-middle">
                    <span><i class="fas fa-folder fa-4x"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                venues_count: ''
            }
        },

        created() {
           this.getVenuesCount();
        },

        methods: {
            getVenuesCount() {
                axios
                    .get('http://localhost:8000/api/vcount')
                    .then(response => {
                        this.venues_count = response.data;
                    })
            }
        }
    }
</script>
