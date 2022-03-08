<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentSiblingAPIRequest;
use App\Http\Requests\API\UpdateStudentSiblingAPIRequest;
use App\Models\StudentSibling;
use App\Repositories\StudentSiblingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentSiblingResource;
use Response;

/**
 * Class StudentSiblingController
 * @package App\Http\Controllers\API
 */

class StudentSiblingAPIController extends AppBaseController
{
    /** @var  StudentSiblingRepository */
    private $studentSiblingRepository;

    public function __construct(StudentSiblingRepository $studentSiblingRepo)
    {
        $this->studentSiblingRepository = $studentSiblingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentSiblings",
     *      summary="Get a listing of the StudentSiblings.",
     *      tags={"StudentSibling"},
     *      description="Get all StudentSiblings",
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
     *                  @SWG\Items(ref="#/definitions/StudentSibling")
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
        $studentSiblings = $this->studentSiblingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentSiblingResource::collection($studentSiblings), 'Student Siblings retrieved successfully');
    }

    /**
     * @param CreateStudentSiblingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/studentSiblings",
     *      summary="Store a newly created StudentSibling in storage",
     *      tags={"StudentSibling"},
     *      description="Store StudentSibling",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentSibling that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentSibling")
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
     *                  ref="#/definitions/StudentSibling"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentSiblingAPIRequest $request)
    {
        $input = $request->all();

        $studentSibling = $this->studentSiblingRepository->create($input);

        return $this->sendResponse(new StudentSiblingResource($studentSibling), 'Student Sibling saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentSiblings/{id}",
     *      summary="Display the specified StudentSibling",
     *      tags={"StudentSibling"},
     *      description="Get StudentSibling",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentSibling",
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
     *                  ref="#/definitions/StudentSibling"
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
        /** @var StudentSibling $studentSibling */
        $studentSibling = $this->studentSiblingRepository->find($id);

        if (empty($studentSibling)) {
            return $this->sendError('Student Sibling not found');
        }

        return $this->sendResponse(new StudentSiblingResource($studentSibling), 'Student Sibling retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentSiblingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/studentSiblings/{id}",
     *      summary="Update the specified StudentSibling in storage",
     *      tags={"StudentSibling"},
     *      description="Update StudentSibling",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentSibling",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentSibling that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentSibling")
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
     *                  ref="#/definitions/StudentSibling"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentSiblingAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentSibling $studentSibling */
        $studentSibling = $this->studentSiblingRepository->find($id);

        if (empty($studentSibling)) {
            return $this->sendError('Student Sibling not found');
        }

        $studentSibling = $this->studentSiblingRepository->update($input, $id);

        return $this->sendResponse(new StudentSiblingResource($studentSibling), 'StudentSibling updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/studentSiblings/{id}",
     *      summary="Remove the specified StudentSibling from storage",
     *      tags={"StudentSibling"},
     *      description="Delete StudentSibling",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentSibling",
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
        /** @var StudentSibling $studentSibling */
        $studentSibling = $this->studentSiblingRepository->find($id);

        if (empty($studentSibling)) {
            return $this->sendError('Student Sibling not found');
        }

        $studentSibling->delete();

        return $this->sendSuccess('Student Sibling deleted successfully');
    }
}
