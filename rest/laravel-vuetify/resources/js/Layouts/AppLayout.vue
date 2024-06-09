<script
  setup
  lang="ts"
>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <v-app>
    <v-app-bar
      color="transparent"
      flat
      absolute
    >
      <v-container class="d-flex align-center py-0">
        <Link
          :href="route('posts.index')"
          class="d-flex"
        >
          <img
            src="https://github.com/foscia-dev/foscia-examples/raw/main/assets/img/logo.svg"
            alt="Foscia Examples"
            class="d-flex logo"
          >
        </Link>
        <v-spacer />
        <span class="font-weight-black">
          Laravel+REST+Vuetify
        </span>
      </v-container>
    </v-app-bar>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>

<style scoped>
    .logo {
        display: flex;
        height: 32px;
    }
</style>
