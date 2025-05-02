import api from '@/api/axios';

export const obtenerUsuarios = () => {
  return api.get('/equipos');
};