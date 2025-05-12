<template>
  <v-alert v-if="data.usuarios === null" type="warning" variant="tonal">Não há usuários cadastrados.</v-alert>
  <v-table v-else>
    <thead>
      <tr>
        <th class="text-left">
          Name
        </th>
        <th class="text-left">
          CPF
        </th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody v-if="data.loading !== true">
      <tr v-for="usuario in data.usuarios" :key="usuario.uuid">
        <td>{{ usuario.nome }}</td>
        <td>{{ usuario.cpf }}</td>
        <td>

        </td>
      </tr>
    </tbody>
    <tbody v-else>
      <tr v-for="i in [0, 1, 2]">
        <td>
          <v-skeleton-loader type="text"></v-skeleton-loader>
        </td>
        <td>
          <v-skeleton-loader type="text"></v-skeleton-loader>
        </td>
        <td>
          <v-skeleton-loader type="text"></v-skeleton-loader>
        </td>
      </tr>
    </tbody>
  </v-table>
</template>

<script setup>
import { listUsuarios } from '@/api';
import { onBeforeMount, reactive } from 'vue';

const data = reactive({
  usuarios: null,
  loading: false,
});

onBeforeMount(() => {
  data.loading = true;
  listUsuarios().then(res => {
    const usuarios = res.data;
    if (usuarios) {
      data.usuarios = usuarios;
    }
  }).finally(() => {
    data.loading = false;
  });
});
</script>

<style scoped></style>
