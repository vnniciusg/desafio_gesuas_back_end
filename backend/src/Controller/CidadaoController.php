<?php
namespace App\Controller;

use App\Domain\Entity\Cidadao;
use App\Application\Cidadao\CadastrarCidadaoUseCase;
use App\Application\Cidadao\PesquisarCidadaoUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @Route("/api/v1/cidadaos", name="api_v1_cidadao_")
 */

class CidadaoController extends AbstractController
{    
    /**
     * @Route("/", name="Cadastrar novo cidadão", methods={"POST"})
     * 
     * @OA\Post(
     *    path="/api/v1/cidadaos/",
     *    summary="Cadastrar novo cidadão",
     *    @OA\RequestBody(
     *          description="Dados do cidadão",
     *          required=true,
     *          @OA\JsonContent(
     *          required={"nome"},
     *          @OA\Property(property="nome", type="string", example="John Doe"),
     *          )
     *   ),
     *   @OA\Response(
     *         response=201,
     *        description="Cidadao cadastrado com sucesso",
     *       @OA\JsonContent(
     *          @OA\Property(property="success", type="string", example="Cidadao cadastrado com sucesso")
     *      )
     *   ),
     *   @OA\Response(
     *        response=400,
     *       description="Nome inválido",
     *     @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="Nome inválido")
     *    )
     *  ),
     *     )
     *  )
     * @OA\Tag(name="Cidadaos")
     */
    public function cadastrar(Request $request, CadastrarCidadaoUseCase $useCase): Response
    {
        $content = json_decode($request->getContent(), true);
        $nome = $content['nome'] ?? null;

        if (empty($nome)) {
            return new JsonResponse (
                ['error' => 'Nome invalido'], 
                Response::HTTP_BAD_REQUEST, ['Content-Type' => 'application/json;charset=UTF-8]']
            );
        }

        $cidadao = new Cidadao($nome);
        $useCase->cadastrarCidadao($cidadao);

        return new JsonResponse (
            ['success' => 'Cidadao cadastrado com sucesso'], 
            Response::HTTP_CREATED, ['Content-Type' => 'application/json;charset=UTF-8]']);
    }



    /**
     * @Route("/{nis}", name="pesquisar", methods={"GET"})
     * @OA\Get(
     *     path="/api/v1/cidadaos/{nis}",
     *     summary="Pesquisar Cidadao",
     *     @OA\Parameter(
     *         name="nis",
     *         in="path",
     *         required=true,
     *         description="Número de Identificação Social",
     *         @OA\Schema(type="string", format="string", example="12345678901")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cidadao encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="string", example="Cidadao encontrado"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="nome", type="string", example="John Doe"),
     *                 @OA\Property(property="nis", type="string", example="12345678901"),
     *                 @OA\Property(property="id", type="integer", example="1")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Nis inválido",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Nis inválido")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cidadao não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Cidadao não encontrado")
     *         )
     *     )
     * )
     * @OA\Tag(name="Cidadaos")
     */
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