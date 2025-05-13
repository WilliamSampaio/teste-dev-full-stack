<template>
  <v-main>
    <v-sheet class="pa-4 mx-auto" max-width="800">
      <span class="text-h4">Editar Cadastro de Usuário</span>
      <v-divider class="my-3" />
      <v-btn
        class="mb-3"
        color="success"
        prepend-icon="mdi mdi-arrow-left-thin"
        :to="`/visualizar?uuid=${data.uuid}`"
        variant="flat"
      >
        VOLTAR
      </v-btn>
      <FormCadastro :uuid="data.uuid" />
    </v-sheet>
  </v-main>
</template>

<script setup>
  import FormCadastro from '@/components/FormCadastro.vue';
  import { onBeforeMount, reactive } from 'vue';
  import { useRoute, useRouter } from 'vue-router';

  const route = useRoute();
  const router = useRouter();

  const data = reactive({
    uuid: null,
  });

  onBeforeMount(() => {
    if (route.query.uuid) {
      data.uuid = route.query.uuid;
    }else{
      router.push('/');
    }
  });
</script>
