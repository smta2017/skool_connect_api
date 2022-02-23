<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMaritalStatusAPIRequest;
use App\Http\Requests\API\UpdateMaritalStatusAPIRequest;
use App\Models\MaritalStatus;
use App\Repositories\MaritalStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MaritalStatusResource;
use Response;

/**
 * Class MaritalStatusController
 * @package App\Http\Controllers\API
 */

class MaritalStatusAPIController extends AppBaseController
{
    /** @var  MaritalStatusRepository */
    private $maritalStatusRepository;

    public function __construct(MaritalStatusRepository $maritalStatusRepo)
    {
        $this->maritalStatusRepository = $maritalStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/maritalStatuses",
     *      summary="Get a listing of the MaritalStatuses.",
     *      tags={"MaritalStatus"},
     *      description="Get all MaritalStatuses",
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
     *                  @SWG\Items(ref="#/definitions/MaritalStatus")
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
        $maritalStatuses = $this->maritalStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MaritalStatusResource::collection($maritalStatuses), 'Marital Statuses retrieved successfully');
    }

    /**
     * @param CreateMaritalStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/maritalStatuses",
     *      summary="Store a newly created MaritalStatus in storage",
     *      tags={"MaritalStatus"},
     *      description="Store MaritalStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MaritalStatus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MaritalStatus")
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
     *                  ref="#/definitions/MaritalStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMaritalStatusAPIRequest $request)
    {
        $input = $request->all();

        $maritalStatus = $this->maritalStatusRepository->create($input);

        return $this->sendResponse(new MaritalStatusResource($maritalStatus), 'Marital Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/maritalStatuses/{id}",
     *      summary="Display the specified MaritalStatus",
     *      tags={"MaritalStatus"},
     *      description="Get MaritalStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MaritalStatus",
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
     *                  ref="#/definitions/MaritalStatus"
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
        /** @var MaritalStatus $maritalStatus */
        $maritalStatus = $this->maritalStatusRepository->find($id);

        if (empty($maritalStatus)) {
            return $this->sendError('Marital Status not found');
        }

        return $this->sendResponse(new MaritalStatusResource($maritalStatus), 'Marital Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMaritalStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/maritalStatuses/{id}",
     *      summary="Update the specified MaritalStatus in storage",
     *      tags={"MaritalStatus"},
     *      description="Update MaritalStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MaritalStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MaritalStatus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MaritalStatus")
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
     *                  ref="#/definitions/MaritalStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMaritalStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var MaritalStatus $maritalStatus */
        $maritalStatus = $this->maritalStatusRepository->find($id);

        if (empty($maritalStatus)) {
            return $this->sendError('Marital Status not found');
        }

        $maritalStatus = $this->maritalStatusRepository->update($input, $id);

        return $this->sendResponse(new MaritalStatusResource($maritalStatus), 'MaritalStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/maritalStatuses/{id}",
     *      summary="Remove the specified MaritalStatus from storage",
     *      tags={"MaritalStatus"},
     *      description="Delete MaritalStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MaritalStatus",
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
        /** @var MaritalStatus $maritalStatus */
        $maritalStatus = $this->maritalStatusRepository->find($id);

        if (empty($maritalStatus)) {
            return $this->sendError('Marital Status not found');
        }

        $maritalStatus->delete();

        return $this->sendSuccess('Marital Status deleted successfully');
    }
}
