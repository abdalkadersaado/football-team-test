<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-success btn-sm float-right"
            data-toggle="modal"
            data-target="#exampleModal"
        >
            New team
        </button>

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
                        <input
                            type="text"
                            :class="[
                                'form-control my-2',
                                errors.name ? 'is-invalid' : ''
                            ]"
                            placeholder="Please Enter name Team"
                            v-model="team.name"
                        />
                        <span
                            v-if="errors.name"
                            class="bg-danger text-white p-1 rounded"
                            >{{ errors.name[0] }}</span
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

                        <button type="button" class="btn btn-primary" @click="create">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

         <div class="container mx-auto">
            <h1 class="mt-8 text-2xl"> All Teams</h1>
            <hr />
            <div class="col-span-6">
                <div v-for="team in teams.data" :key="team.id" class="my-3">
                    <h3>
                        <b>{{team.name }}</b>
                    </h3>



                    <button
                        type="button"
                        class="btn btn-danger btn-sm float-right"
                        @click="deleteTeam(team.id)"
                    >
                        Delete
                    </button>
                    <br />
                    <hr />
                </div>
            </div>
            <pagination
                :data="teams"
                @pagination-change-page="getteams"
                class="text-center"
            ></pagination>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            team: {
                id: "",
                name: ""
            },
            errors: [],
            teams: {}
        };
    },
    methods:{
        create(){
             axios.post("api/createteam", this.team).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {

                    this.getteams();

                    Toast.fire({
                        icon: "success",
                        title: "Created successfully"
                    });

                    this.errors = [];
                    this.team = {
                        id: "",
                        name: "",

                    };
                }
            });
        },
        getteams(page=1) {
            axios.get("/api/getteams?page="+page).then(response => {
                this.teams = response.data.data;
            });
        },
        deleteTeam(teamid) {
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
                    axios.delete("api/deleteteam/" + teamid).then(response => {
                        if (response.data.status == "success") {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            this.getteams();
                        }
                    });
                }
            });
        },


    },
    created () {
        this.getteams();
    },

};
</script>
