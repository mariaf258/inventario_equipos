import Modulos from '@/utils/interfaces/InterfaceModulos';
import ModuloDefault from '@/utils/interfaces/InterfaceModulos';
import app from '@/utils/firebase'
// import { ref, onMounted } from 'vue'
import { getFirestore, getDocs, addDoc, updateDoc, deleteDoc, collection, doc } from 'firebase/firestore';
const db = getFirestore(app)

export class ModuloServicio {
    
    async obtenerModulos () : Promise<Modulos[] >{
        try {
            const response = await getDocs(collection(db, 'Modulos'))
            return  response.docs.map((registro) =>( {
                id : registro.id,   
                ...registro.data()
            }))
            
            //return dataEmpleados ;
        } catch (error) {
            return [];
        }
    }


    async crearModulos(modulo: Modulos) {
        try {
            if (!modulo || Object.keys(modulo).length === 0) {
                throw new Error('Los datos del modulo son inválidos.');
            }

            const { id, ...datosSinId } = modulo;
            const response = await addDoc(collection(db, 'Modulos'), datosSinId);
            console.log('Modulo creado:', response.id);
    

            await this.obtenerModulos();
            return response;
        } catch (error) {
            console.error('Error al crear modulo:', error);
        }
    }
    
    

    async actualizadoModulos(id: string, nuevosDatos: object): Promise<boolean> {
        try {
            if (!id || Object.keys(nuevosDatos).length === 0) {
                throw new Error('ID inválido o datos vacíos.');
            }
    
            const docRef = doc(collection(db, 'Modulos'), id);
            await updateDoc(docRef, nuevosDatos);
            console.log('Modulo actualizado correctamente en Firebase:', id);
            return true;
        } catch (error) {
            console.error('Error al actualizar el modulo:', error);
            return false;
        }
    }
    
    

    async eliminarModulos(id: number): Promise<boolean> {
        try {
            const index = sections.value.findIndex((modulo) => modulo.id === id);
    
            if (index !== -1) {
                sections.value.splice(index, 1);
                console.log(`Modulo con id ${id} eliminado correctamente.`);
                return true;
            } else {
                console.warn(`Modulo con id ${id} no encontrado.`);
                return false;
            }
        } catch (error) {
            console.error('Error al eliminar el modulo:', error);
            return false;
        }
    }

    filtrarModulo (cards: ModuloDefault[] ){
        const cadenaRegex = localStorage.getItem("modulo")|| '' ;
    
        const Modulos =   cards.filter((card) => card.id?.includes(cadenaRegex))
        .sort((a, b) => { 
            const numA = parseInt(a.id.split('-')[2], 10);
            const numB = parseInt(b.id.split('-')[2], 10);
            return numA - numB;
        });

        return Modulos;
    }

}
