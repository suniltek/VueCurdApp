<template>
  <v-toolbar>
    <v-menu offset-y bottom origin="center center" transition="scale-transition"> 
      <v-btn flat color="green" slot="activator"><v-icon left>menu</v-icon> Menu </v-btn>
      <v-list>
        <v-list-tile v-for="item in items" :key="item.title">
          <!-- <v-list-tile-title>{{ item.title }} {{ item.aaction }}</v-list-tile-title> -->
          <router-link :to="item.aaction" tag="span">
            <v-btn color="black" flat>{{ item.title }}</v-btn>
          </router-link>
        </v-list-tile>    
      </v-list>
    </v-menu>    
    <v-spacer></v-spacer>
    <v-toolbar-title v-text="title"></v-toolbar-title>
    <v-spacer></v-spacer>
    <div>
      <router-link v-if="authenticated" to="/Login" v-on:click.native="logItOut ()" replace >
        <v-btn flat><v-icon color="red">power_settings_new</v-icon></v-btn>
      </router-link>  
    </div>
    <div>
      <router-view @authenticated="setAuthenticated"></router-view>
    </div>  
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      authenticated: false,
      items: [
        { title: 'Dashbaord', aaction: '/dashboard' },
        { title: 'Add User Details', aaction: '/register' },
        { title: 'Get User Details', aaction: '/user-listing' }
      ],
      title: "Cablelo"
    };
  },
  methods: {
    setAuthenticated (status) {
      this.authenticated = status
    },
    logItOut (){
      this.authenticated = false;
      let gettoken = localStorage.getItem('tokenKey');
      localStorage.removeItem("tokenKey");
      this.$router.push('/login');
    }  
  },
  beforeMount() {
    let gettoken = localStorage.getItem('tokenKey');
    if(gettoken){
      this.authenticated = true;
    } else{
      this.authenticated = false;
    }
  },
  name: "Menu"
};
</script>


