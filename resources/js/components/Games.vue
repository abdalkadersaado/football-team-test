<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-success btn-sm float-right"
            data-toggle="modal"
            data-target="#exampleModal"
        >
            New Games
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Create
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="">Enter Type Match : </label>
                            <div class="col-md-4">
                                <select
                                    class="form-control"
                                    name="type_match"
                                    v-model="game.type_match"
                                >
                                    <option value=""> choose match</option>
                                    <option>
                                        home match
                                    </option>
                                    <option>
                                        return match
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <label for="">Choose the teams</label>
                            <div class="col-md-4">
                                <select
                                    class="form-control"
                                    name="team1_id"
                                    v-model="game.team1_id"
                                >
                                    <option value=""> choose team1</option>
                                    <option
                                        v-for="data in teams1"
                                        :value="data.id"
                                        :key="data.id"
                                    >
                                        {{ data.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select
                                    class="form-control"
                                    name="team2_id"
                                    v-model="game.team2_id"
                                >
                                    <option value="">choose team2</option>
                                    <option
                                        v-for="data in teams2"
                                        :value="data.id"
                                        :key="data.id"
                                    >
                                        {{ data.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- <input
                            type="text"
                            :class="[
                                'form-control my-2',
                                errors.team1_id ? 'is-invalid' : ''
                            ]"
                            placeholder="team1"
                            v-model="game.team1_id"
                        />
                        <span
                            v-if="errors.team1_id"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.team1_id[0] }}</span
                        >

                        <input
                            type="text"
                            :class="[
                                'form-control my-2',
                                errors.team2_id ? 'is-invalid' : ''
                            ]"
                            placeholder="team2"
                            v-model="game.team2_id"
                        />
                        <span
                            v-if="errors.team2_id"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.team2_id[0] }}</span
                        > -->
                        <input
                            type="date"
                            :class="[
                                'form-control my-2',
                                errors.start_time ? 'is-invalid' : ''
                            ]"
                            placeholder="start time"
                            v-model="game.start_time"
                        />
                        <span
                            v-if="errors.start_time"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.start_time[0] }}</span
                        >
                        <input
                            type="number"
                            :class="[
                                'form-control my-2',
                                errors.result1 ? 'is-invalid' : ''
                            ]"
                            placeholder="result1"
                            v-model="game.result1"
                        />
                        <span
                            v-if="errors.result1"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.result1[0] }}</span
                        >
                        <input
                            type="number"
                            :class="[
                                'form-control my-2',
                                errors.result2 ? 'is-invalid' : ''
                            ]"
                            placeholder="result2"
                            v-model="game.result2"
                        />
                        <span
                            v-if="errors.result2"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.result2[0] }}</span
                        >
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="creategames"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mt-8 text-2xl ">Reults All Matches</h1>
                    <hr />
                    <div v-for="game in games.data" :key="game.id" class="my-3">
                        <h3>
                            <b>{{ game.team1.name }}</b> x
                            <b>{{ game.team2.name }}</b>
                        </h3>

                        <h5>
                            Type Match :
                            <b style="color:blue;">{{ game.type_match }}</b>
                        </h5>
                        <p style="color:green">
                            <b>Start Time: </b>{{ game.start_time }}
                        </p>
                        <h4>
                            <b>Result first team :</b>
                            <span style="color:red">{{ game.result1 }}</span>
                        </h4>
                        <h4><b>Result second team :</b>{{ game.result2 }}</h4>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm float-right"
                            @click="deleteGame(game.id)"
                        >
                            Delete
                        </button>
                        <br />
                        <hr />
                    </div>

                    <pagination
                        :data="games"
                        @pagination-change-page="getgames"
                        class="text-center"
                    ></pagination>
                </div>
                <div class="col-md-6">
                <h2>Games you haven't played yet</h2>
                <hr>
                 <div v-for="game in games_not_playing" :key="game.id" class="my-3">
                 <h3>
                            <b>{{ game.team1.name }}</b> x
                            <b>{{ game.team2.name }}</b>
                        </h3>

                        <h5>
                            Type Match :
                            <b style="color:blue;">{{ game.type_match }}</b>
                        </h5>

                 </div>
            </div>
            </div>


        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            game: {
                id: "",
                team1_id: "",
                team2_id: "",
                start_time: "",
                result1: "",
                result2: "",
                type_match: "",
                team1: {
                    id: "",
                    name: ""
                },
                team2: {
                    id: "",
                    name: ""
                }
            },
            games: {},
            errors: [],
            games_not_playing:{
                id: "",
                team1_id: "",
                team2_id: "",
                start_time: "",
                result1: "",
                result2: "",
                type_match: "",
                team1: {
                    id: "",
                    name: ""
                },
                team2: {
                    id: "",
                    name: ""
                }
            },
            team1s: 0,
            team2s: 0,
            teams1: [],
            teams2: [],

            edit: false
        };
    },
    methods: {
        creategames() {
            axios.post("api/create", this.game).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    this.getgames();
                    // this.posts.push(response.data.data);
                    Toast.fire({
                        icon: "success",
                        title: "Created successfully"
                    });
                    this.errors = [];
                    this.game = {
                        id: "",
                        team1_id: "",
                        team1_id: "",
                        start_time: "",
                        result1: "",
                        result2: ""
                    };
                }
            });
        },
        getteams1() {
            axios.get("/api/teams1").then(response => {
                this.teams1 = response.data.data;
            });
        },
        getteams2() {
            axios.get("api/teams2").then(response => {
                this.teams2 = response.data.data;
            });
        },
        getgames(page = 1) {
            axios.get("api/getgames?page=" + page).then(response => {
                this.games = response.data.data;
            });
        },
        deleteGame(gameid) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete("api/deletegame/" + gameid).then(response => {
                        if (response.data.status == "success") {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            this.getgames();
                        }
                    });
                }
            });
        },
        matches_not_playing() {
            axios.get("api/allgames").then(response => {
                this.games_not_playing = response.data.games;
            });
        }
    },

    mounted() {
        this.getgames();
        this.getteams1();
        this.getteams2();
    },
    created() {
        this.getgames();
        this.matches_not_playing();
    }
};
</script>
