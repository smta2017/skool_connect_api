<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentParentAPIRequest;
use App\Http\Requests\API\UpdateStudentParentAPIRequest;
use App\Models\StudentParent;
use App\Repositories\StudentParentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentParentResource;
use Response;

/**
 * Class StudentParentController
 * @package App\Http\Controllers\API
 */

class StudentParentAPIController extends AppBaseController
{
    /** @var  StudentParentRepository */
    private $studentParentRepository;

    public function __construct(StudentParentRepository $studentParentRepo)
    {
        $this->studentParentRepository = $studentParentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentParents",
     *      summary="Get a listing of the StudentParents.",
     *      tags={"StudentParent"},
     *      description="Get all StudentParents",
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
     *                  @SWG\Items(ref="#/definitions/StudentParent")
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
        $studentParents = $this->studentParentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentParentResource::collection($studentParents), 'Student Parents retrieved successfully');
    }

    /**
     * @param CreateStudentParentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/StudentParents",
     *      summary="Store a newly created StudentParent in storage",
     *      tags={"StudentParent"},
     *      description="Store StudentParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentParent that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentParent")
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
     *                  ref="#/definitions/StudentParent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentParentAPIRequest $request)
    {
        $input = $request->all();

        $studentParent = $this->studentParentRepository->create($input);

        return $this->sendResponse(new StudentParentResource($studentParent), 'Student Parent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentParents/{id}",
     *      summary="Display the specified StudentParent",
     *      tags={"StudentParent"},
     *      description="Get StudentParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentParent",
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
     *                  ref="#/definitions/StudentParent"
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
        /** @var StudentParent $studentParent */
        $studentParent = $this->studentParentRepository->find($id);

        if (empty($studentParent)) {
            return $this->sendError('Student Parent not found');
        }

        return $this->sendResponse(new StudentParentResource($studentParent), 'Student Parent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentParentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/StudentParents/{id}",
     *      summary="Update the specified StudentParent in storage",
     *      tags={"StudentParent"},
     *      description="Update StudentParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentParent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentParent that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentParent")
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
     *                  ref="#/definitions/StudentParent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentParentAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentParent $studentParent */
        $studentParent = $this->studentParentRepository->find($id);

        if (empty($studentParent)) {
            return $this->sendError('Student Parent not found');
        }

        $studentParent = $this->studentParentRepository->update($input, $id);

        return $this->sendResponse(new StudentParentResource($studentParent), 'StudentParent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/StudentParents/{id}",
     *      summary="Remove the specified StudentParent from storage",
     *      tags={"StudentParent"},
     *      description="Delete StudentParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentParent",
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
        /** @var StudentParent $studentParent */
        $studentParent = $this->studentParentRepository->find($id);

        if (empty($studentParent)) {
            return $this->sendError('Student Parent not found');
        }

        $studentParent->delete();

        return $this->sendSuccess('Student Parent deleted successfully');
    }
}
