<template>
    <nav class="navbar navbar-expand-md navbar-dark warning-color-dark shadow-sm">
        <div class="container-fluid">
            <router-link class="navbar-brand" to="/">
                {{ $t('website_name') }}
            </router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/stats">{{ $t('dashboard') }}</router-link>
                    </li>
                </ul>

                <div class="locale-changer">
                    <select class="custom-select" v-model="$i18n.locale" @change="setLang($event)">
                        <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">{{ lang }}</option>
                    </select>
                </div>
                <!-- Right Side Of Navbar -->
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log(this.$store.getters.getAppLanguage)
        },

        data() {
            return {
                langs: ['en', 'ar']
            }
        },

        methods: {
            setLang(event) {
                console.log(event.target.value)
                this.$store.commit('setAppLanguage', event.target.value)
            }
        }
    }

</script>

<style>

</style>
