<template>
    <div>
        
        <div class="empezar">
            <br>
                <section class="textos-evento">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center">
                            <h1>
                                YA ESTÁS LISTO PARA COMENZAR
                            </h1>
                            <h3>
                                <a href="/login">DA CLICK AQUÍ PARA INICIAR SESIÓN</a>
                            </h3>

                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12"></div>
                    </div>
                </section>
        </div>

    </div>
</template>

<script>

    import VueEvents from 'vue-events'
    Vue.use(VueEvents)

    export default {
        props:['guest', 'auth'],
        components: {
        },
        data() {
            return {
                
            }
        },
        created() {
            this.ruta = window.location.pathname;
            let res = this.ruta.split("/");
            axios.post('/email/verify', {
                user: res[2],
            }).then(res => {
                this.$events.fire('filter-reset');
                this.$snotify.success(res.data.message, 'Correcto', {
                    timeout: 4000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true
                });

            }).catch(error => {
                this.$snotify.error(error.response.data.message, 'Incorrecto', {
                    timeout: 4000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true
                });
                this.data_errors = error.response.data.errors;
            });

        },
        computed: {

        },
        methods: {

        },

        mounted() {
        },

    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/_variables';

    .textos-evento{
        height: 100vh;
        width: 100%;
        padding: 130px 50px 0px 50px !important;

        h1{
            text-shadow: 10px 20px 30px #000;
            font-size: 50px;
            color:rgb(240, 208, 26);
            font-weight: bold;
            font-family: bignoodletitling;
        }

        h3{
            text-shadow: 10px 20px 30px #000;
            font-size: 50px;
            color:#fff;
            font-weight: bold;
            font-family: bignoodletitling;
            a{
                color:#fff !important;
            }

        }

        hr.line-evento {
            box-shadow: 10px 20px 30px #000;
            width: 100%;
            border: 4px solid #fff;

        }

        .card-eat{
            box-shadow: 10px 20px 30px #000;
            border-radius:15px !important;
        }

    }
</style>