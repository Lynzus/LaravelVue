<template>
    
   <div class="login-page">
      <div class="container  border">
         <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-7 mx-auto">
                  <h1 class="text-center mt-3 text-info">Login</h1>
                  <form class="form-group">
                      <div class="fs-5 text-center py-2">Ingrese los datos para comenzar</div>
                     <input v-model="form.email" type="email" class="form-control" placeholder="Correo Electrónico" required>
                     <input v-model="form.password" type="password" class="form-control" placeholder="Contraseña" required>
                     <div type="submit">
                          <button @click.prevent="loginUser" class="btn btn-outline-info">ENTRAR</button> 
                     </div>
                     <p class="pt-2"><a href="">¿Olvidó su contraseña?</a></p>
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
                email: "",
                password: "",
            },
            currentUser: {},
        };
    },
    methods: {
        loginUser() {
            axios
                .post("/api/login", this.form)
                .then(() => {
                    this.$router.push({ name: "Dashboard" });
                })
                .catch((error) => {
                    console.log("error");
                });
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

.container {
    height: 600px;
    height: 56%;
       width: 90%;
  max-width: 400px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(83, 197, 250, 0.2);
  border-radius: 10px 10px 10px 10px;
}

.form-group {
   input {
      margin-bottom: 20px;
   }
}

.login-page {
    
  
   display: flex;
   height: 100vh;
    



   h1 {
      margin-bottom: 1.5rem;
   }
}

</style>