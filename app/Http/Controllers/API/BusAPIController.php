<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBusAPIRequest;
use App\Http\Requests\API\UpdateBusAPIRequest;
use App\Models\Bus;
use App\Repositories\BusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BusResource;
use Response;

/**
 * Class BusController
 * @package App\Http\Controllers\API
 */

class BusAPIController extends AppBaseController
{
    /** @var  BusRepository */
    private $busRepository;

    public function __construct(BusRepository $busRepo)
    {
        $this->busRepository = $busRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/buses",
     *      summary="Get a listing of the Buses.",
     *      tags={"Bus"},
     *      description="Get all Buses",
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
     *                  @SWG\Items(ref="#/definitions/Bus")
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
        $buses = $this->busRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BusResource::collection($buses), 'Buses retrieved successfully');
    }

    /**
     * @param CreateBusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/buses",
     *      summary="Store a newly created Bus in storage",
     *      tags={"Bus"},
     *      description="Store Bus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bus")
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
     *                  ref="#/definitions/Bus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBusAPIRequest $request)
    {
        $input = $request->all();

        $bus = $this->busRepository->create($input);

        return $this->sendResponse(new BusResource($bus), 'Bus saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/buses/{id}",
     *      summary="Display the specified Bus",
     *      tags={"Bus"},
     *      description="Get Bus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bus",
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
     *                  ref="#/definitions/Bus"
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
        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError('Bus not found');
        }

        return $this->sendResponse(new BusResource($bus), 'Bus retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/buses/{id}",
     *      summary="Update the specified Bus in storage",
     *      tags={"Bus"},
     *      description="Update Bus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Bus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Bus")
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
     *                  ref="#/definitions/Bus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBusAPIRequest $request)
    {
        $input = $request->all();

        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError('Bus not found');
        }

        $bus = $this->busRepository->update($input, $id);

        return $this->sendResponse(new BusResource($bus), 'Bus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/buses/{id}",
     *      summary="Remove the specified Bus from storage",
     *      tags={"Bus"},
     *      description="Delete Bus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Bus",
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
        /** @var Bus $bus */
        $bus = $this->busRepository->find($id);

        if (empty($bus)) {
            return $this->sendError('Bus not found');
        }

        $bus->delete();

        return $this->sendSuccess('Bus deleted successfully');
    }
}
