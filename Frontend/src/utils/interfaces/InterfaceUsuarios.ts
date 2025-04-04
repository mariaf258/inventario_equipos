export interface Usuarios {
    id_usuario?: string
    name?: string
    post?: string
    contraseña?: string
    email?: string
    
    
}

export default class UsuariosDefault implements Usuarios {
    id_usuario?: "";
    name?: "";
    post?: "";
    contraseña?: "";
    email?: "";
    
}