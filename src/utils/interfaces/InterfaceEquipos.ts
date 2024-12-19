export interface Equipo {
    id?:string
    name?: string
    post?: string
    etiqueta?: string
    descripcion?: string
    marca?: string
    serie?: string
    Nserial?: string
    disco?: string
    ram?: string
    estado?: string
    observacion?: string,
    
}

export default class EquipoDefault implements Equipo {
    id?:"";
    name?: "";
    post?: "";
    etiqueta?: "";
    descripcion?: "";
    marca?: "";
    serie?: "";
    Nserial?: "";
    disco?: "";
    ram?: "";
    estado?: "";
    observacion?: "";
}
