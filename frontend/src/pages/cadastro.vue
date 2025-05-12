<template>
  <v-main>
    <v-sheet class="pa-4 mx-auto" max-width="800">
      <span class="text-h4">Cadastro de Usuário</span>
      <v-divider class="my-3" />
      <v-btn
        class="mb-3"
        color="success"
        prepend-icon="mdi mdi-arrow-left-thin"
        to="/"
        variant="flat"
      >
        VOLTAR
      </v-btn>
      <FormCadastro />
    </v-sheet>
  </v-main>
</template>

<script setup>
  import FormCadastro from '@/components/FormCadastro.vue';
</script>
