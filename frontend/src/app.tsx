import { useState } from "react";
import Link from "./components/Link";
import Input from "./components/Input";
import { buscarPeloNis, cadastrarCidadao } from "./services/api";


export function App() {
  const [acao, setAcao] = useState<string | null>(null);
  const [nome, setNome] = useState<string>('');
  const [nis , setNis ] = useState<string>(''); 
  const [mensagem, setMensagem] = useState('');

  const handleCadastrarClick = () => {
    setAcao('cadastrar');
  };

  const handleListarClick = () => {
    setAcao('listar');
  };

  const registrarCidadao = async (nome : string) =>{
    try {
      await cadastrarCidadao( {nome} );
      setMensagem('Cadastro realizado com sucesso');
      setNome("");
    } catch (error) {
      console.error('Erro ao cadastrar:', error);
      setMensagem('Erro ao cadastrar. Verifique o console para mais detalhes.');
    }
  }

  const listarPorNis = async (nis : string) => {
    try {
      const cidadao  = await buscarPeloNis(nis);
      setMensagem(`Cidadão encontrado: ${cidadao.data.data.nome} ,  NIS: ${cidadao.data.data.nis} ,  ID: ${cidadao.data.data.id}`);
    } catch (error) {
      console.error('Erro ao buscar pelo NIS:', error);
      setMensagem('Erro ao buscar pelo NIS. Verifique o console para mais detalhes.');
    }
  }



  const handleNomeChange = (e : any) => {
    setNome(e.target.value);
  };

  const handleNISChange = (e : any) => {
    setNis(e.target.value);
  }


  return (
    <div className="grid h-screen place-items-center bg-gray-100">
      <div className="bg-white p-8 rounded-md shadow-md">
        <h1 className="text-2xl font-bold text-center mb-6">
          Bem-vindo ao sistema de cadastro de cidadãos
        </h1>
        <h2 className="text-lg font-medium mb-4">O que deseja fazer?</h2>
        <div className="flex w-full gap-x-4">
          <Link onClick={handleCadastrarClick} text="Cadastrar um novo cidadão" />
          <Link onClick={handleListarClick} text="Fazer busca pelo NIS" />
        </div>

        {acao === 'cadastrar' && (
          <>
          <Input 
            value={nome}
            handleValueChange={handleNomeChange}
            placeholder="Digite o nome"
            type="text"
            id="nome"
            labelText="Nome:"
            onClick={() => registrarCidadao(nome)}
            buttonText="Cadastrar"
            />
            <div className="font-bold text-center mt-4 text-gray-700">{mensagem && <p>{mensagem}</p>}</div>
            </>
        )}

        {acao === 'listar' && (
          <>
          <Input 
            value={nis}
            handleValueChange={handleNISChange}
            placeholder="Digite o NIS"
            type="text"
            id="nis"
            labelText="NIS:"
            onClick={() => listarPorNis(nis)}
            buttonText="Buscar"
          />
          <div className="font-bold text-center mt-4 text-gray-700">{mensagem && <p>{mensagem}</p>}</div>
          </>
        )}
      </div>
    </div>
  )
}
