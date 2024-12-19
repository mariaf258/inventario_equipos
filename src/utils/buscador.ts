
import { ref } from 'vue';
import type { datosDepartamentos } from '@/utils/sesionesDepartamentos';

export const filteredSections = ref<datosDepartamentos[]>([]);

export const filtrarModulos = (sections: datosDepartamentos[], inputValue: string) => {
  const respuestaInput = inputValue.toLowerCase();

  const respuesta = sections.filter(section =>
    section.name.toLowerCase().includes(respuestaInput) ||
    section.shortName.toLowerCase().includes(respuestaInput)
  );
  
  filteredSections.value = respuesta;
};
