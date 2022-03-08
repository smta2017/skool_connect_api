<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentPreviousSchoolAPIRequest;
use App\Http\Requests\API\UpdateStudentPreviousSchoolAPIRequest;
use App\Models\StudentPreviousSchool;
use App\Repositories\StudentPreviousSchoolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentPreviousSchoolResource;
use Response;

/**
 * Class StudentPreviousSchoolController
 * @package App\Http\Controllers\API
 */

class StudentPreviousSchoolAPIController extends AppBaseController
{
    /** @var  StudentPreviousSchoolRepository */
    private $studentPreviousSchoolRepository;

    public function __construct(StudentPreviousSchoolRepository $studentPreviousSchoolRepo)
    {
        $this->studentPreviousSchoolRepository = $studentPreviousSchoolRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentPreviousSchools",
     *      summary="Get a listing of the StudentPreviousSchools.",
     *      tags={"StudentPreviousSchool"},
     *      description="Get all StudentPreviousSchools",
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
     *                  @SWG\Items(ref="#/definitions/StudentPreviousSchool")
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
        $studentPreviousSchools = $this->studentPreviousSchoolRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentPreviousSchoolResource::collection($studentPreviousSchools), 'Student Previous Schools retrieved successfully');
    }

    /**
     * @param CreateStudentPreviousSchoolAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/studentPreviousSchools",
     *      summary="Store a newly created StudentPreviousSchool in storage",
     *      tags={"StudentPreviousSchool"},
     *      description="Store StudentPreviousSchool",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentPreviousSchool that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentPreviousSchool")
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
     *                  ref="#/definitions/StudentPreviousSchool"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentPreviousSchoolAPIRequest $request)
    {
        $input = $request->all();

        $studentPreviousSchool = $this->studentPreviousSchoolRepository->create($input);

        return $this->sendResponse(new StudentPreviousSchoolResource($studentPreviousSchool), 'Student Previous School saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/studentPreviousSchools/{id}",
     *      summary="Display the specified StudentPreviousSchool",
     *      tags={"StudentPreviousSchool"},
     *      description="Get StudentPreviousSchool",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentPreviousSchool",
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
     *                  ref="#/definitions/StudentPreviousSchool"
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
        /** @var StudentPreviousSchool $studentPreviousSchool */
        $studentPreviousSchool = $this->studentPreviousSchoolRepository->find($id);

        if (empty($studentPreviousSchool)) {
            return $this->sendError('Student Previous School not found');
        }

        return $this->sendResponse(new StudentPreviousSchoolResource($studentPreviousSchool), 'Student Previous School retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentPreviousSchoolAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/studentPreviousSchools/{id}",
     *      summary="Update the specified StudentPreviousSchool in storage",
     *      tags={"StudentPreviousSchool"},
     *      description="Update StudentPreviousSchool",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentPreviousSchool",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentPreviousSchool that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentPreviousSchool")
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
     *                  ref="#/definitions/StudentPreviousSchool"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentPreviousSchoolAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentPreviousSchool $studentPreviousSchool */
        $studentPreviousSchool = $this->studentPreviousSchoolRepository->find($id);

        if (empty($studentPreviousSchool)) {
            return $this->sendError('Student Previous School not found');
        }

        $studentPreviousSchool = $this->studentPreviousSchoolRepository->update($input, $id);

        return $this->sendResponse(new StudentPreviousSchoolResource($studentPreviousSchool), 'StudentPreviousSchool updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/studentPreviousSchools/{id}",
     *      summary="Remove the specified StudentPreviousSchool from storage",
     *      tags={"StudentPreviousSchool"},
     *      description="Delete StudentPreviousSchool",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentPreviousSchool",
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
        /** @var StudentPreviousSchool $studentPreviousSchool */
        $studentPreviousSchool = $this->studentPreviousSchoolRepository->find($id);

        if (empty($studentPreviousSchool)) {
            return $this->sendError('Student Previous School not found');
        }

        $studentPreviousSchool->delete();

        return $this->sendSuccess('Student Previous School deleted successfully');
    }
}
