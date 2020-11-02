<template>
    <main class="container" style="padding-top:70px;">
        <!-- <div><a class="btn btn-primary btn-large" href="{{ route('home') }}">Zurück</a></div> -->
        <div class="card">
            <div class="card-header"  style="text-align:center"><h3>Verfügbare Bausteine</h3></div>
            <div class="card-body">
                <table class="table">
                    <tr><th>Name</th><th>ID</th><th>Nummer</th><th style="text-align: center">Aktion</th></tr>

                </table>
            </div>
        </div>     
    </main>
</template>

<script>
    export default {
        data: function(){
            return {
                bausteine: [],
            }
        }
    }
</script>
