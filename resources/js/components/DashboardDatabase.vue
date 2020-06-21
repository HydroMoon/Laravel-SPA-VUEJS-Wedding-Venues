<template>
    <div>
        <div class="ml-2 mr-2 mt-2">
            <div class="table-responsive table-editable">
                <table class="table table-striped table-dark table-hover text-white"
                    :class="$i18n.locale === 'ar' ? 'text-right' : ''" :dir="$i18n.locale === 'ar' ? 'rtl' : ''">
                    <thead class="special-color-dark">
                        <th class="align-middle">{{ $t('venue_name') }}</th>
                        <th class="align-middle">{{ $t('venue_description') }}</th>
                        <th class="align-middle">{{ $t('venue_location') }}</th>
                        <th class="align-middle" :class="$i18n.locale === 'ar' ? 'text-left' : 'text-right'"
                            colspan="2"><a data-toggle="collapse" href="#collapseAdd" aria-expanded="false"><i
                                    class="fa fa-plus-circle fa-2x green-text" aria-hidden="true"></i></a>
                            <a @click="saveVenue()" data-toggle="collapse" href="#collapseAdd" aria-expanded="false"><i
                                    class="fa fa-check-circle fa-2x red-text" aria-hidden="true"></i></a></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-0" colspan="5">
                                <div class="collapse p-3" id="collapseAdd">

                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="">{{ $t('venue_name') }}</label>
                                                <input type="text" class="form-control" v-model="venue_info.venue_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ $t('venue_description') }}</label>
                                                <textarea cols="30" rows="2" class="form-control"
                                                    v-model="venue_info.venue_desc"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ $t('location') }}</label>
                                                <!-- <input type="text" class="form-control"
                                                    v-model="venue_info.location_id"> -->
                                                <a @click="loadLocation()" class="btn btn-default btn-block"
                                                    data-toggle="modal" data-target="#locationModal">
                                                    {{ location_button }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label for="">{{ $t('contact_name') }}</label>
                                                <input type="text" class="form-control" v-model="contact_info.name">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ $t('contact_phone') }}</label>
                                                <input type="text" class="form-control" v-model="contact_info.phone1">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{ $t('contact_email') }}</label>
                                                <input type="text" class="form-control" v-model="contact_info.email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="defaultInline1"
                                                v-model="venue_service.photography">
                                            <label class="custom-control-label"
                                                for="defaultInline1">{{ $t('photography') }}</label>
                                        </div>
                                        <div class="col-md custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="defaultInline2"
                                                v-model="venue_service.videography">
                                            <label class="custom-control-label"
                                                for="defaultInline2">{{ $t('videography') }}</label>
                                        </div>
                                        <div class="col-md custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="defaultInline3"
                                                v-model="venue_service.organize_team">
                                            <label class="custom-control-label"
                                                for="defaultInline3">{{ $t('organize_team') }}</label>
                                        </div>
                                        <div class="col-md custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="defaultInline4"
                                                v-model="venue_service.overnight">
                                            <label class="custom-control-label"
                                                for="defaultInline4">{{ $t('overnight') }}</label>
                                        </div>
                                        <div class="col-md custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="defaultInline5"
                                                v-model="venue_service.jirtg">
                                            <label class="custom-control-label"
                                                for="defaultInline5">{{ $t('jirtg') }}</label>
                                        </div>
                                        <div class="col-md">
                                            <label class="" for="">{{ $t('guests') }}</label>
                                            <input type="text" class="form-control" v-model="venue_service.guests">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <template v-for="(venue, key) in venues">
                            <tr v-bind:key="'main' + venue.id">
                                <td v-if="venue.selected"><input type="text" v-model="venue.venue_name"
                                        class="form-control"></td>
                                <td v-else :contenteditable="venue.selected ? 'true' : 'false'">{{ venue.venue_name }}
                                </td>

                                <td v-if="venue.selected"><textarea v-model="venue.venue_desc" cols="30" rows="10"
                                        class=""></textarea></td>
                                <td v-else :contenteditable="venue.selected ? 'true' : 'false'">
                                    {{ limitText(venue.venue_desc) }}</td>

                                <td v-if="venue.selected">
                                    <a @click="loadModal(venue.venue_name, key)"
                                        class="btn btn-default d-table-cell btn-sm" data-toggle="modal"
                                        data-target="#locationModal">
                                        {{ venue.location.location_name }}
                                    </a></td>
                                <td v-else :contenteditable="venue.selected ? 'true' : 'false'">
                                    {{ venue.location.location_name }}
                                </td>

                                <!-- <td>
                                <router-link :to="{ path: 'database/edit/' + venue.id}" class="btn btn-default btn-sm">
                                    Edit</router-link>
                            </td> -->
                                <td><a v-if="venue.selected" @click.prevent="updateVenue(venue.id, key)"
                                        class="btn btn-success btn-sm" data-toggle="collapse"
                                        :href="'#collapse' + getOverallIndex(key)"
                                        aria-expanded="false">{{ $t('save') }}</a>
                                    <a v-else @click.prevent="changeEdit(key)" class="btn btn-default btn-sm"
                                        data-toggle="collapse" :href="'#collapse' + getOverallIndex(key)"
                                        aria-expanded="false">{{ $t('edit_venue') }}</a></td>

                                <td><a @click.prevent="deleteVenue(venue.id)"
                                        class="btn btn-danger btn-sm">{{ $t('delete_venue') }}</a>
                                </td>
                            </tr>
                            <tr v-bind:key="'extra' + venue.id">
                                <td class="p-0" colspan="5">
                                    <div class="collapse" :id="'collapse' + getOverallIndex(key)">
                                        <div class="m-2">
                                            <!-- Extra start -->
                                            <div class="d-flex flex-row justify-content-around align-self-center">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'checkPhoto' + venue.id"
                                                        v-model="venue.venue_service.photography">
                                                    <label class="custom-control-label"
                                                        :for="'checkPhoto' + venue.id">{{ $t('photography') }}</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'checkVideo' + venue.id"
                                                        v-model="venue.venue_service.videography">
                                                    <label class="custom-control-label"
                                                        :for="'checkVideo' + venue.id">{{ $t('videography') }}</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'checkOrganize' + venue.id"
                                                        v-model="venue.venue_service.organize_team">
                                                    <label class="custom-control-label"
                                                        :for="'checkOrganize' + venue.id">{{ $t('organize_team') }}</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'checkOver' + venue.id"
                                                        v-model="venue.venue_service.overnight">
                                                    <label class="custom-control-label"
                                                        :for="'checkOver' + venue.id">{{ $t('overnight') }}</label>
                                                </div>
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input"
                                                        :id="'checkJirtg' + venue.id"
                                                        v-model="venue.venue_service.jirtg">
                                                    <label class="custom-control-label"
                                                        :for="'checkJirtg' + venue.id">{{ $t('jirtg') }}</label>
                                                </div>
                                                <div class="custom-control-inline">
                                                    <label for="">{{ $t('guests') }}</label>
                                                    <input type="text" class="form-control"
                                                        v-model="venue.venue_service.guests">
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <label for="">{{ $t('contact_name') }}</label>
                                                    <input type="text" class="form-control"
                                                        v-model="venue.contact.name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{ $t('contact_phone') }}</label>
                                                    <input type="text" class="form-control"
                                                        v-model="venue.contact.phone1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{ $t('contact_email') }}</label>
                                                    <input type="text" class="form-control"
                                                        v-model="venue.contact.email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Pagination start-->
        <div class="ml-2 mr-2 mb-2">
            <ul class="pagination warning-color-dark justify-content-center">
                <li class="page-item" :class="{'disabled' : !links.prev}" @click.prevent="getVenues(links.prev)">
                    <a class="page-link text-white" tabindex="-1">{{ $t('previous') }}</a>
                </li>
                <li class="page-item">
                    <a class="page-link disabled text-white">{{ meta.current_page }} of {{ meta.last_page }}
                        {{ $t('element_pagination') }}</a>
                </li>
                <li class="page-item" :class="{'disabled' : !links.next}" @click.prevent="getVenues(links.next)">
                    <a class="page-link text-white">{{ $t('next') }}</a>
                </li>
            </ul>
        </div>
        <!-- Pagination end -->


        <!-- Modal testing dynamically -->
        <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md form-group">
                                <select v-model="select.states" class="browser-default custom-select custom-select-sm">
                                    <option value="1">Choose state</option>
                                    <option v-for="state in states" :key="state.id" :value="state">
                                        {{ state.state_name }}</option>
                                </select>
                            </div>
                            <div class="col-md form-group">
                                <select v-model="select.cities" class="browser-default custom-select custom-select-sm">
                                    <option value="1">Choose city</option>
                                    <option v-for="(city, index) in cities" :key="city.id"
                                        :value="{ id: city.id, city_name: city.city_name, index}">{{ city.city_name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md form-group">
                                <select v-if="!loc_add" v-model="select.locations"
                                    class="browser-default custom-select custom-select-sm">
                                    <option value="1">Choose location</option>
                                    <option v-for="location in locations" :key="location.id" :value="location">
                                        {{ location.location_name }}
                                    </option>
                                </select>
                                <input v-else v-model="new_location.location_name" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-if="!loc_add" @click="saveModal(select.locations.location_name)" type="button"
                            class="btn btn-primary" data-dismiss="modal">Save
                            changes</button>
                        <button v-else @click="new_location.city_id = select.cities.id" type="button"
                            class="btn btn-primary" data-dismiss="modal">Save
                            changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },

        data() {
            return {
                venues: [],
                links: [],
                meta: [],

                venue_info: {},
                contact_info: {},
                venue_service: {
                    photography: false,
                    videography: false,
                    organize_team: false,
                    overnight: false,
                    jirtg: false
                },

                //modal
                modal_message: '',
                modal_key: '',

                //Select location change
                select: {
                    states: "1",
                    cities: "1",
                    locations: '1'
                },

                states: [],
                cities: [],
                locations: [],
                location_id: '',

                //adding new location var
                new_location: {
                    location_name: '',
                    city_id: ''
                },

                location_button: 'Choose/add location',
                loc_add: false
            }
        },

        created() {
            this.getVenues();
            this.loadStates();
        },

        watch: {
            'select.states': function (value) {
                axios
                    .get('http://localhost:8000/api/cities/' + value.id)
                    .then(response => {
                        this.cities = response.data.data
                    })
            },

            'select.cities': function (value) {
                this.locations = this.cities[value.index].locations
            }
        },

        methods: {
            getVenues(page_url) {
                page_url = page_url || 'http://localhost:8000/api/venues'
                axios
                    .get(page_url)
                    .then(response => {
                        this.venues = response.data.data,
                            this.links = response.data.links,
                            this.meta = response.data.meta
                    });
            },

            //saving new venue + location(new)
            saveVenue() {
                axios
                    .post('http://localhost:8000/api/venues', {
                        venue_info: this.venue_info,
                        venue_service: this.venue_service,
                        contact: this.contact_info,
                        location: this.new_location
                    })
                    .then(response => {
                        console.log(response)
                    });
            },

            updateVenue(id, key) {
                axios
                    .patch('http://localhost:8000/api/venues/' + id, {
                        venue_info: {
                            venue_name: this.venues[key].venue_name,
                            venue_desc: this.venues[key].venue_desc,
                            location_id: this.select.locations.id
                        },
                        venue_service: this.venues[key].venue_service,
                        contact: this.venues[key].contact
                    })
                    .then(response => {
                        console.log(response)
                        this.$toasted.show("Updated successfully!", {
                            theme: "bubble",
                            position: "top-center",
                            icon: {
                                name: 'check-circle',
                                after: false
                            },
                            type: 'success',
                            duration: 2000
                        });
                        this.changeEdit(key)
                    });
            },

            deleteVenue(id) {
                axios
                    .delete('http://localhost:8000/api/venues/' + id)
                    .then(response => {
                        this.getVenues();
                        this.$toasted.show("Deleted successfully!", {
                            theme: "bubble",
                            position: "top-center",
                            icon: {
                                name: 'check-circle',
                                after: false
                            },
                            type: 'info',
                            duration: 2000
                        });
                    });
            },

            //Chnage edit mode
            changeEdit(key) {
                if (this.venues[key].selected) {
                    this.venues[key].selected = false;
                } else {
                    this.venues[key].selected = true;
                }
            },

            limitText(text) {
                let vtext = text.length > 30 ? text.substring(0, 20) + '...' : text
                return vtext
            },

            getOverallIndex(index) {
                return (this.meta.current_page * 5) - 5 + index
            },

            //Modal
            loadModal(data, key) {
                this.loc_add = false
                this.modal_message = data
                this.modal_key = key
            },

            saveModal(data) {
                this.venues[this.modal_key].location.location_name = data
            },

            loadStates() {
                axios
                    .get('http://localhost:8000/api/states')
                    .then(response => {
                        this.states = response.data.data
                    })
            },

            //load location for adding new location
            loadLocation() {
                this.loc_add = true

            }
        }
    }

</script>
