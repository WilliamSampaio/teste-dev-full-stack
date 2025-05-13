import { cpf } from 'cpf-cnpj-validator';

export const nomeRules = [
  value => {
    if (value) return true;
    return 'Nome deve ser preenchido.';
  },
  value => {
    if (value?.length <= 100) return true;
    return 'Nome deve ter tamanho máximo de 100 caracteres.';
  },
];

export const emailRules = [
  value => {
    if (value) return true;
    return 'E-mail deve ser preenchido.';
  },
  value => {
    if (/.+@.+\..+/.test(value)) return true;
    return 'E-mail deve ser válido.';
  },
];

export const cpfRules = [
  value => {
    if (value) return true;
    return 'CPF deve ser informado.';
  },
  value => {
    if (String(value).trim().length != 14) return 'CPF inválido.';
    return true;
  },
  value => {
    if (!cpf.isValid(value)) return 'CPF inválido.';
    return true;
  },
];

export const senhaRules = [
  value => {
    if (value) return true;
    return 'Senha é obrigatória.'
  },
  value => {
    if (String(value).length < 8) return 'Senha deve ter tamanho mínimo de 8 caracteres.';
    return true;
  },
  value => {
    if (String(value).length > 20) return 'Senha deve ter tamanho máximo de 20 caracteres.';
    return true;
  },
  value => {
    if (!String(value).match(
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
    )) {
      return 'Senha não atende aos requisitos mínimos de segurança.'
    }
    return true;
  },
]
