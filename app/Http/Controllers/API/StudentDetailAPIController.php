<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentDetailAPIRequest;
use App\Http\Requests\API\UpdateStudentDetailAPIRequest;
use App\Models\StudentDetail;
use App\Repositories\StudentDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentDetailResource;
use Response;

/**
 * Class StudentDetailController
 * @package App\Http\Controllers\API
 */

class StudentDetailAPIController extends AppBaseController
{
    /** @var  StudentDetailRepository */
    private $studentDetailRepository;

    public function __construct(StudentDetailRepository $studentDetailRepo)
    {
        $this->studentDetailRepository = $studentDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentDetails",
     *      summary="Get a listing of the StudentDetails.",
     *      tags={"StudentDetail"},
     *      description="Get all StudentDetails",
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
     *                  @SWG\Items(ref="#/definitions/StudentDetail")
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
        $studentDetails = $this->studentDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentDetailResource::collection($studentDetails), 'Student Details retrieved successfully');
    }

    /**
     * @param CreateStudentDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/StudentDetails",
     *      summary="Store a newly created StudentDetail in storage",
     *      tags={"StudentDetail"},
     *      description="Store StudentDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentDetail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentDetail")
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
     *                  ref="#/definitions/StudentDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentDetailAPIRequest $request)
    {
        $input = $request->all();

        $studentDetail = $this->studentDetailRepository->create($input);

        return $this->sendResponse(new StudentDetailResource($studentDetail), 'Student Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentDetails/{id}",
     *      summary="Display the specified StudentDetail",
     *      tags={"StudentDetail"},
     *      description="Get StudentDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentDetail",
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
     *                  ref="#/definitions/StudentDetail"
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
        /** @var StudentDetail $studentDetail */
        $studentDetail = $this->studentDetailRepository->find($id);

        if (empty($studentDetail)) {
            return $this->sendError('Student Detail not found');
        }

        return $this->sendResponse(new StudentDetailResource($studentDetail), 'Student Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentDetailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/StudentDetails/{id}",
     *      summary="Update the specified StudentDetail in storage",
     *      tags={"StudentDetail"},
     *      description="Update StudentDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentDetail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentDetail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentDetail")
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
     *                  ref="#/definitions/StudentDetail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentDetail $studentDetail */
        $studentDetail = $this->studentDetailRepository->find($id);

        if (empty($studentDetail)) {
            return $this->sendError('Student Detail not found');
        }

        $studentDetail = $this->studentDetailRepository->update($input, $id);

        return $this->sendResponse(new StudentDetailResource($studentDetail), 'StudentDetail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/StudentDetails/{id}",
     *      summary="Remove the specified StudentDetail from storage",
     *      tags={"StudentDetail"},
     *      description="Delete StudentDetail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentDetail",
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
        /** @var StudentDetail $studentDetail */
        $studentDetail = $this->studentDetailRepository->find($id);

        if (empty($studentDetail)) {
            return $this->sendError('Student Detail not found');
        }

        $studentDetail->delete();

        return $this->sendSuccess('Student Detail deleted successfully');
    }
}
