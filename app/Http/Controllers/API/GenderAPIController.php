<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGenderAPIRequest;
use App\Http\Requests\API\UpdateGenderAPIRequest;
use App\Models\Gender;
use App\Repositories\GenderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\GenderResource;
use Response;

/**
 * Class GenderController
 * @package App\Http\Controllers\API
 */

class GenderAPIController extends AppBaseController
{
    /** @var  GenderRepository */
    private $genderRepository;

    public function __construct(GenderRepository $genderRepo)
    {
        $this->genderRepository = $genderRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/genders",
     *      summary="Get a listing of the Genders.",
     *      tags={"Gender"},
     *      description="Get all Genders",
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
     *                  @SWG\Items(ref="#/definitions/Gender")
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
        $genders = $this->genderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(GenderResource::collection($genders), 'Genders retrieved successfully');
    }

    /**
     * @param CreateGenderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/genders",
     *      summary="Store a newly created Gender in storage",
     *      tags={"Gender"},
     *      description="Store Gender",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gender that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gender")
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
     *                  ref="#/definitions/Gender"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGenderAPIRequest $request)
    {
        $input = $request->all();

        $gender = $this->genderRepository->create($input);

        return $this->sendResponse(new GenderResource($gender), 'Gender saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/genders/{id}",
     *      summary="Display the specified Gender",
     *      tags={"Gender"},
     *      description="Get Gender",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gender",
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
     *                  ref="#/definitions/Gender"
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
        /** @var Gender $gender */
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            return $this->sendError('Gender not found');
        }

        return $this->sendResponse(new GenderResource($gender), 'Gender retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGenderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/genders/{id}",
     *      summary="Update the specified Gender in storage",
     *      tags={"Gender"},
     *      description="Update Gender",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gender",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Gender that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Gender")
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
     *                  ref="#/definitions/Gender"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGenderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Gender $gender */
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            return $this->sendError('Gender not found');
        }

        $gender = $this->genderRepository->update($input, $id);

        return $this->sendResponse(new GenderResource($gender), 'Gender updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/genders/{id}",
     *      summary="Remove the specified Gender from storage",
     *      tags={"Gender"},
     *      description="Delete Gender",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Gender",
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
        /** @var Gender $gender */
        $gender = $this->genderRepository->find($id);

        if (empty($gender)) {
            return $this->sendError('Gender not found');
        }

        $gender->delete();

        return $this->sendSuccess('Gender deleted successfully');
    }
}
