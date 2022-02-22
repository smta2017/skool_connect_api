<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassAPIRequest;
use App\Http\Requests\API\UpdateClassAPIRequest;
use App\Models\Class;
use App\Repositories\ClassRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ClassResource;
use Response;

/**
 * Class ClassController
 * @package App\Http\Controllers\API
 */

class ClassAPIController extends AppBaseController
{
    /** @var  ClassRepository */
    private $classRepository;

    public function __construct(ClassRepository $classRepo)
    {
        $this->classRepository = $classRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classes",
     *      summary="Get a listing of the Classes.",
     *      tags={"Class"},
     *      description="Get all Classes",
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
     *                  @SWG\Items(ref="#/definitions/Class")
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
        $classes = $this->classRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ClassResource::collection($classes), 'Classes retrieved successfully');
    }

    /**
     * @param CreateClassAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classes",
     *      summary="Store a newly created Class in storage",
     *      tags={"Class"},
     *      description="Store Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Class that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Class")
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
     *                  ref="#/definitions/Class"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClassAPIRequest $request)
    {
        $input = $request->all();

        $class = $this->classRepository->create($input);

        return $this->sendResponse(new ClassResource($class), 'Class saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classes/{id}",
     *      summary="Display the specified Class",
     *      tags={"Class"},
     *      description="Get Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Class",
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
     *                  ref="#/definitions/Class"
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
        /** @var Class $class */
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            return $this->sendError('Class not found');
        }

        return $this->sendResponse(new ClassResource($class), 'Class retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClassAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classes/{id}",
     *      summary="Update the specified Class in storage",
     *      tags={"Class"},
     *      description="Update Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Class",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Class that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Class")
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
     *                  ref="#/definitions/Class"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClassAPIRequest $request)
    {
        $input = $request->all();

        /** @var Class $class */
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            return $this->sendError('Class not found');
        }

        $class = $this->classRepository->update($input, $id);

        return $this->sendResponse(new ClassResource($class), 'Class updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classes/{id}",
     *      summary="Remove the specified Class from storage",
     *      tags={"Class"},
     *      description="Delete Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Class",
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
        /** @var Class $class */
        $class = $this->classRepository->find($id);

        if (empty($class)) {
            return $this->sendError('Class not found');
        }

        $class->delete();

        return $this->sendSuccess('Class deleted successfully');
    }
}
