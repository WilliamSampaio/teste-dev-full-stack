<template>
  <v-main>
    <v-sheet class="pa-4 mx-auto" max-width="800">
      <span class="text-h4">Usuários</span>
      <v-divider class="my-3"></v-divider>
      <ListaUsuarios />
    </v-sheet>
  </v-main>
</template>

<script setup>
  import ListaUsuarios from '@/components/ListaUsuarios.vue';
</script>
