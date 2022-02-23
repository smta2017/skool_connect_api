<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParentAPIRequest;
use App\Http\Requests\API\UpdateParentAPIRequest;
use App\Models\StParent;
use App\Repositories\ParentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ParentResource;
use Response;

/**
 * Class ParentController
 * @package App\Http\Controllers\API
 */

class ParentAPIController extends AppBaseController
{
    /** @var  ParentRepository */
    private $parentRepository;

    public function __construct(ParentRepository $parentRepo)
    {
        $this->parentRepository = $parentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/parents",
     *      summary="Get a listing of the Parents.",
     *      tags={"Parent"},
     *      description="Get all Parents",
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
     *                  @SWG\Items(ref="#/definitions/Parent")
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
        $parents = $this->parentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ParentResource::collection($parents), 'Parents retrieved successfully');
    }

    /**
     * @param CreateParentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/parents",
     *      summary="Store a newly created Parent in storage",
     *      tags={"Parent"},
     *      description="Store Parent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parent that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parent")
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
     *                  ref="#/definitions/Parent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateParentAPIRequest $request)
    {
        $input = $request->all();

        $parent = $this->parentRepository->create($input);

        return $this->sendResponse(new ParentResource($parent), 'Parent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/parents/{id}",
     *      summary="Display the specified Parent",
     *      tags={"Parent"},
     *      description="Get Parent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parent",
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
     *                  ref="#/definitions/Parent"
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
        /** @var Parent $parent */
        $parent = $this->parentRepository->find($id);

        if (empty($parent)) {
            return $this->sendError('Parent not found');
        }

        return $this->sendResponse(new ParentResource($parent), 'Parent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateParentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/parents/{id}",
     *      summary="Update the specified Parent in storage",
     *      tags={"Parent"},
     *      description="Update Parent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parent that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parent")
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
     *                  ref="#/definitions/Parent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateParentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Parent $parent */
        $parent = $this->parentRepository->find($id);

        if (empty($parent)) {
            return $this->sendError('Parent not found');
        }

        $parent = $this->parentRepository->update($input, $id);

        return $this->sendResponse(new ParentResource($parent), 'Parent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/parents/{id}",
     *      summary="Remove the specified Parent from storage",
     *      tags={"Parent"},
     *      description="Delete Parent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parent",
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
        /** @var Parent $parent */
        $parent = $this->parentRepository->find($id);

        if (empty($parent)) {
            return $this->sendError('Parent not found');
        }

        $parent->delete();

        return $this->sendSuccess('Parent deleted successfully');
    }
}
