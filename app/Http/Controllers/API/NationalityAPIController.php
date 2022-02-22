<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNationalityAPIRequest;
use App\Http\Requests\API\UpdateNationalityAPIRequest;
use App\Models\Nationality;
use App\Repositories\NationalityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\NationalityResource;
use Response;

/**
 * Class NationalityController
 * @package App\Http\Controllers\API
 */

class NationalityAPIController extends AppBaseController
{
    /** @var  NationalityRepository */
    private $nationalityRepository;

    public function __construct(NationalityRepository $nationalityRepo)
    {
        $this->nationalityRepository = $nationalityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nationalities",
     *      summary="Get a listing of the Nationalities.",
     *      tags={"Nationality"},
     *      description="Get all Nationalities",
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
     *                  @SWG\Items(ref="#/definitions/Nationality")
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
        $nationalities = $this->nationalityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(NationalityResource::collection($nationalities), 'Nationalities retrieved successfully');
    }

    /**
     * @param CreateNationalityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/nationalities",
     *      summary="Store a newly created Nationality in storage",
     *      tags={"Nationality"},
     *      description="Store Nationality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Nationality that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nationality")
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
     *                  ref="#/definitions/Nationality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNationalityAPIRequest $request)
    {
        $input = $request->all();

        $nationality = $this->nationalityRepository->create($input);

        return $this->sendResponse(new NationalityResource($nationality), 'Nationality saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/nationalities/{id}",
     *      summary="Display the specified Nationality",
     *      tags={"Nationality"},
     *      description="Get Nationality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nationality",
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
     *                  ref="#/definitions/Nationality"
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
        /** @var Nationality $nationality */
        $nationality = $this->nationalityRepository->find($id);

        if (empty($nationality)) {
            return $this->sendError('Nationality not found');
        }

        return $this->sendResponse(new NationalityResource($nationality), 'Nationality retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNationalityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/nationalities/{id}",
     *      summary="Update the specified Nationality in storage",
     *      tags={"Nationality"},
     *      description="Update Nationality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nationality",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Nationality that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nationality")
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
     *                  ref="#/definitions/Nationality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNationalityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Nationality $nationality */
        $nationality = $this->nationalityRepository->find($id);

        if (empty($nationality)) {
            return $this->sendError('Nationality not found');
        }

        $nationality = $this->nationalityRepository->update($input, $id);

        return $this->sendResponse(new NationalityResource($nationality), 'Nationality updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/nationalities/{id}",
     *      summary="Remove the specified Nationality from storage",
     *      tags={"Nationality"},
     *      description="Delete Nationality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nationality",
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
        /** @var Nationality $nationality */
        $nationality = $this->nationalityRepository->find($id);

        if (empty($nationality)) {
            return $this->sendError('Nationality not found');
        }

        $nationality->delete();

        return $this->sendSuccess('Nationality deleted successfully');
    }
}
