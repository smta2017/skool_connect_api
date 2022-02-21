<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetestAPIRequest;
use App\Http\Requests\API\UpdatetestAPIRequest;
use App\Models\test;
use App\Repositories\testRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\testResource;
use Response;

/**
 * Class testController
 * @package App\Http\Controllers\API
 */

class testAPIController extends AppBaseController
{
    /** @var  testRepository */
    private $testRepository;

    public function __construct(testRepository $testRepo)
    {
        $this->testRepository = $testRepo;
    }

    /**
     * Display a listing of the test.
     * GET|HEAD /tests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tests = $this->testRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(testResource::collection($tests), 'Tests retrieved successfully');
    }

    /**
     * Store a newly created test in storage.
     * POST /tests
     *
     * @param CreatetestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetestAPIRequest $request)
    {
        $input = $request->all();

        $test = $this->testRepository->create($input);

        return $this->sendResponse(new testResource($test), 'Test saved successfully');
    }

    /**
     * Display the specified test.
     * GET|HEAD /tests/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        return $this->sendResponse(new testResource($test), 'Test retrieved successfully');
    }

    /**
     * Update the specified test in storage.
     * PUT/PATCH /tests/{id}
     *
     * @param int $id
     * @param UpdatetestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetestAPIRequest $request)
    {
        $input = $request->all();

        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        $test = $this->testRepository->update($input, $id);

        return $this->sendResponse(new testResource($test), 'test updated successfully');
    }

    /**
     * Remove the specified test from storage.
     * DELETE /tests/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var test $test */
        $test = $this->testRepository->find($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        $test->delete();

        return $this->sendSuccess('Test deleted successfully');
    }
}
