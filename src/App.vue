<template>
  <v-app>
    <main>
      <router-view>
        <Login></Login>
      </router-view>  
    </main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      title: "Cablelo"
    };
  },
  name: "App"
};
</script>
