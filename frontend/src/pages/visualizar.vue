<template>
  <v-main>
    <v-sheet class="pa-4 mx-auto" max-width="800">
      <span class="text-h4">Visualizar Usuário</span>
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
      <v-alert v-if="message.type && message.text" class="mb-3" :type="message.type" variant="tonal">
        {{ message.text }}
      </v-alert>
      <v-list v-else class="mb-3" lines="one">
        <v-list-item>
          <template #prepend>
            <v-avatar>
              <v-icon color="indigo" icon="mdi mdi-account" />
            </v-avatar>
          </template>
          <v-list-item-title>Nome</v-list-item-title>
          <v-list-item-subtitle>{{ cadastro.nome }}</v-list-item-subtitle>
        </v-list-item>
        <v-list-item>
          <template #prepend>
            <v-avatar>
              <v-icon color="indigo" icon="mdi mdi-card-account-details-outline" />
            </v-avatar>
          </template>
          <v-list-item-title>CPF</v-list-item-title>
          <v-list-item-subtitle>{{ formataCpf(cadastro.cpf) }}</v-list-item-subtitle>
        </v-list-item>
        <v-list-item>
          <template #prepend>
            <v-avatar>
              <v-icon color="indigo" icon="mdi-email" />
            </v-avatar>
          </template>
          <v-list-item-title>E-mail</v-list-item-title>
          <v-list-item-subtitle>{{ cadastro.email }}</v-list-item-subtitle>
        </v-list-item>
      </v-list>
      <v-divider class="my-3" />
      <v-btn
        class="mb-3"
        color="success"
        prepend-icon="mdi mdi-pencil"
        :to="`/editar?uuid=${cadastro.uuid}`"
        variant="flat"
      >
        EDITAR
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn
        class="mb-3"
        color="error"
        prepend-icon="mdi mdi-trash-can-outline"
        variant="flat"
        @click="excluir"
      >
        EXCLUIR
      </v-btn>
    </v-sheet>
  </v-main>
</template>

<script setup>
  import { onBeforeMount, reactive } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import { deleteUsuario, getUsuario } from '@/api';

  const route = useRoute();
  const router = useRouter();

  const message = reactive({
    type: null,
    text: null,
  });

  const cadastro = reactive({
    uuid: null,
    nome: null,
    cpf: null,
    email: null,
  });

  const excluir = () => {
    deleteUsuario(cadastro.uuid).then(() => {
      router.push('/');
    })
  };

  const formataCpf = cpf => {
    return String(cpf).replace(/^(\d{3})(\d{3})(\d{3})(\d{2})*/, '$1.$2.$3-$4');
  }

  onBeforeMount(() => {
    if (route.query.uuid) {
      getUsuario(route.query.uuid).then(response => {
        const { data } = response;
        cadastro.uuid = data.uuid;
        cadastro.nome = data.nome;
        cadastro.cpf = data.cpf;
        cadastro.email = data.email;
      }).catch(() => {
        message.type = 'error';
        message.text = 'Falha em buscar usuário.'
      });
    }else{
      router.push('/');
    }
  });
</script>
