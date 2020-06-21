<template>
    <div class="container pt-3 pb-3" :class="$i18n.locale === 'ar' ? 'text-right' : ''" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
        <div class="elegant-color z-depth-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8 mx-auto my-auto">
                        <div class="m-1 border border-warning view overly zoom my-slider">
                            <img class="img-fluid" src="http://localhost:8000/images/img1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 my-auto">
                        <h5 class="text-white mt-2">{{ $t('features') }}</h5>
                        <table class="table table-sm m-0 table-borderless text-warning">
                            <tbody>
                                <tr>
                                    <td class="h6">
                                        <i :class="{'fa-times-circle' : vservice.photography === 0, 'fa-check-circle' : vservice.photography === 1, 'ml-2' : $i18n.locale === 'ar'}"
                                            class="fa mr-2" aria-hidden="true"></i>{{ $t('photography') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="h6">
                                        <i :class="{'fa-times-circle' : vservice.videography === 0, 'fa-check-circle' : vservice.videography === 1, 'ml-2' : $i18n.locale === 'ar'}"
                                            class="fa mr-2" aria-hidden="true"></i>{{ $t('videography') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6">
                                        <i :class="{'fa-times-circle' : vservice.organize_team === 0, 'fa-check-circle' : vservice.organize_team === 1, 'ml-2' : $i18n.locale === 'ar'}"
                                            class="fa mr-2" aria-hidden="true"></i>{{ $t('organize_team') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6">
                                        <i :class="{'fa-times-circle' : vservice.jirtg === 0, 'fa-check-circle' : vservice.jirtg === 1, 'ml-2' : $i18n.locale === 'ar'}"
                                            class="fa mr-2" aria-hidden="true"></i>{{ $t('jirtg') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6">
                                        <i :class="{'fa-times-circle' : vservice.overnight === 0, 'fa-check-circle' : vservice.overnight === 1, 'ml-2' : $i18n.locale === 'ar'}"
                                            class="fa mr-2" aria-hidden="true"></i>{{ $t('overnight') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h6">
                                        <i class="fa fa-user-circle mr-2" :class="{'ml-2' : $i18n.locale === 'ar'}" aria-hidden="true"></i>{{ vservice.guests }}
                                        {{ $t('guests') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md">
                        <h5 class="page-title text-white d-lg-inline">
                            {{ venue.venue_name }}
                        </h5>
                        <h6 class="text-warning align-bottom" :class="$i18n.locale === 'ar' ? 'float-left' : 'float-right'">{{ venue.location.location_name }}</h6>
                        <p class="text-white text-break mt-2">{{ venue.venue_desc }}</p>
                    </div>
                </div>
                <div class="mr-3 ml-3 text-left" dir="ltr">
                    <div class="card-body bgc row align-items-center justify-content-around">
                        <div class="col-md mt-1 mb-1 text-white">
                            <a class="btn btn-amber btn-block">
                               {{ $t('contact_us') }}
                            </a>
                        </div>
                        <div class="col-md text-white-50 h6">
                            <i class="fa fa-user mt-1 mb-1 mr-2 d-inline" aria-hidden="true"></i>{{ vcontact.name }}
                        </div>
                        <div class="col-md text-white-50 h6">
                            <i class="fa fa-phone mt-1 mb-1 mr-2 d-inline" aria-hidden="true"></i>{{ vcontact.phone1 }}
                        </div>
                        <div class="col-md text-white-50 h6">
                            <i class="fa fa-envelope mt-1 mb-1 mr-2 d-inline" aria-hidden="true"></i>{{ vcontact.email }}
                        </div>
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
                venue: [],
                vservice: [],
                vcontact: []
            }
        },

        created() {
            this.loadVenue('http://localhost:8000/api/venues/' + this.$route.params.id);
        },

        methods: {
            loadVenue(url) {
                axios
                    .get(url)
                    .then(response => {
                        this.venue = response.data.data[0],
                            this.vservice = this.venue.venue_service,
                            this.vcontact = this.venue.contact
                    });
            }
        }
    }

</script>

<style>
    .bgc {
        background: #1e2021
    }

</style>
