import Equipo from '@/utils/interfaces/InterfaceEquipos';
import Usuarios from '@/utils/interfaces/interfaceUsuarios';
import EquipoDefault from '@/utils/interfaces/InterfaceEquipos';
import app from '@/utils/firebase'
// import { ref, onMounted } from 'vue'
import { getFirestore, getDocs, addDoc, updateDoc, deleteDoc, collection, doc } from 'firebase/firestore';
const db = getFirestore(app)

export class EmpleadoServicio {
    
    async obtenerEmpleados () : Promise<Equipo[] >{
        try {
            const response = await getDocs(collection(db, 'Equipos'))
            return  response.docs.map((registro) =>( {
                id : registro.id,   
                ...registro.data()
            }))
            
            //return dataEmpleados ;
        } catch (error) {
            return [];
        }
    }


    async crearEmpleado(empleado: Equipo) {
        try {
            if (!empleado || Object.keys(empleado).length === 0) {
                throw new Error('Los datos del empleado son inválidos.');
            }

            const { id, ...datosSinId } = empleado;
            const response = await addDoc(collection(db, 'Equipos'), datosSinId);
            console.log('Empleado creado:', response.id);
    

            await this.obtenerEmpleados();
            return response;
        } catch (error) {
            console.error('Error al crear empleado:', error);
        }
    }
    
    

    async actualizadoEmpleado(id: string, nuevosDatos: object): Promise<boolean> {
        try {
            if (!id || Object.keys(nuevosDatos).length === 0) {
                throw new Error('ID inválido o datos vacíos.');
            }
    
            const docRef = doc(collection(db, 'Equipos'), id);
            await updateDoc(docRef, nuevosDatos);
            console.log('Empleado actualizado correctamente en Firebase:', id);
            return true;
        } catch (error) {
            console.error('Error al actualizar el empleado:', error);
            return false;
        }
    }
    
    

    async eliminarEmpleado(id: string): Promise<boolean> {
        try {
            console.log('Intentando eliminar empleado con id:', id);

            const docRef = doc(db, 'Equipos', id); 
            const respuesta = await deleteDoc(docRef);

            return true;
        } catch (error) {
            console.error('Error al eliminar el empleado:', error);
            return false;
        }
    }

        filtrarEmpleadoPorModulo (cards: EquipoDefault[] ){
        const cadenaRegex = localStorage.getItem("modulo")|| '' ;
    
        const empleadosPorModulo =   cards.filter((card) => card.etiqueta?.includes(cadenaRegex))
        .sort((a, b) => { 
            const numA = parseInt(a.etiqueta.split('-')[2], 10);
            const numB = parseInt(b.etiqueta.split('-')[2], 10);
            return numA - numB;
        });

        return empleadosPorModulo;
    }

}
