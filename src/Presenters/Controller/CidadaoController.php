<?php
use App\Domain\Entity\Cidadao;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class CidadaoController extends AbstractController
{

    #[Route("/cidadaos", name :"cadastrar_cidadao" , methods:["POST"])]
    public function cadastrar(Request $request , CadastrarCidadaoUseCase $useCase) : Response
    {
        $content = json_decode($request->getContent() , true);
        $nome = $content['nome']  ?? null;

        if (empty($nome)) {
            return new JsonResponse (
                ['error' => 'Nome invalido'], 
                Response::HTTP_BAD_REQUEST, ['Content-Type' => 'application/json;charset=UTF-8]']
            );
        }

        $cidadao = new Cidadao($nome);
        $useCase->cadastrarCidadao($cidadao);

        if (!$cidadao->getId()) {
            return new JsonResponse (
                ['error' => 'Erro ao cadastrar cidadao'], 
                Response::HTTP_INTERNAL_SERVER_ERROR, ['Content-Type' => 'application/json;charset=UTF-8]']
            );
        }

        return new JsonResponse (
            ['success' => 'Cidadao cadastrado com sucesso'], 
            Response::HTTP_CREATED, ['Content-Type' => 'application/json;charset=UTF-8]']);

    } 

    public function pesquisar(string $nis, PesquisarCidadaoUseCase $useCase): Response
    {
        if (strlen($nis) != 11) {
            return new JsonResponse (
                ['error' => 'Nis invalido'], 
                Response::HTTP_BAD_REQUEST, ['Content-Type' => 'application/json;charset=UTF-8]']
            );
        }

        $cidadao = $useCase->pesquisarCidadaoPorNis($nis);

        if (empty($cidadao)) {
            return new JsonResponse (
                ['error' => 'Cidadao nao encontrado'], 
                Response::HTTP_NOT_FOUND, ['Content-Type' => 'application/json;charset=UTF-8]']
            );
        }

        return new JsonResponse(
            [
                'success' => 'Cidadao encontrado',
                'data' => [
                    'nome' => $cidadao->getNome(),
                    'nis' => $cidadao->getNis(),
                    'id' => $cidadao->getId(),
                ],
            ],
            Response::HTTP_OK,
            ['Content-Type' => 'application/json;charset=UTF-8']
        );

    
      
    }

}