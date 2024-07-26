
import axios from 'axios';
import router from '../router'

const DEV_API='http://localhost:8000/api/v1';
const PROD_API='';


const apiUrl=process.env.NODE_ENV === 'development'?DEV_API:PROD_API;


// Creamos una instancia de axios para que se puedan compartir la misma configuración en toda la aplicación

const api = axios.create({
  baseURL: apiUrl,
});

// Interceptamos todas las solicitudes realizadas por axios


export default api;
