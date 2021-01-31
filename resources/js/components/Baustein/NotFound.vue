<template>
    <div class="notFound">
        <h3>404 - Not Found</h3>
        <p>Die gesuchte Seite existiert nicht.</p>
        <button type="button" class="btn btn-success" @click="toIndex">Weiter zum Index</button>
    </div>
</template>

<script>
export default {
    methods: {
        toIndex(){
            this.$router.push({name: 'AlleBausteine', params: { page: 1}});
        }
    }
}
</script>
<style scoped>
.notFound {
    text-align: center;
}
</style>