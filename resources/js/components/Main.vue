<template>
    <div class="container pt-3 pb-3">
        <div class="elegant-color z-depth-3 mb-3">
            <div class="card-body text-white pb-1">
                <form class="row align-items-center justify-content-center" action="#" method="post">
                    <div class="col-md form-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Venue name"
                            v-model="search">
                    </div>
                    <div class="col-md form-group">
                        <select v-model="select.states" class="browser-default custom-select custom-select-sm">
                            <option value="1">Choose state</option>
                            <option v-for="state in states" :key="state.id" :value="state.id">{{ state.state_name }}</option>
                        </select>
                    </div>
                    <div class="col-md form-group">
                        <select v-model="select.cities" class="browser-default custom-select custom-select-sm">
                            <option value="1">Choose city</option>
                            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.city_name }}</option>
                        </select>
                    </div>
                    <div class="col-md form-group">
                        <button class="btn btn-sm btn-amber float-right">Search!</button>
                    </div>
                </form>
            </div>
        </div>
        <div v-for="venue in filterVenue" :key="venue.id" class="elegant-color z-depth-2 mb-3" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
            <div class="card-body row text-white">
                <div class="col-md my-auto">
                    <div class="m-1 border border-warning view overly zoom">
                        <img class="img-fluid" src="images/img1.jpg" alt="">
                    </div>
                </div>
                <div class="col-md d-flex flex-column">
                    <div class="flex-even d-flex flex-column justify-content-around pr-2 pl-2 pt-2 mr-1 ml-1 mt-1">
                        <h1 class="page-title">{{ venue.venue_name }}</h1>
                        <table class="table table-sm m-0 table-borderless text-white-50" :class="$i18n.locale === 'ar' ? 'text-right' : 'text-left'" dir="ltr">
                            <tbody>
                                <th class="h5   ">
                                    <i class="fa fa-user mr-2" aria-hidden="true"></i>250
                                </th>
                                <th class="h5">
                                    <i class="fas fa-chair mr-2" aria-hidden="true"></i>{{ venue.venue_service.guests }}
                                </th>
                                <th class="h5">
                                    <i class="fa fa-phone mr-2" aria-hidden="true"></i>{{ venue.contact.phone1 }}
                                </th>
                            </tbody>
                        </table>
                    </div>
                    <hr class="mr-1 ml-1">
                    <div class="flex-even d-flex flex-column justify-content-around p-2 m-1">
                        <p class="h5 text-break" :class="$i18n.locale === 'ar' ? 'text-right' : 'text-left'">{{ limitText(venue.venue_desc) }}</p>
                        <span>
                            <router-link class="btn btn-amber" :class="$i18n.locale === 'ar' ? 'float-left' : 'float-right'" :to="{ path: '/venue/' + venue.id}">{{ $t('read_more') }}</router-link>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- pagination start -->
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
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Main component loaded.');
        },

        data() {
            return {
                venues: [],
                links: [],
                meta: [],
                search: '',

                //Select variables
                select: {
                    states: "1",
                    cities: "1"
                },

                states: [],
                cities: []
            }
        },

        computed: {
            filterVenue() {
                return this.venues.filter(ven => {
                    return ven.venue_name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            }
        },

        created() {
            this.getVenues();
            this.loadStates();
        },

        watch: {
            'select.states': function (value) {
                axios
                    .get('api/cities/' + value)
                    .then(response => {
                        this.cities = response.data.data,
                        this.select.cities = 1

                    })
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

            limitText(text) {
                let vtext = text.length > 80 ? text.substring(0, 80) + '...' : text
                return vtext
            },

            loadStates() {
                axios
                    .get('api/states')
                    .then(response => {
                        this.states = response.data.data
                    })
            }
        }
    }

</script>

<style>
    body {
        background: #1e2021 !important;
    }

</style>
