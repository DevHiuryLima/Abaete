import axios from 'axios';

const api = axios.create({
  baseURL: 'http://192.168.1.106/Projects/Abaete/web/public/api/',
  // baseURL: 'http://127.0.0.1:8000/api/', // Provavelmente aqui precisa trocar ip do local hosr pelo ip do meu computador
});

export default api;