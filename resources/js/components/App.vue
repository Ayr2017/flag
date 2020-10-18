<template>
  <v-app>
    <template>
      <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
          <NavigatorDrawer />
        </v-navigation-drawer>

        <v-app-bar app>
          <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

          <v-toolbar-title>Flag</v-toolbar-title>

          <div class="ml-auto">
            <v-btn text href="/login">Login</v-btn>
            <v-btn text href="/register">Register</v-btn>
          </div>
        </v-app-bar>

        <v-main>
          <router-view></router-view>
        </v-main>
      </v-app>
    </template>
  </v-app>
</template>

<script>
import NavigatorDrawer from "./API/NavigationDrawer.vue";
import VueRouter from "vue-router";
export default {
  components: {
    NavigatorDrawer,
  },
  data: () => ({ drawer: null }),
};
</script>