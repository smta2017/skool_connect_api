<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSchoolBuildingAPIRequest;
use App\Http\Requests\API\UpdateSchoolBuildingAPIRequest;
use App\Models\SchoolBuilding;
use App\Repositories\SchoolBuildingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\SchoolBuildingResource;
use Response;

/**
 * Class SchoolBuildingController
 * @package App\Http\Controllers\API
 */

class SchoolBuildingAPIController extends AppBaseController
{
    /** @var  SchoolBuildingRepository */
    private $schoolBuildingRepository;

    public function __construct(SchoolBuildingRepository $schoolBuildingRepo)
    {
        $this->schoolBuildingRepository = $schoolBuildingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/schoolBuildings",
     *      summary="Get a listing of the SchoolBuildings.",
     *      tags={"SchoolBuilding"},
     *      description="Get all SchoolBuildings",
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
     *                  @SWG\Items(ref="#/definitions/SchoolBuilding")
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
        $schoolBuildings = $this->schoolBuildingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SchoolBuildingResource::collection($schoolBuildings), 'School Buildings retrieved successfully');
    }

    /**
     * @param CreateSchoolBuildingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/schoolBuildings",
     *      summary="Store a newly created SchoolBuilding in storage",
     *      tags={"SchoolBuilding"},
     *      description="Store SchoolBuilding",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SchoolBuilding that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SchoolBuilding")
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
     *                  ref="#/definitions/SchoolBuilding"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSchoolBuildingAPIRequest $request)
    {
        $input = $request->all();

        $schoolBuilding = $this->schoolBuildingRepository->create($input);

        return $this->sendResponse(new SchoolBuildingResource($schoolBuilding), 'School Building saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/schoolBuildings/{id}",
     *      summary="Display the specified SchoolBuilding",
     *      tags={"SchoolBuilding"},
     *      description="Get SchoolBuilding",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SchoolBuilding",
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
     *                  ref="#/definitions/SchoolBuilding"
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
        /** @var SchoolBuilding $schoolBuilding */
        $schoolBuilding = $this->schoolBuildingRepository->find($id);

        if (empty($schoolBuilding)) {
            return $this->sendError('School Building not found');
        }

        return $this->sendResponse(new SchoolBuildingResource($schoolBuilding), 'School Building retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSchoolBuildingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/schoolBuildings/{id}",
     *      summary="Update the specified SchoolBuilding in storage",
     *      tags={"SchoolBuilding"},
     *      description="Update SchoolBuilding",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SchoolBuilding",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SchoolBuilding that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SchoolBuilding")
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
     *                  ref="#/definitions/SchoolBuilding"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSchoolBuildingAPIRequest $request)
    {
        $input = $request->all();

        /** @var SchoolBuilding $schoolBuilding */
        $schoolBuilding = $this->schoolBuildingRepository->find($id);

        if (empty($schoolBuilding)) {
            return $this->sendError('School Building not found');
        }

        $schoolBuilding = $this->schoolBuildingRepository->update($input, $id);

        return $this->sendResponse(new SchoolBuildingResource($schoolBuilding), 'SchoolBuilding updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/schoolBuildings/{id}",
     *      summary="Remove the specified SchoolBuilding from storage",
     *      tags={"SchoolBuilding"},
     *      description="Delete SchoolBuilding",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SchoolBuilding",
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
        /** @var SchoolBuilding $schoolBuilding */
        $schoolBuilding = $this->schoolBuildingRepository->find($id);

        if (empty($schoolBuilding)) {
            return $this->sendError('School Building not found');
        }

        $schoolBuilding->delete();

        return $this->sendSuccess('School Building deleted successfully');
    }
}
