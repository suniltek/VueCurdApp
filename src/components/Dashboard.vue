<template>
  <main>
    <Menu></Menu>
    <v-container grid-list-md>
      <v-layout row wrap>  
        <v-flex sm3>
          <v-card color="orange accent-2" class="white--text">
            <v-card-title primary-title class="justify-center"> 
              <div class="headline">
                <i class="material-icons d-block m-auto text-sm-center pa-2 font-2x">face</i>
                User Listing
              </div>
            </v-card-title>
            <v-card-actions class="justify-center">
              <v-btn class="mb-3" to="/user-listing">View Details</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex sm3>  
          <v-card color="red darken-2" class="white--text">
            <v-card-title primary-title class="justify-center"> 
              <div class="headline">
                <i class="material-icons d-block m-auto text-sm-center pa-2 font-2x">router</i>
                Active Box
              </div>
            </v-card-title>
            <v-card-actions class="justify-center">
              <v-btn class="mb-3">View Details</v-btn>
            </v-card-actions>
          </v-card>  
        </v-flex>
        <v-flex sm3>  
          <v-card color="deep-purple darken-2" class="white--text">
            <v-card-title primary-title class="justify-center"> 
              <div class="headline">
                <i class="material-icons d-block m-auto text-sm-center pa-2 font-2x">payment</i>
                Payments
              </div>
            </v-card-title>
            <v-card-actions class="justify-center">
              <v-btn class="mb-3">View Details</v-btn>
            </v-card-actions>
          </v-card>  
        </v-flex>
        <v-flex sm3>  
          <v-card color="cyan darken-2" class="white--text">
            <v-card-title primary-title class="justify-center"> 
              <div class="headline">
                <i class="material-icons d-block m-auto text-sm-center pa-2 font-2x">show_chart</i>
                Revenues
              </div>
            </v-card-title>
            <v-card-actions class="justify-center">
              <v-btn class="mb-3">View Details</v-btn>
            </v-card-actions>
          </v-card>  
        </v-flex>
      </v-layout>
    </v-container>
  </main>  
</template>

<script>
import Menu from '@/components/Menu'

export default {
  components: {
    Menu
  },
  data () {
    return {}
  },
  mounted () {
    let gettoken = localStorage.getItem('tokenKey');
    if (gettoken) {
      
    } else {
      this.$router.push('/login');
    }
  }
}
</script>

<style scoped>
  .font-2x{font-size:45px !important;}
</style>
