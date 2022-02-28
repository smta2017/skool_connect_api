<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdmissionStatusAPIRequest;
use App\Http\Requests\API\UpdateAdmissionStatusAPIRequest;
use App\Models\AdmissionStatus;
use App\Repositories\AdmissionStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AdmissionStatusResource;
use Response;

/**
 * Class AdmissionStatusController
 * @package App\Http\Controllers\API
 */

class AdmissionStatusAPIController extends AppBaseController
{
    /** @var  AdmissionStatusRepository */
    private $admissionStatusRepository;

    public function __construct(AdmissionStatusRepository $admissionStatusRepo)
    {
        $this->admissionStatusRepository = $admissionStatusRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/admissionStatuses",
     *      summary="Get a listing of the AdmissionStatuses.",
     *      tags={"AdmissionStatus"},
     *      description="Get all AdmissionStatuses",
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
     *                  @SWG\Items(ref="#/definitions/AdmissionStatus")
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
        $admissionStatuses = $this->admissionStatusRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AdmissionStatusResource::collection($admissionStatuses), 'Admission Statuses retrieved successfully');
    }

    /**
     * @param CreateAdmissionStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/admissionStatuses",
     *      summary="Store a newly created AdmissionStatus in storage",
     *      tags={"AdmissionStatus"},
     *      description="Store AdmissionStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdmissionStatus that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdmissionStatus")
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
     *                  ref="#/definitions/AdmissionStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdmissionStatusAPIRequest $request)
    {
        $input = $request->all();

        $admissionStatus = $this->admissionStatusRepository->create($input);

        return $this->sendResponse(new AdmissionStatusResource($admissionStatus), 'Admission Status saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/admissionStatuses/{id}",
     *      summary="Display the specified AdmissionStatus",
     *      tags={"AdmissionStatus"},
     *      description="Get AdmissionStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdmissionStatus",
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
     *                  ref="#/definitions/AdmissionStatus"
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
        /** @var AdmissionStatus $admissionStatus */
        $admissionStatus = $this->admissionStatusRepository->find($id);

        if (empty($admissionStatus)) {
            return $this->sendError('Admission Status not found');
        }

        return $this->sendResponse(new AdmissionStatusResource($admissionStatus), 'Admission Status retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdmissionStatusAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/admissionStatuses/{id}",
     *      summary="Update the specified AdmissionStatus in storage",
     *      tags={"AdmissionStatus"},
     *      description="Update AdmissionStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdmissionStatus",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdmissionStatus that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdmissionStatus")
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
     *                  ref="#/definitions/AdmissionStatus"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdmissionStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var AdmissionStatus $admissionStatus */
        $admissionStatus = $this->admissionStatusRepository->find($id);

        if (empty($admissionStatus)) {
            return $this->sendError('Admission Status not found');
        }

        $admissionStatus = $this->admissionStatusRepository->update($input, $id);

        return $this->sendResponse(new AdmissionStatusResource($admissionStatus), 'AdmissionStatus updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/admissionStatuses/{id}",
     *      summary="Remove the specified AdmissionStatus from storage",
     *      tags={"AdmissionStatus"},
     *      description="Delete AdmissionStatus",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdmissionStatus",
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
        /** @var AdmissionStatus $admissionStatus */
        $admissionStatus = $this->admissionStatusRepository->find($id);

        if (empty($admissionStatus)) {
            return $this->sendError('Admission Status not found');
        }

        $admissionStatus->delete();

        return $this->sendSuccess('Admission Status deleted successfully');
    }
}
