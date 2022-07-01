<template>
    <div class="">
        <!-- <br />
        Dashboard <br />

        Name: {{ currentUser.name }} <br />
        Email: {{ currentUser.email }}<br /><br /> -->
        <div class="float-end">
        <button @click.prevent="logout" class=" btn btn-outline-dark">Cerrar Sesion</button>
        </div>
    
        <div class="container mt-3">
        <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center" >ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(user, key) in userList" :key="key" class="">
        <th class="text-center">{{user.id}}</th>
        <th>{{user.name}}</th>
        <th>{{user.email}}</th>
        <th v-if="user.id !== currentUser.id"
                    >
                    <a @click="deleteUser(user.id)" class="btn btn-danger"
                        >Eliminar</a
                    >
                    <a @click="setUserToUpdate(user)" class="btn btn-primary"
                        >Actualizar</a
                    ></th>
        <th v-if="user.id == currentUser.id">
            <a class="btn btn-danger disabled"
                        >Eliminar</a
                    >
                    <a class="btn btn-primary disabled"
                        >Actualizar</a>
        </th>

      </tr>
    </tbody>
  </table>
  

    

        <form v-if="edit" @submit.prevent="updateUser" class="container">
            <h3>Editar</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Ingrese nuevo nombre</label>
                <input
                    type="text"
                    class="form-control w-auto"
                    name="name"
                    id="name"
                    v-model="formData.name"
                />
            </div>
            <button
                @click.prevent="updateUser"
                type="submit"
                class="btn btn-success"
            >
                Guardar cambios
            </button>
        </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            currentUser: {},
            userList: [],
            edit: false,
            formData: {
                name: "",
                id: "",
            },
        };
    },
    methods: {
        logout() {
            axios.post("/api/logout").then(() => {
                this.$router.push({ name: "Home" });
            });
        },

        getUsers() {
            axios.get("api/users").then((res) => {
                this.userList = res.data;
            });
        },

        deleteUser(id) {
            Swal.fire({
                title: "Esta seguro de eliminar este usuario?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#0e0e0e",
                confirmButtonText: "Eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(window.location.origin + "/api/user/" + id)
                        .then((response) => {
                            this.getUsers();
                            console.log(response);
                        })
                        .catch((errors) => {
                            console.log(errors);
                        });
                    Swal.fire(
                        "Actualizado!",
                        "Este usuario ha sido actualizado.",
                        "success"
                    );
                }
            });
        },

        setUserToUpdate(user) {
            this.formData.name = user.name;
            this.formData.id = user.id;
            this.edit = true;
        },

        updateUser() {
            axios
                .post(
                    window.location.origin + "/api/user/" + this.formData.id,
                    this.formData
                )
                .then((res) => {
                    this.edit = false;
                    this.getUsers();
                    this.$toaster.success("Usuario actualizado!!.");
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                    this.$toaster.error(error);
                });
        },
    },
    mounted() {
        axios.get("/api/user").then((res) => {
            this.currentUser = res.data;
            console.log(this.currentUser);
        });
        this.getUsers();
    },
};
</script>