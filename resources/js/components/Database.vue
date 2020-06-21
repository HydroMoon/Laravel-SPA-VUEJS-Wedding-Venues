<template>
        <div class="card-body text-white bgc m-2">
            <form>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="">Venue name</label>
                            <input type="text" class="form-control" v-model="venue_info.venue_name">
                        </div>
                        <div class="form-group">
                            <label for="">Venue description</label>
                            <textarea cols="30" rows="2" class="form-control"
                                v-model="venue_info.venue_desc"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Location</label>
                            <!-- <select class="custom-select" v-model="location_id">
                                <option value=""></option>
                            </select> -->
                            <input type="text" class="form-control" v-model="venue_info.location_id">

                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="">Contact name</label>
                            <input type="text" class="form-control" v-model="contact.name">
                        </div>
                        <div class="form-group">
                            <label for="">Contact phone</label>
                            <input type="text" class="form-control" v-model="contact.phone1">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" v-model="contact.email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="defaultInline1"
                            v-model="venue_service.photography">
                        <label class="custom-control-label" for="defaultInline1">Photography</label>
                    </div>
                    <div class="col-md custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="defaultInline2"
                            v-model="venue_service.videography">
                        <label class="custom-control-label" for="defaultInline2">Videography</label>
                    </div>
                    <div class="col-md custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="defaultInline3"
                            v-model="venue_service.organize_team">
                        <label class="custom-control-label" for="defaultInline3">Organizeing Team</label>
                    </div>
                    <div class="col-md custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="defaultInline4"
                            v-model="venue_service.overnight">
                        <label class="custom-control-label" for="defaultInline4">Overnight</label>
                    </div>
                    <div class="col-md custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="defaultInline5"
                            v-model="venue_service.jirtg">
                        <label class="custom-control-label" for="defaultInline5">Jirtg</label>
                    </div>
                    <div class="col-md">
                        <label for="">Guests</label>
                        <input type="text" class="form-control" v-model="venue_service.guests">
                    </div>
                </div>
                <button v-if="show_save" class="btn btn-secondary" @click.prevent="saveVenue()">Submit</button>
                <button v-else class="btn btn-secondary" @click.prevent="updateVenue()">Update</button>
            </form>
        </div>
</template>

<script>        
    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data() {
            return {
                venue_info: {},
                venue_service: {
                    photography: false,
                    videography: false,
                    organize_team: false,
                    overnight: false,
                    jirtg: false
                },
                contact: {},
                edit_id: '',
                show_save: true
            }
        },

        created() {
            this.loadEdit(this.$route.params.v_id);
        },

        methods: {
            saveVenue() {
                axios
                    .post('http://localhost:8000/api/venues', {
                        venue_info: this.venue_info,
                        venue_service: this.venue_service,
                        contact: this.contact
                    })
                    .then(response => {
                        console.log(response)
                    });
            },

            updateVenue() {
                axios
                    .patch('http://localhost:8000/api/venues/' + this.edit_id, {
                        venue_info: this.venue_info,
                        venue_service: this.venue_service,
                        contact: this.contact
                    })
                    .then(response => {
                        console.log(response)
                    });
            },

            loadEdit(v_id) {
                if (v_id) {
                    axios
                    .get('http://localhost:8000/api/venues/' + v_id)
                    .then(response => {
                        this.venue_info = {
                            venue_name: response.data.data[0].venue_name,
                            venue_desc: response.data.data[0].venue_desc,
                            location_id: response.data.data[0].location_id
                        },
                        this.venue_service = response.data.data[0].venue_service,
                        this.contact = response.data.data[0].contact,
                        this.edit_id = response.data.data[0].id,
                        this.show_save = false,
                        console.log(this.venue_info)
                    });
                }
            }
        }
    }

</script>

<style scoped>
    .bgc {
        background: #1e2021
    }

</style>
