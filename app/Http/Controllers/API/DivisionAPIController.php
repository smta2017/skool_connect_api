<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDivisionAPIRequest;
use App\Http\Requests\API\UpdateDivisionAPIRequest;
use App\Models\Division;
use App\Repositories\DivisionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\DivisionResource;
use Response;

/**
 * Class DivisionController
 * @package App\Http\Controllers\API
 */

class DivisionAPIController extends AppBaseController
{
    /** @var  DivisionRepository */
    private $divisionRepository;

    public function __construct(DivisionRepository $divisionRepo)
    {
        $this->divisionRepository = $divisionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/divisions",
     *      summary="Get a listing of the Divisions.",
     *      tags={"Division"},
     *      description="Get all Divisions",
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
     *                  @SWG\Items(ref="#/definitions/Division")
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
        $divisions = $this->divisionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(DivisionResource::collection($divisions), 'Divisions retrieved successfully');
    }

    /**
     * @param CreateDivisionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/divisions",
     *      summary="Store a newly created Division in storage",
     *      tags={"Division"},
     *      description="Store Division",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Division that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Division")
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
     *                  ref="#/definitions/Division"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDivisionAPIRequest $request)
    {
        $input = $request->all();

        $division = $this->divisionRepository->create($input);

        return $this->sendResponse(new DivisionResource($division), 'Division saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/divisions/{id}",
     *      summary="Display the specified Division",
     *      tags={"Division"},
     *      description="Get Division",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Division",
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
     *                  ref="#/definitions/Division"
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
        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        return $this->sendResponse(new DivisionResource($division), 'Division retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDivisionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/divisions/{id}",
     *      summary="Update the specified Division in storage",
     *      tags={"Division"},
     *      description="Update Division",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Division",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Division that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Division")
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
     *                  ref="#/definitions/Division"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDivisionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        $division = $this->divisionRepository->update($input, $id);

        return $this->sendResponse(new DivisionResource($division), 'Division updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/divisions/{id}",
     *      summary="Remove the specified Division from storage",
     *      tags={"Division"},
     *      description="Delete Division",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Division",
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
        /** @var Division $division */
        $division = $this->divisionRepository->find($id);

        if (empty($division)) {
            return $this->sendError('Division not found');
        }

        $division->delete();

        return $this->sendSuccess('Division deleted successfully');
    }
}
