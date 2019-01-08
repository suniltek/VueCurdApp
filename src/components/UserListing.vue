<template>
<main>
  <Menu></Menu>
  <v-container fluid>
    <v-layout row wrap> 
      <v-flex xs12 md12>
        <v-toolbar flat color="white">
          <v-toolbar-title>User Listing</v-toolbar-title>
          <v-divider class="mx-2" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-alert v-model="alert" dismissible type="success">
            {{ msgDis}}
          </v-alert>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" persistent max-width="500px">
            <v-btn slot="activator" color="primary" dark class="mb-2">Add user</v-btn>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|alpha_spaces'" v-model="editedItem.name" name="name" 
                      :error-messages="errors.collect('name')" label="Full Name" data-vv-name="name">
                      </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|email'" v-model="editedItem.email" name="email" 
                      label="Email Id" :error-messages="errors.collect('email')" data-vv-name="email"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|numeric'" v-model="editedItem.phone" name="phone" 
                      label="Phone No" :error-messages="errors.collect('phone')" data-vv-name="phone"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|alpha_num'" v-model="editedItem.city" name="city" 
                      label="City" :error-messages="errors.collect('city')" data-vv-name="city"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|alpha_spaces'" v-model="editedItem.locality" name="locality" 
                      label="Locality" :error-messages="errors.collect('locality')" data-vv-name="locality">
                      </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="{ required: true, regex: /^[ A-Za-z0-9_@./,#&+-]*$/ }" 
                      v-model="editedItem.address" name="address" label="Address"
                      :error-messages="errors.collect('address')" data-vv-name="address"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|numeric'" v-model="editedItem.pincode" name="pincode" 
                      label="Pincode" :error-messages="errors.collect('pincode')" data-vv-name="pincode">
                      </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-text-field v-validate="'required|alpha_num'" v-model="editedItem.setupbox_no" name="setupbox_no"
                      label="Setupbox No" :error-messages="errors.collect('setupbox_no')" data-vv-name="setupbox_no">
                      </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md6>
                      <v-select :items="ustatusCode" v-model="editedItem.status" name="status" label="Status"></v-select>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
        <v-data-table :headers="headers" :items="getUserList" class="elevation-1">
          <template slot="items" slot-scope="props">
            <td>{{ props.item.name }}</td>
            <td class="text-xs-left">{{ props.item.email }}</td>
            <td class="text-xs-left">{{ props.item.phone }}</td>
            <td class="text-xs-left">{{ props.item.city }}</td>
            <td class="text-xs-left">{{ props.item.locality }}</td>
            <td class="text-xs-left">{{ props.item.address }}</td>
            <td class="text-xs-left">{{ props.item.pincode }}</td>
            <td class="text-xs-left">{{ props.item.setupbox_no }}</td>
            <td class="text-xs-left">{{ props.item.status }}</td>
            <td class="justify-center layout px-0">
              <v-icon color="green" small class="mr-2" @click="editItem(props.item)">
                edit
              </v-icon>
              <v-icon color="red" small @click="deleteItem(props.item.userid)">
                delete 
              </v-icon>
            </td>
          </template>
          <template slot="no-data">
            <v-btn color="primary" @click="initialize">Reset</v-btn>
          </template>
        </v-data-table>
        <!--<ul>
          <li v-for="user in users">
            <p>{{ user.name }}</p>
            <p>{{ user.email }}</p>
            <p>{{ user.phone }}</p>
            <p>{{ user.city }}</p>
            <p>{{ user.locality }}</p>
            <p>{{ user.address }}</p>
            <p>{{ user.pincode }}</p>
            <p>{{ user.setupbox_no }}</p>
            <p>{{ user.status }}</p>
            <p>*********************************************************</p>
          </li>
        </ul>-->
      </v-flex>
    </v-layout>
  </v-container>
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
    /*data() {
    return {
      users: []
    }
  },*/
    data: () => ({
      dialog: false,
      alert: false,
      msgDis: '',
      headers: [
        {
          text: 'Full Name',
          align: 'left',
          sortable: false,
          value: 'user_full_name'
        },
        { text: 'Email Id', value: 'user_email' },
        { text: 'Phone No', value: 'user_phone' },
        { text: 'City', value: 'user_city' },
        { text: 'Locality', value: 'user_locality' },
        { text: 'Address', value: 'user_address' },
        { text: 'Pincode', value: 'user_pincode' },
        { text: 'Setupbox No', value: 'setupbox_no' },
        { text: 'Status', value: 'status_code' },
        { text: 'Actions', value: 'user_full_name', sortable: false }
      ],
      getUserList: [],
      editedIndex: -1,
      editedItem: {
        user_id: '',
        user_full_name: '',
        user_email: '',
        user_phone: 0,
        user_city: '',
        user_locality: '',
        user_address: '',
        user_pincode: 0,
        setupbox_no: '',
        status_code: ''
      },
      defaultItem: {
        user_id: '',
        user_full_name: '',
        user_email: '',
        user_phone: 0,
        user_city: '',
        user_locality: '',
        user_address: '',
        user_pincode: 0,
        setupbox_no: '',
        status_code: ''
      },
      ustatusCode: ['Active', 'Inactive'],
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Add User' : 'Edit User'
      },
      setupboxnoUppercase: function() {
        return this.editedItem.setupbox_no.toUpperCase();
      } 
    },

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        let vm = this;
        axios.get("http://localhost/vueCableloApi/display-user-api.php")
				  .then(function(response){
          // console.log(response.data);
          vm.getUserList = response.data;
				});

        /*
        this.getUserList = [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3
          }
        ] */
      },

      editItem (item) {
        this.editedIndex = this.getUserList.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        //alert(item);
        let vm = this;
        let delUserId = item;
        const index = this.getUserList.indexOf(item);
        confirm('Are you sure you want to delete this item?') && this.getUserList.splice(index, 1)
        axios.post("http://localhost/vueCableloApi/delete-user-api.php",{userid: delUserId})
        .then(function(response){
          if(response.data.response == 'success'){
            vm.alert = true;
            vm.msgDis = "User Deleted Successfully.. !!"; 
          }
        });
      },

      close () {
        this.errors.clear()
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.getUserList[this.editedIndex], this.editedItem)
          let vm = this;
          this.$validator.validateAll().then(result => {
            if (result) {
              axios.post("http://localhost/vueCableloApi/edit-user-api.php",
              {
                userid: this.editedItem.userid,
                name: this.editedItem.name,
                email: this.editedItem.email,
                phone: this.editedItem.phone,
                city: this.editedItem.city,
                locality: this.editedItem.locality,
                address: this.editedItem.address,
                pincode: this.editedItem.pincode,
                setupbox_no: this.setupboxnoUppercase,
                status: this.editedItem.status
              })
              .then(function(response){
              if(response.data.response == 'success'){
                console.log(response.data.response); 
                vm.alert = true;
                vm.msgDis = "User Updated Successfully.. !!"; 
              }
              // vm.getUserList = response.data;
              // console.log(vm.getUserList);
              });
            }
          });   
          this.close()
        } else {
          //this.getUserList.push(this.editedItem)
          let vm = this;
          this.$validator.validateAll().then(result => {
            if (result) {
              axios.post('http://localhost/vueCableloApi/register-user-api.php', {
                  userfullname: this.editedItem.name,
                  uemail: this.editedItem.email,
                  uphone: this.editedItem.phone,
                  ucity: this.editedItem.city,
                  ulocality: this.editedItem.locality,
                  uaddress: this.editedItem.address,
                  upincode: this.editedItem.pincode,
                  usetupboxno: this.setupboxnoUppercase,
                  ustatusCode: this.editedItem.status
              })
              .then(response => {
                console.log(response.data);
                if (response.data.status == 'success'){
                  this.close()
                  vm.alert = true;
                  vm.msgDis = "User Added Successfully.. !!"; 
                }
              });   
            }
          });
        }
      }
    }
  }
</script>