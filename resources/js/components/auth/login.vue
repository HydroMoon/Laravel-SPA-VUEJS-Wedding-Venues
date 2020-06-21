<template>
    <div class="container pt-3 pb-3">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5 mb-5">
                <div class="card-body elegant-color z-depth-3 text-white">
                    <div class="row justify-content-center">
                        <div class="col-md text-center">
                            <img class="ic" src="images/icon.png   " alt="">
                        </div>
                    </div>
                    <form>
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10 text-right form-check">

                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10 text-right">
                                <button class="btn btn-amber">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }

</script>

<style scoped>
    .ic {
        height: 100px;
        width: 100px;
        margin: 0.75rem;
    }
</style>
