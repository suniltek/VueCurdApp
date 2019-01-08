<template>
  <main> 
    <v-container fliud>
        <h1 class="mb-4 text-md-center">Login</h1>
        <v-layout>
          <v-flex xs4 offset-xs4>
            <v-card>
              <v-card-text>
                <form @keyup.enter="logItIn">
                  <v-text-field v-validate="'required|email'" v-model="login.email" 
                  :error-messages="errors.collect('email')" name="email" label="Email" data-vv-name="email">
                  </v-text-field>
                  <v-text-field v-validate="'required|max:10'" v-model="login.password"
                  :counter="10" :error-messages="errors.collect('password')" label="Password" type="password" 
                  data-vv-name="password" required></v-text-field>
                </form>
              </v-card-text>

              <v-btn class="mb-3 text-md-center" color="success" @click="logItIn">Login</v-btn>
            </v-card>
          </v-flex>
        </v-layout>
        <p class="pt-2 text-muted text-md-center">Copyright &copy; Cablelo 2018-2019</p>
    </v-container>  
  </main>  
</template>

<script>
export default {
  $_veeValidate: {
    validator: 'new'
  },
  data: () => ({
    login: {
      email: "",
      password: "",
      api_token: "abdc#0000",
    },
    dictionary: {
      attributes: {
        email: 'E-mail Address'
        // custom attributes
      },
      custom: {
        password: {
          required: () => 'Password can not be empty',
          max: 'The pasword field may not be greater than 10 characters'
          // custom messages
        }
      }
    }
  }),
  methods: {
    logItIn() {
      this.$validator.validateAll().then(result => {
        if (result) {
          axios.post("http://localhost/vueCableloApi/login-api.php", this.login)
          .then(response => {
            console.log(response.data);
            
            /*let newToken = response.data.api_token;
            window.token = newToken;
            let user = response.data.user;
            localStorage.setItem("token", newToken);
            localStorage.setItem("user", JSON.stringify(user));
            window.axios.defaults.params = { api_token: newToken };
            Event.$emit("login", user);
            this.$router.push("/");*/
            if (response.data.authentication == true){
              let tokenVal = response.data.api_token;
              localStorage.setItem('tokenKey', tokenVal);
              this.$emit('authenticated', true);
              this.$router.push('/Dashboard');
            } else {
              alert("Invalid Credentials");
            }
          });   
        }
      }); 
    }
  },
  mounted () {
    this.$validator.localize('en', this.dictionary)
    let gettoken = localStorage.getItem('tokenKey');
    if (gettoken) {
      this.$router.push('/Dashboard');
    }
  }
};
</script>

<style scoped>
  .text-muted{color:#959595}
</style>
