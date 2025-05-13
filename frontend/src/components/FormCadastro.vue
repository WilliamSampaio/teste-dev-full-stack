<template>
  <v-alert v-if="message.type && message.text" class="mb-3" :type="message.type" variant="tonal">{{ message.text
  }}</v-alert>
  <v-form ref="form">
    <input v-model="cadastro.uuid" type="hidden">
    <v-text-field v-model="cadastro.nome" class="mb-2" label="Nome" :rules="nomeRules" />
    <v-text-field
      v-model="cadastro.cpf"
      v-maska="'###.###.###-##'"
      class="mb-2"
      label="CPF"
      :rules="cpfRules"
    />
    <v-text-field v-model="cadastro.email" class="mb-2" label="E-mail" :rules="emailRules" />
    <v-text-field
      v-model="cadastro.senha_1"
      :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
      class="mb-2"
      label="Senha"
      :rules="senhaRules"
      :type="visible ? 'text' : 'password'"
      @click:append-inner="visible = !visible"
    />
    <v-text-field
      v-model="cadastro.senha_2"
      class="mb-2"
      label="Confirme a Senha"
      :rules="[ruleSenhaConfirmacao]"
      type="password"
    />
    <v-alert class="mb-3" density="compact">
      Senha deve conter: No mínimo 8 caracteres, letra minuscula, letra
      maiúscula, caractere numérico, caractere especial.
    </v-alert>

    <v-sheet class="text-center mb-3">
      <v-btn
        color="primary"
        rounded="xl"
        size="large"
        variant="flat"
        @click="cadastrar"
      >
        {{ cadastro.uuid ? 'Editar' : 'Cadastrar' }}
      </v-btn>
    </v-sheet>
  </v-form>
</template>

<script setup>
  import { cpfRules, emailRules, nomeRules, senhaRules } from '@/rules';
  import { computed, defineProps, onBeforeMount, reactive, ref } from 'vue';
  import { vMaska } from 'maska/vue'
  import { getUsuario, postUsuario, putUsuario } from '@/api';
  import { useRouter } from 'vue-router';

  const router = useRouter();

  const form = ref(null);

  const props = defineProps({
    uuid: null,
  });

  const message = reactive({
    type: null,
    text: null,
  });

  const cadastro = reactive({
    uuid: null,
    nome: null,
    cpf: null,
    email: null,
    senha_1: null,
    senha_2: null,
  });

  const ruleSenhaConfirmacao = computed(() => {
    return () => cadastro.senha_1 === cadastro.senha_2 || 'Senhas diferentes!';
  });

  const visible = ref(false);

  const buscar = () => {
    getUsuario(props.uuid).then(response => {
      const { data } = response;
      cadastro.uuid = data.uuid;
      cadastro.nome = data.nome;
      cadastro.cpf = data.cpf;
      cadastro.email = data.email;
    }).catch(() => {
      message.type = 'error';
      message.text = 'Falha em buscar usuário.'
    });
  };

  const cadastrar = () => {
    form.value.validate().then(v => {
      if (v.valid) {
        if (cadastro.uuid !== null) {
          putUsuario(cadastro.uuid, {
            nome: cadastro.nome,
            cpf: cadastro.cpf.replace(/[^0-9]/g, ''),
            email: cadastro.email,
            senha: cadastro.senha_1,
          }).then(() => {
            message.type = 'success';
            message.text = 'Usuário atualizado.'
          }).catch(() => {
            message.type = 'error';
            message.text = 'Falha em atualizar usuário.'
          });
        } else {
          postUsuario({
            nome: cadastro.nome,
            cpf: cadastro.cpf.replace(/[^0-9]/g, ''),
            email: cadastro.email,
            senha: cadastro.senha_1,
          }).then(() => {
            router.push('/');
          }).catch(() => {
            message.type = 'error';
            message.text = 'Falha em cadastrar usuário.'
          });
        }
      }
    });
  };

  onBeforeMount(() => {
    if (props.uuid) {
      buscar();
    }
  });
</script>

<style scoped></style>
