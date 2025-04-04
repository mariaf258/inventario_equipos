
import { ref } from 'vue';

interface datosDepartamentos {
        id: number;
        name: string;
        shortName: string;
        iconClass: string;
        path: string;
        color: string;
}

export const sections = ref<datosDepartamentos[]>([
    { id: 1, name: 'talento humano', shortName: 'th', iconClass: 'th', path: 'talentoHumano', color: '#ff6f61' },
    { id: 2, name: 'sagrilaf', shortName: 'sag', iconClass: 'sag', path: 'sagrilaft', color: '#6a5acd' },
    { id: 3, name: 'seguridad y salud en el trabajo', shortName: 'sst', iconClass: 'sst', path: 'sst', color: '#48d1cc' },
    { id: 4, name: 'gerencia', shortName: 'ge', iconClass: 'ge', path: 'gerencia', color: '#2e8b57' },
    { id: 5, name: 'departamento de contabilidad', shortName: 'ct', iconClass: 'ct', path: 'contabilidad', color: '#ffd700' },
    { id: 6, name: 'direccion de sistemas', shortName: 'ds', iconClass: 'ds', path: 'sistemas', color: '#4682b4' },
    { id: 7, name: 'direccion de compras', shortName: 'co', iconClass: 'co', path: 'compras', color: '#da70d6' },
    { id: 8, name: 'direccion tecnica', shortName: 'dt', iconClass: 'dt', path: 'direccionTecnica', color: '#8b4513' },
    { id: 9, name: 'gestion de calidad', shortName: 'gc', iconClass: 'gc', path: 'gestionCalidad', color: '#00fa9a' },
    { id: 10, name: 'comercial', shortName: 'cm', iconClass: 'cm', path: 'comercial', color: '#ff8c00' },
    { id: 11, name: 'administracion', shortName: 'ad', iconClass: 'ad', path: 'administracion', color: '#c71585' },
    { id: 12, name: 'direccion ambiental', shortName: 'am', iconClass: 'am', path: 'ambiental', color: '#32cd32' },
    { id: 13, name: 'direccion de archivo', shortName: 'ar', iconClass: 'ar', path: 'archivo', color: '#808080' },
    { id: 14, name: 'juridico', shortName: 'ju', iconClass: 'ju', path: 'juridico', color: '#800000' },
    { id: 15, name: 'audio visual', shortName: 'av', iconClass: 'av', path: 'audioVisual', color: '#ff4500' }
]);
