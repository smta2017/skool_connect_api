<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentStatusAPIRequest;
use App\Http\Requests\API\UpdateStudentStatusAPIRequest;
use App\Models\StudentStatus;
use App\Repositories\StudentStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentStatusResource;
use Response;

/**
 * Class StudentStatusController
 * @package App\Http\Controllers\API
 */

class StudentStatusAPIController extends AppBaseController
{
    /** @var  StudentStatusRepository */
    private $studentStatusRepository;

    public function __construct(StudentStatusRepository $studentStatusRepo)
    {
        $this->studentStatusRepository = $studentStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentStatuses",
     *      summary="Get a listing of the StudentStatuses.",
     *      tags={"StudentStatus"},
     *      description="Get all StudentStatuses",
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
     *                  @SWG\Items(ref="#/definitions/StudentStatus")
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
        $studentStatuses = $this->studentStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentStatusResource::collection($studentStatuses), 'Student Statuses retrieved successfully');
    }

    /**
     * @param CreateStudentStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/studentStatuses",
     *      summary="Store a newly created StudentStatus in storage",
     *      tags={"StudentStatus"},
     *      description="Store StudentStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentStatus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentStatus")
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
     *                  ref="#/definitions/StudentStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentStatusAPIRequest $request)
    {
        $input = $request->all();

        $studentStatus = $this->studentStatusRepository->create($input);

        return $this->sendResponse(new StudentStatusResource($studentStatus), 'Student Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentStatuses/{id}",
     *      summary="Display the specified StudentStatus",
     *      tags={"StudentStatus"},
     *      description="Get StudentStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStatus",
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
     *                  ref="#/definitions/StudentStatus"
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
        /** @var StudentStatus $studentStatus */
        $studentStatus = $this->studentStatusRepository->find($id);

        if (empty($studentStatus)) {
            return $this->sendError('Student Status not found');
        }

        return $this->sendResponse(new StudentStatusResource($studentStatus), 'Student Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/studentStatuses/{id}",
     *      summary="Update the specified StudentStatus in storage",
     *      tags={"StudentStatus"},
     *      description="Update StudentStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentStatus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentStatus")
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
     *                  ref="#/definitions/StudentStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentStatus $studentStatus */
        $studentStatus = $this->studentStatusRepository->find($id);

        if (empty($studentStatus)) {
            return $this->sendError('Student Status not found');
        }

        $studentStatus = $this->studentStatusRepository->update($input, $id);

        return $this->sendResponse(new StudentStatusResource($studentStatus), 'StudentStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/studentStatuses/{id}",
     *      summary="Remove the specified StudentStatus from storage",
     *      tags={"StudentStatus"},
     *      description="Delete StudentStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentStatus",
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
        /** @var StudentStatus $studentStatus */
        $studentStatus = $this->studentStatusRepository->find($id);

        if (empty($studentStatus)) {
            return $this->sendError('Student Status not found');
        }

        $studentStatus->delete();

        return $this->sendSuccess('Student Status deleted successfully');
    }
}
