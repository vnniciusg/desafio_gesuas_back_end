import axios from 'axios';

const BASE_URL = 'http://localhost:8001/api/v1/cidadaos/';

export type createCidadaoRequest ={
    nome: string;
}

export type listarCidadaoResponse = {
    data: {
        id: number;
        nis: string;
        nome: string;
      };
    success: string;
}



export const cadastrarCidadao = async (nome : createCidadaoRequest) => {
    return await axios.post(`${BASE_URL}`, nome);
}

export const buscarPeloNis =async (nis:string)   => {
    return await axios.get(`${BASE_URL}${nis}`);
}