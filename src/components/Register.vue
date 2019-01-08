<template>
  <main>
    <Menu></Menu>
      <v-layout>
        <v-flex xs12 md4 offset-md4>
          <h1 class="mt-4 mb-4 text-md-center">Register User</h1>
          <v-card>
            <v-card-text>
              <v-container grid-list-lg>
                <v-form>
                  <v-layout row wrap>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|alpha_spaces'" v-model="register.userfullname" 
                      :error-messages="errors.collect('userfullname')" label="Full Name" data-vv-name="userfullname">
                      </v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|email'" v-model="register.uemail" label="Email"
                      :error-messages="errors.collect('uemail')" data-vv-name="uemail"></v-text-field>
                    </v-flex>
                  </v-layout> 
                  <v-layout row wrap>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|numeric'" v-model="register.uphone" label="Phone" 
                      :error-messages="errors.collect('uphone')" data-vv-name="uphone"></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|alpha_num'" v-model="register.ucity" label="City" 
                      :error-messages="errors.collect('ucity')" data-vv-name="ucity"></v-text-field>
                    </v-flex>
                  </v-layout>
                  <v-layout row wrap>
                    <v-flex xs12 md6>
                       <v-text-field v-validate="'required|alpha_spaces'" v-model="register.ulocality" label="Locality" 
                       :error-messages="errors.collect('ulocality')" data-vv-name="ulocality"></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|numeric'" v-model="register.upincode" label="Pincode" 
                      :error-messages="errors.collect('upincode')" data-vv-name="upincode"></v-text-field>
                    </v-flex>
                  </v-layout>
                  <v-layout column wrap>
                    <v-flex xs12 md6>
                      <v-textarea v-validate="{ required: true, regex: /^[ A-Za-z0-9_@./,#&+-]*$/ }" v-model="register.uaddress" label="Address" 
                      :error-messages="errors.collect('uaddress')" data-vv-name="uaddress"></v-textarea>
                    </v-flex>
                  </v-layout>
                  <v-layout row wrap>
                    <v-flex xs12 md6>
                      <v-text-field v-validate="'required|alpha_num'" v-model="register.usetupboxno" label="Setupbox No"
                      :error-messages="errors.collect('usetupboxno')" data-vv-name="usetupboxno"></v-text-field>
                    </v-flex>
                    <v-flex xs12 md6>
                      <v-select :items="ustatusCode" v-model="register.ustatusCode" label="Status"></v-select>
                    </v-flex>
                  </v-layout>
                  <div class="text-md-center">
                    <v-btn class="mb-1" color="success" @click="registerIt">Register</v-btn> 
                  </div>  
                </v-form>  
              </v-container> 
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
  </main>  
</template>

<script>
import Menu from '@/components/Menu'

export default {
  $_veeValidate: {
    validator: 'new'
  },
  components: {
    Menu
  },
  data: () => ({
    register:{
      userfullname: '',
      uemail: '',
      uphone: '',
      ucity: '',
      ulocality: '',
      uaddress: '',
      upincode: '',
      usetupboxno: '',
      ustatusCode: '',
      usetupboxnoUppercase: ''
    },
    ustatusCode: ['Active', 'Inactive'],
    dictionary: {
      attributes: {
        uemail: 'E-mail',
        userfullname: 'Full Name',
        uphone: 'Phone No',
        ucity: 'City',
        ulocality: 'Locality',
        uaddress: 'Address',
        upincode: 'Pincode',
        usetupboxno: 'Setupbox No',
        // custom attributes
      },
      custom: {
        password: {
          required: () => 'Password can not be empty',
          max: 'The pasword field may not be greater than 10 characters'
          // custom messages
        }
      },
    }
  }),
  computed : {
    usetupboxno1: function() {
      return this.register.usetupboxno.toUpperCase();
    }
  },
  methods: {
    registerIt() {
      this.$validator.validateAll().then(result => {
        if (result) {
          console.log(this.usetupboxno1);
          
          axios.post('http://localhost/vueCableloApi/register-user-api.php', {
              userfullname: this.register.userfullname,
              uemail: this.register.uemail,
              uphone: this.register.uphone,
              ucity: this.register.ucity,
              ulocality: this.register.ulocality,
              uaddress: this.register.uaddress,
              upincode: this.register.upincode,
              usetupboxno: this.usetupboxno1,
              ustatusCode: this.register.ustatusCode
          })
          .then(response => {
            console.log(response.data);
            if (response.data.status == 'success'){
              this.$router.push('/Dashboard');
            } else {
              alert("Unable to Add User");
            }
          });   
        }
      }); 
    }
  },
  mounted () {
    this.$validator.localize('en', this.dictionary)
  }
};
</script>

