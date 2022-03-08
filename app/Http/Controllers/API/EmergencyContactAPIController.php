<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmergencyContactAPIRequest;
use App\Http\Requests\API\UpdateEmergencyContactAPIRequest;
use App\Models\EmergencyContact;
use App\Repositories\EmergencyContactRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\EmergencyContactResource;
use Response;

/**
 * Class EmergencyContactController
 * @package App\Http\Controllers\API
 */

class EmergencyContactAPIController extends AppBaseController
{
    /** @var  EmergencyContactRepository */
    private $emergencyContactRepository;

    public function __construct(EmergencyContactRepository $emergencyContactRepo)
    {
        $this->emergencyContactRepository = $emergencyContactRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/emergencyContacts",
     *      summary="Get a listing of the EmergencyContacts.",
     *      tags={"EmergencyContact"},
     *      description="Get all EmergencyContacts",
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
     *                  @SWG\Items(ref="#/definitions/EmergencyContact")
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
        $emergencyContacts = $this->emergencyContactRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(EmergencyContactResource::collection($emergencyContacts), 'Emergency Contacts retrieved successfully');
    }

    /**
     * @param CreateEmergencyContactAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/emergencyContacts",
     *      summary="Store a newly created EmergencyContact in storage",
     *      tags={"EmergencyContact"},
     *      description="Store EmergencyContact",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EmergencyContact that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EmergencyContact")
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
     *                  ref="#/definitions/EmergencyContact"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEmergencyContactAPIRequest $request)
    {
        $input = $request->all();

        $emergencyContact = $this->emergencyContactRepository->create($input);

        return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Emergency Contact saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/emergencyContacts/{id}",
     *      summary="Display the specified EmergencyContact",
     *      tags={"EmergencyContact"},
     *      description="Get EmergencyContact",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EmergencyContact",
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
     *                  ref="#/definitions/EmergencyContact"
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
        /** @var EmergencyContact $emergencyContact */
        $emergencyContact = $this->emergencyContactRepository->find($id);

        if (empty($emergencyContact)) {
            return $this->sendError('Emergency Contact not found');
        }

        return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Emergency Contact retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEmergencyContactAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/emergencyContacts/{id}",
     *      summary="Update the specified EmergencyContact in storage",
     *      tags={"EmergencyContact"},
     *      description="Update EmergencyContact",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EmergencyContact",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EmergencyContact that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EmergencyContact")
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
     *                  ref="#/definitions/EmergencyContact"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEmergencyContactAPIRequest $request)
    {
        $input = $request->all();

        /** @var EmergencyContact $emergencyContact */
        $emergencyContact = $this->emergencyContactRepository->find($id);

        if (empty($emergencyContact)) {
            return $this->sendError('Emergency Contact not found');
        }

        $emergencyContact = $this->emergencyContactRepository->update($input, $id);

        return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'EmergencyContact updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/emergencyContacts/{id}",
     *      summary="Remove the specified EmergencyContact from storage",
     *      tags={"EmergencyContact"},
     *      description="Delete EmergencyContact",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EmergencyContact",
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
        /** @var EmergencyContact $emergencyContact */
        $emergencyContact = $this->emergencyContactRepository->find($id);

        if (empty($emergencyContact)) {
            return $this->sendError('Emergency Contact not found');
        }

        $emergencyContact->delete();

        return $this->sendSuccess('Emergency Contact deleted successfully');
    }
}
