<template>
  <v-main>
    <v-sheet class="pa-4 mx-auto" max-width="800">
      <span class="text-h4">Usuários</span>
      <v-divider class="my-3" />
      <v-btn
        class="mb-3"
        color="success"
        prepend-icon="mdi mdi-plus"
        to="/cadastro"
        variant="flat"
      >
        CADASTRAR NOVO USUÁRIO
      </v-btn>
      <ListaUsuarios />
    </v-sheet>
  </v-main>
</template>

<script setup>
  import ListaUsuarios from '@/components/ListaUsuarios.vue';
</script>
