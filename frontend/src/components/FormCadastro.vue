<template>
  <v-form ref="form">
    <v-text-field v-model="data.nome" class="mb-2" label="Nome" :rules="nomeRules" />
    <v-text-field
      v-model="data.cpf"
      v-maska="'###.###.###-##'"
      class="mb-2"
      label="CPF"
      :rules="cpfRules"
    />
    <v-text-field v-model="data.email" class="mb-2" label="E-mail" :rules="emailRules" />
    <v-text-field
      v-model="data.senha_1"
      :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
      class="mb-2"
      label="Senha"
      :rules="senhaRules"
      :type="visible ? 'text' : 'password'"
      @click:append-inner="visible = !visible"
    />
    <v-text-field
      v-model="data.senha_2"
      class="mb-2"
      label="Confirme a Senha"
      :rules="[ruleSenhaConfirmacao]"
      type="password"
    />
    <v-alert class="mb-3" density="compact">
      Senha deve conter: No mínimo 8 caracteres, letra minuscula, letra
      maiúscula, caractere numérico, caractere especial.
    </v-alert>

    <v-btn class="me-4" type="submit" @click="cadastrar">
      submit
    </v-btn>
    <v-btn @click="handleReset">
      clear
    </v-btn>
  </v-form>
</template>

<script setup>
  import { cpfRules, emailRules, nomeRules, senhaRules } from '@/rules';
  import { computed, reactive, ref } from 'vue';
  import { vMaska } from 'maska/vue'

  const form = ref(null);

  const data = reactive({
    nome: null,
    cpf: null,
    email: null,
    senha_1: null,
    senha_2: null,
  });

  const ruleSenhaConfirmacao = computed(() => {
    return () => data.senha_1 === data.senha_2 || 'Senhas diferentes!';
  });

  const visible = ref(false);

  const cadastrar = () => {
    form.value.validate().then(v => {
      if (v.valid) {
        'a'
      }
    });
  };
</script>

<style scoped></style>
