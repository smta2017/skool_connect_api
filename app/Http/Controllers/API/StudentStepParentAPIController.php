<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentStepParentAPIRequest;
use App\Http\Requests\API\UpdateStudentStepParentAPIRequest;
use App\Models\StudentStepParent;
use App\Repositories\StudentStepParentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentStepParentResource;
use Response;

/**
 * Class StudentStepParentController
 * @package App\Http\Controllers\API
 */

class StudentStepParentAPIController extends AppBaseController
{
    /** @var  StudentStepParentRepository */
    private $studentStepParentRepository;

    public function __construct(StudentStepParentRepository $studentStepParentRepo)
    {
        $this->studentStepParentRepository = $studentStepParentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentStepParents",
     *      summary="Get a listing of the StudentStepParents.",
     *      tags={"StudentStepParent"},
     *      description="Get all StudentStepParents",
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
     *                  @SWG\Items(ref="#/definitions/StudentStepParent")
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
        $studentStepParents = $this->studentStepParentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentStepParentResource::collection($studentStepParents), 'Student Step Parents retrieved successfully');
    }

    /**
     * @param CreateStudentStepParentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/studentStepParents",
     *      summary="Store a newly created StudentStepParent in storage",
     *      tags={"StudentStepParent"},
     *      description="Store StudentStepParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentStepParent that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentStepParent")
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
     *                  ref="#/definitions/StudentStepParent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentStepParentAPIRequest $request)
    {
        $input = $request->all();

        $studentStepParent = $this->studentStepParentRepository->create($input);

        return $this->sendResponse(new StudentStepParentResource($studentStepParent), 'Student Step Parent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentStepParents/{id}",
     *      summary="Display the specified StudentStepParent",
     *      tags={"StudentStepParent"},
     *      description="Get StudentStepParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStepParent",
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
     *                  ref="#/definitions/StudentStepParent"
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
        /** @var StudentStepParent $studentStepParent */
        $studentStepParent = $this->studentStepParentRepository->find($id);

        if (empty($studentStepParent)) {
            return $this->sendError('Student Step Parent not found');
        }

        return $this->sendResponse(new StudentStepParentResource($studentStepParent), 'Student Step Parent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentStepParentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/studentStepParents/{id}",
     *      summary="Update the specified StudentStepParent in storage",
     *      tags={"StudentStepParent"},
     *      description="Update StudentStepParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStepParent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentStepParent that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentStepParent")
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
     *                  ref="#/definitions/StudentStepParent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentStepParentAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentStepParent $studentStepParent */
        $studentStepParent = $this->studentStepParentRepository->find($id);

        if (empty($studentStepParent)) {
            return $this->sendError('Student Step Parent not found');
        }

        $studentStepParent = $this->studentStepParentRepository->update($input, $id);

        return $this->sendResponse(new StudentStepParentResource($studentStepParent), 'StudentStepParent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/studentStepParents/{id}",
     *      summary="Remove the specified StudentStepParent from storage",
     *      tags={"StudentStepParent"},
     *      description="Delete StudentStepParent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStepParent",
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
        /** @var StudentStepParent $studentStepParent */
        $studentStepParent = $this->studentStepParentRepository->find($id);

        if (empty($studentStepParent)) {
            return $this->sendError('Student Step Parent not found');
        }

        $studentStepParent->delete();

        return $this->sendSuccess('Student Step Parent deleted successfully');
    }
}
