import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL,
});

export const listUsuarios = () => {
  return api.get('/usuarios');
}

export const getUsuario = uuid => {
  return api.get(`/usuarios/${uuid}`);
}

export const postUsuario = data => {
  return api.post('/usuarios', data, { headers: { 'Content-Type': 'application/json' } });
}

export const putUsuario = (uuid, data) => {
  return api.put(`/usuarios/${uuid}`, data, { headers: { 'Content-Type': 'application/json' } });
}

export const deleteUsuario = uuid => {
  return api.delete(`/usuarios/${uuid}`);
}

export default api;
