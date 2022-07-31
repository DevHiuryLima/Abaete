import axios from 'axios';

const api = axios.create({
  baseURL: 'http://192.168.1.104/Projects/Abaete/web/public/api/', // Precisa trocar IP sempre que o ip do meu do meu computador mudar.
});

export default api;