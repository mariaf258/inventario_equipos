import axios, { type AxiosInstance } from 'axios';


const api: AxiosInstance = axios.create({
    baseURL: "http://localhost:8080",
    headers: {
        'Accept': 'application/json',
    },
});

api.interceptors.request.use(config => {

    // const token = useUsuarioStore().token;

    // if (token) {
    //     config.headers['Authorization'] = `Bearer ${token}`;
    // }

    config.headers['Content-Type'] = (config.data instanceof FormData) ? 'multipart/form-data' : 'application/json';

    return config;
});

export { api };