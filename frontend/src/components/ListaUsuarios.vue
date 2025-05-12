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
        <td class="pa-1">
          <v-btn color="info" icon="mdi mdi-magnify" variant="tonal" />
          <!-- <v-btn icon="mdi mdi-pencil" color="success" variant="tonal"></v-btn>
          <v-btn icon="mdi mdi-trash-can-outline" color="error" variant="tonal"></v-btn> -->
        </td>
      </tr>
    </tbody>
    <tbody v-else>
      <tr v-for="(k) in [0, 1, 2]" :key="k">
        <td>
          <v-skeleton-loader type="text" />
        </td>
        <td>
          <v-skeleton-loader type="text" />
        </td>
        <td>
          <v-skeleton-loader type="text" />
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
