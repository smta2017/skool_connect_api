<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateStudentHealthIssueAPIRequest;
use App\Http\Requests\API\UpdateStudentHealthIssueAPIRequest;
use App\Models\StudentHealthIssue;
use App\Repositories\StudentHealthIssueRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\StudentHealthIssueResource;
use Response;

/**
 * Class StudentHealthIssueController
 * @package App\Http\Controllers\API
 */

class StudentHealthIssueAPIController extends AppBaseController
{
    /** @var  StudentHealthIssueRepository */
    private $studentHealthIssueRepository;

    public function __construct(StudentHealthIssueRepository $studentHealthIssueRepo)
    {
        $this->studentHealthIssueRepository = $studentHealthIssueRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentHealthIssues",
     *      summary="Get a listing of the StudentHealthIssues.",
     *      tags={"StudentHealthIssue"},
     *      description="Get all StudentHealthIssues",
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
     *                  @SWG\Items(ref="#/definitions/StudentHealthIssue")
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
        $studentHealthIssues = $this->studentHealthIssueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(StudentHealthIssueResource::collection($studentHealthIssues), 'Student Health Issues retrieved successfully');
    }

    /**
     * @param CreateStudentHealthIssueAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/StudentHealthIssues",
     *      summary="Store a newly created StudentHealthIssue in storage",
     *      tags={"StudentHealthIssue"},
     *      description="Store StudentHealthIssue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentHealthIssue that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentHealthIssue")
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
     *                  ref="#/definitions/StudentHealthIssue"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStudentHealthIssueAPIRequest $request)
    {
        $input = $request->all();

        $studentHealthIssue = $this->studentHealthIssueRepository->create($input);

        return $this->sendResponse(new StudentHealthIssueResource($studentHealthIssue), 'Student Health Issue saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/StudentHealthIssues/{id}",
     *      summary="Display the specified StudentHealthIssue",
     *      tags={"StudentHealthIssue"},
     *      description="Get StudentHealthIssue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentHealthIssue",
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
     *                  ref="#/definitions/StudentHealthIssue"
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
        /** @var StudentHealthIssue $studentHealthIssue */
        $studentHealthIssue = $this->studentHealthIssueRepository->find($id);

        if (empty($studentHealthIssue)) {
            return $this->sendError('Student Health Issue not found');
        }

        return $this->sendResponse(new StudentHealthIssueResource($studentHealthIssue), 'Student Health Issue retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStudentHealthIssueAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/StudentHealthIssues/{id}",
     *      summary="Update the specified StudentHealthIssue in storage",
     *      tags={"StudentHealthIssue"},
     *      description="Update StudentHealthIssue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentHealthIssue",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="StudentHealthIssue that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/StudentHealthIssue")
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
     *                  ref="#/definitions/StudentHealthIssue"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStudentHealthIssueAPIRequest $request)
    {
        $input = $request->all();

        /** @var StudentHealthIssue $studentHealthIssue */
        $studentHealthIssue = $this->studentHealthIssueRepository->find($id);

        if (empty($studentHealthIssue)) {
            return $this->sendError('Student Health Issue not found');
        }

        $studentHealthIssue = $this->studentHealthIssueRepository->update($input, $id);

        return $this->sendResponse(new StudentHealthIssueResource($studentHealthIssue), 'StudentHealthIssue updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/StudentHealthIssues/{id}",
     *      summary="Remove the specified StudentHealthIssue from storage",
     *      tags={"StudentHealthIssue"},
     *      description="Delete StudentHealthIssue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of StudentHealthIssue",
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
        /** @var StudentHealthIssue $studentHealthIssue */
        $studentHealthIssue = $this->studentHealthIssueRepository->find($id);

        if (empty($studentHealthIssue)) {
            return $this->sendError('Student Health Issue not found');
        }

        $studentHealthIssue->delete();

        return $this->sendSuccess('Student Health Issue deleted successfully');
    }
}
