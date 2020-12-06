<template>
    <div class="button-link">
        <a class="btn btn-primary btn-large" :href="route" role="button"><slot></slot></a>
    </div>
</template>

<script>
    export default {
        props: [
            'route'
        ],

        data: function(){
            return {
                
            }
        },

        mounted() {
            
        },

        methods: {
            

        },

        computed: {
            
        }
    }
</script>

<style scoped>
    .button-link {
        padding-top: 10px;
        text-align: center;
        width: auto;
    }
</style>
