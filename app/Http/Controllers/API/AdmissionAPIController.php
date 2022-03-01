<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParentAPIRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\CreateAdmissionAPIRequest;
use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\UpdateAdmissionAPIRequest;
use App\Models\Admission;
use App\Repositories\AdmissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AdmissionResource;
use Response;

/**
 * Class AdmissionController
 * @package App\Http\Controllers\API
 */

class AdmissionAPIController extends AppBaseController
{
    /** @var  AdmissionRepository */
    private $admissionRepository;

    public function __construct(AdmissionRepository $admissionRepo)
    {
        $this->admissionRepository = $admissionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/admissions",
     *      summary="Get a listing of the Admissions.",
     *      tags={"Admission"},
     *      description="Get all Admissions",
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
     *                  @SWG\Items(ref="#/definitions/Admission")
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
        $admissions = $this->admissionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AdmissionResource::collection($admissions), 'Admissions retrieved successfully');
    }

    /**
     * @param CreateAdmissionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/admissions",
     *      summary="Store a newly created Admission in storage",
     *      tags={"Admission"},
     *      description="Store Admission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Admission that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Admission")
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
     *                  ref="#/definitions/Admission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdmissionAPIRequest $request)
    {
        $errors = [];
        $input = $request->all();
        $input['admission_status_id'] = 1;
        $stdR = new CreateStudentAPIRequest();
        $stpR = new CreateParentAPIRequest();
        $stdV = Validator::make($input['student'],$stdR->rules());
        if ($stdV->fails()) {
            $errors['student'] = $stdV->errors();
        }
        $stp1V = Validator::make($input['parent1'],$stpR->rules());
        if ($stp1V->fails()) {
            $errors['parent1'] = $stp1V->errors();
        }
        $stp2V = Validator::make($input['parent2'],$stpR->rules());
        if ($stp2V->fails()) {
            $errors['parent2'] = $stp2V->errors();
        }
        if(!empty($errors)){
            return $this->sendError($errors, 422);
        }
        $admission = $this->admissionRepository->create($input);

        return $this->sendResponse(new AdmissionResource($admission), 'Admission saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/admissions/{id}",
     *      summary="Display the specified Admission",
     *      tags={"Admission"},
     *      description="Get Admission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Admission",
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
     *                  ref="#/definitions/Admission"
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
        /** @var Admission $admission */
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            return $this->sendError('Admission not found');
        }

        return $this->sendResponse(new AdmissionResource($admission), 'Admission retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdmissionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/admissions/{id}",
     *      summary="Update the specified Admission in storage",
     *      tags={"Admission"},
     *      description="Update Admission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Admission",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Admission that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Admission")
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
     *                  ref="#/definitions/Admission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdmissionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Admission $admission */
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            return $this->sendError('Admission not found');
        }

        $admission = $this->admissionRepository->update($input, $id);

        return $this->sendResponse(new AdmissionResource($admission), 'Admission updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/admissions/{id}",
     *      summary="Remove the specified Admission from storage",
     *      tags={"Admission"},
     *      description="Delete Admission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Admission",
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
        /** @var Admission $admission */
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            return $this->sendError('Admission not found');
        }

        $admission->delete();

        return $this->sendSuccess('Admission deleted successfully');
    }

    public function change_status($id ,UpdateAdmissionAPIRequest $request){
        /** @var Admission $admission */
        $input = $request->all();
        $status = $input['status'];
        $admission = $this->admissionRepository->find($id);

        if (empty($admission)) {
            return $this->sendError('Admission not found');
        }
        $admission->status = $status;
        $admission->save();
        return $this->sendSuccess('Status updated successfully');
    }
}
