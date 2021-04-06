<template>
    <transition name="fade" appear>
        <div class="card" >
            <div class="card-header"><h3>Home</h3></div>
            <div class="card-body">
                <div v-if="!loaded">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status"></div>
                    </div>
                </div>
                <p><b>Name:</b>&nbsp; {{ user.name }}</p>
                <p><b>Email:</b>&nbsp; {{ user.email }}</p>
                
                <div v-if="error" class="error">
                    <p>{{ error.message }}</p>
                    <p><button class="btn btn-success" @click="reloadComponent">Erneut versuchen</button></p>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

export default {
    data(){
        return {
            user: {},
            loaded: false,
            error: null
        }
    },

    mounted(){
        axios.get('/api/v1/user')
            .then((response) => {
                this.user = response.data;
                this.loaded = true;
            })
            .catch((error) => {
                this.error = error.response.data;
                this.loaded = true;
            });
    },

    methods: {
        reloadComponent(){
            window.location.reload();
        },
    },
     
}
</script>

<style>

.error {
    text-align: center;
    color: red;
}

.card-header {
    text-align: center;
}

#buttons {
    text-align: center;
}

.label {
color: blue;
}

.fade-enter-active, .fade-leave-active{
    transition: opacity .3s ease-in;
}

.fade-enter, .fade-leave-to{
    opacity: 0;
}

</style>