<template>
    <div id="main">
        <div class="pt-2 pl-3 pr-3">
            <Header />
        </div>
        <transition name="fade">
            <router-view />
        </transition>
        <div class="pb-2 pl-3 pr-3">
            <Footer />
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    import Header from './Header.vue';
    import Footer from './Footer.vue';

    export default {
        name: 'main-app',
        components: {
            Header,
            Footer
        },

        mounted() {
            //  [App.vue specific] When App.vue is finish loading finish the progress bar
            this.$Progress.finish()
        },

        created() {
            //  [App.vue specific] When App.vue is first loaded start the progress bar
            this.$Progress.start()
            //  hook the progress bar to start before we move router-view
            this.$router.beforeEach((to, from, next) => {
                //  does the page we want to go to have a meta.progress object
                if (to.meta.progress !== undefined) {
                    let meta = to.meta.progress
                    // parse meta tags
                    this.$Progress.parseMeta(meta)
                }
                //  start the progress bar
                this.$Progress.start()
                //  continue to next page
                next()
            })
            //  hook the progress bar to finish after we've finished moving router-view
            this.$router.afterEach((to, from) => {
                //  finish the progress bar
                this.$Progress.finish()
            })
        }
    }

</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .1s;
    }

    .fade-enter,
    .fade-leave-to

    /* .fade-leave-active below version 2.1.8 */
        {
        opacity: 0;
    }

</style>
