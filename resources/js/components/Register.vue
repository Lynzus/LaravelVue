<template>
      <div class="login-page">
      <div class="container border">
         <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-8 mx-auto">
                  <h1 class=" pt-4 text-info">Registro</h1>
                  <form class="form-group">
                     <input v-model="form.name" type="email" class="form-control" placeholder="Nombre de Usuario" required>
                     <input v-model="form.email" type="email" class="form-control" placeholder="Correo Electrónico" required>
                     <input v-model="form.password" type="password" class="form-control" placeholder="Contraseña" required>
                     <input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Confirmar contraseña" required>
                     <div type="submit">
                          <button @click.prevent="saveForm" class="btn btn-outline-info">Listo</button> 
                     </div>
                     <p><a href="/login" >¿Ya posee una cuenta?</a></p>
                  </form>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            form2: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        saveForm() {
            axios
                .post("/api/register", this.form)
                .then(() => {
                    axios
                        .post("/api/login", this.form)
                        .then(() => {
                            this.$router.push({ name: "Dashboard" }),
                                console.log("si funciona");
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                    console.log(this.form);
                })
                .catch((error) => {});
        },
    },
    mounted() {
        axios.get("/api/user").then((res) => {
            if (res.data) this.$router.push({ name: "Dashboard" });
        });
    },
};
</script>
<style lang="scss" scoped>
p {
   line-height: 1rem;
}

.card {
   padding: 20px;
}

.form-group {
   input {
      margin-bottom: 20px;
   }
}
.container {
    // height: 600px;
    // height: 56%;
  max-width: 500px;
      
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(83, 197, 250, 0.2);
  border-radius: 10px 10px 10px 10px;
  box-shadow: inset;
}
.login-page {
   align-items: center;
   display: flex;
   height: 100vh;


   h1 {
      margin-bottom: 1.5rem;
   }
}

</style>