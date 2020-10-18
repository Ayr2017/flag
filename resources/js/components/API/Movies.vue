<template>
    <v-app>
        <v-container>
        <v-row>
            <MoviesTable />
        </v-row>
        </v-container>
    </v-app>
</template>

<script>
import MoviesTable from './MoviesComponents/MoviesTable.vue'
import axios from 'axios';
export default {
    components: {MoviesTable},
    beforeMount(){
        this.getMovies();
    },
    methods:{
        getMovies(){
            axios.get('/api/movies/?amount=3').then(response => console.log(response));
        }
    },
}
</script>