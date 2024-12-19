
import EquipoDefault from '@/utils/interfaces/InterfaceEquipos';

export const alertaCamposEmpleado = (datos: EquipoDefault): boolean => {
    if (
        !datos.name ||
        !datos.post ||
        !datos.etiqueta ||
        !datos.descripcion ||
        !datos.marca ||
        !datos.serie ||
        !datos.Nserial ||
        !datos.disco ||
        !datos.ram ||
        !datos.estado ||
        !datos.observacion
    ) {
        alert("Campos obligatorios");
        return false;
    }
    return true;
};
