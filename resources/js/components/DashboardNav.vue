<template>
    <div id="main" class="container mt-3 pt-2 pb-2 elegant-color">
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark warning-color-dark m-2">

            <!-- Navbar brand -->
            <span class="navbar-brand" href="#">{{ $t('dashboard') }}</span>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav m-auto text-center">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/stats">
                            {{ $t('stats') }} <i class="fas fa-chart-bar"></i>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/dashboard/database">
                            {{ $t('database') }}<i class="fas fa-cog"></i>
                        </router-link>
                    </li>
                </ul>
                <!-- Links -->
            </div>
            <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {

    }

</script>
