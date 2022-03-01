<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEvaluationCardAPIRequest;
use App\Http\Requests\API\UpdateEvaluationCardAPIRequest;
use App\Models\EvaluationCard;
use App\Repositories\EvaluationCardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EvaluationCardResource;
use Response;

/**
 * Class EvaluationCardController
 * @package App\Http\Controllers\API
 */

class EvaluationCardAPIController extends AppBaseController
{
    /** @var  EvaluationCardRepository */
    private $evaluationCardRepository;

    public function __construct(EvaluationCardRepository $evaluationCardRepo)
    {
        $this->evaluationCardRepository = $evaluationCardRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluationCards",
     *      summary="Get a listing of the EvaluationCards.",
     *      tags={"EvaluationCard"},
     *      description="Get all EvaluationCards",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/EvaluationCard")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $evaluationCards = $this->evaluationCardRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(EvaluationCardResource::collection($evaluationCards), 'Evaluation Cards retrieved successfully');
    }

    /**
     * @param CreateEvaluationCardAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/evaluationCards",
     *      summary="Store a newly created EvaluationCard in storage",
     *      tags={"EvaluationCard"},
     *      description="Store EvaluationCard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EvaluationCard that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EvaluationCard")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/EvaluationCard"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEvaluationCardAPIRequest $request)
    {
        $input = $request->all();

        $evaluationCard = $this->evaluationCardRepository->create($input);

        return $this->sendResponse(new EvaluationCardResource($evaluationCard), 'Evaluation Card saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluationCards/{id}",
     *      summary="Display the specified EvaluationCard",
     *      tags={"EvaluationCard"},
     *      description="Get EvaluationCard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationCard",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/EvaluationCard"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var EvaluationCard $evaluationCard */
        $evaluationCard = $this->evaluationCardRepository->find($id);

        if (empty($evaluationCard)) {
            return $this->sendError('Evaluation Card not found');
        }

        return $this->sendResponse(new EvaluationCardResource($evaluationCard), 'Evaluation Card retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEvaluationCardAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/evaluationCards/{id}",
     *      summary="Update the specified EvaluationCard in storage",
     *      tags={"EvaluationCard"},
     *      description="Update EvaluationCard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationCard",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EvaluationCard that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EvaluationCard")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/EvaluationCard"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEvaluationCardAPIRequest $request)
    {
        $input = $request->all();

        /** @var EvaluationCard $evaluationCard */
        $evaluationCard = $this->evaluationCardRepository->find($id);

        if (empty($evaluationCard)) {
            return $this->sendError('Evaluation Card not found');
        }

        $evaluationCard = $this->evaluationCardRepository->update($input, $id);

        return $this->sendResponse(new EvaluationCardResource($evaluationCard), 'EvaluationCard updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/evaluationCards/{id}",
     *      summary="Remove the specified EvaluationCard from storage",
     *      tags={"EvaluationCard"},
     *      description="Delete EvaluationCard",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationCard",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var EvaluationCard $evaluationCard */
        $evaluationCard = $this->evaluationCardRepository->find($id);

        if (empty($evaluationCard)) {
            return $this->sendError('Evaluation Card not found');
        }

        $evaluationCard->delete();

        return $this->sendSuccess('Evaluation Card deleted successfully');
    }
}
