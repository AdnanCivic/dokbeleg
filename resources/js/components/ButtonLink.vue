<template>
    <a class="btn btn-primary btn-large button-link" :href="route" role="button"><slot></slot></a>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                
            }
        }
            
    }
</script>

<style scoped>
    .button-link {
        text-align: center;
        width: 100%;
        margin-top: 10px;
    }
</style>
