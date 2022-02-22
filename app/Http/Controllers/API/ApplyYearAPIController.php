<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApplyYearAPIRequest;
use App\Http\Requests\API\UpdateApplyYearAPIRequest;
use App\Models\ApplyYear;
use App\Repositories\ApplyYearRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ApplyYearResource;
use Response;

/**
 * Class ApplyYearController
 * @package App\Http\Controllers\API
 */

class ApplyYearAPIController extends AppBaseController
{
    /** @var  ApplyYearRepository */
    private $applyYearRepository;

    public function __construct(ApplyYearRepository $applyYearRepo)
    {
        $this->applyYearRepository = $applyYearRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/applyYears",
     *      summary="Get a listing of the ApplyYears.",
     *      tags={"ApplyYear"},
     *      description="Get all ApplyYears",
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
     *                  @SWG\Items(ref="#/definitions/ApplyYear")
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
        $applyYears = $this->applyYearRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ApplyYearResource::collection($applyYears), 'Apply Years retrieved successfully');
    }

    /**
     * @param CreateApplyYearAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/applyYears",
     *      summary="Store a newly created ApplyYear in storage",
     *      tags={"ApplyYear"},
     *      description="Store ApplyYear",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ApplyYear that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ApplyYear")
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
     *                  ref="#/definitions/ApplyYear"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApplyYearAPIRequest $request)
    {
        $input = $request->all();

        $applyYear = $this->applyYearRepository->create($input);

        return $this->sendResponse(new ApplyYearResource($applyYear), 'Apply Year saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/applyYears/{id}",
     *      summary="Display the specified ApplyYear",
     *      tags={"ApplyYear"},
     *      description="Get ApplyYear",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ApplyYear",
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
     *                  ref="#/definitions/ApplyYear"
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
        /** @var ApplyYear $applyYear */
        $applyYear = $this->applyYearRepository->find($id);

        if (empty($applyYear)) {
            return $this->sendError('Apply Year not found');
        }

        return $this->sendResponse(new ApplyYearResource($applyYear), 'Apply Year retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateApplyYearAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/applyYears/{id}",
     *      summary="Update the specified ApplyYear in storage",
     *      tags={"ApplyYear"},
     *      description="Update ApplyYear",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ApplyYear",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ApplyYear that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ApplyYear")
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
     *                  ref="#/definitions/ApplyYear"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApplyYearAPIRequest $request)
    {
        $input = $request->all();

        /** @var ApplyYear $applyYear */
        $applyYear = $this->applyYearRepository->find($id);

        if (empty($applyYear)) {
            return $this->sendError('Apply Year not found');
        }

        $applyYear = $this->applyYearRepository->update($input, $id);

        return $this->sendResponse(new ApplyYearResource($applyYear), 'ApplyYear updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/applyYears/{id}",
     *      summary="Remove the specified ApplyYear from storage",
     *      tags={"ApplyYear"},
     *      description="Delete ApplyYear",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ApplyYear",
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
        /** @var ApplyYear $applyYear */
        $applyYear = $this->applyYearRepository->find($id);

        if (empty($applyYear)) {
            return $this->sendError('Apply Year not found');
        }

        $applyYear->delete();

        return $this->sendSuccess('Apply Year deleted successfully');
    }
}
