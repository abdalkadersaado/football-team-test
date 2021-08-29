<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Standings Table</h1>

                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Team</th>
                            <th>Won</th>
                            <th>Tied</th>
                            <th>Lost</th>
                            <th>Points</th>
                        </tr>



                         <tr v-for="team in teams.data" :key="team.id">
                            <td>{{ team.id }}</td>
                            <td>{{ team.name }}</td>
                            <td>{{ team.won }}</td>
                            <td>{{ team.tied }}</td>
                            <td>{{ team.lost }}</td>
                            <td>{{ team.points }}</td>
                        </tr>

                     <!-- @empty -->
                        <!-- <tr>
                            <td colspan="6"><h3>No teams.</h3></td>
                        </tr> -->
                        <!-- @endforelse -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            team: {
                id: "",
                name: "",
                won: "",
                tied: "",
                lost: "",
                points: ""
            },
            teams:{}
        };
    },
    methods:{
        gettable(){
            axios.get("api/table" ).then(response => {
                this.teams = response.data;
            });
        },
    },
     mounted() {
        this.gettable
    },
    created() {
        this.gettable();
    }
};
</script>
