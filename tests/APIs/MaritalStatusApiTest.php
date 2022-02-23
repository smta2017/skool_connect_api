<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MaritalStatus;

class MaritalStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/marital_statuses', $maritalStatus
        );

        $this->assertApiResponse($maritalStatus);
    }

    /**
     * @test
     */
    public function test_read_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/marital_statuses/'.$maritalStatus->id
        );

        $this->assertApiResponse($maritalStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();
        $editedMaritalStatus = MaritalStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/marital_statuses/'.$maritalStatus->id,
            $editedMaritalStatus
        );

        $this->assertApiResponse($editedMaritalStatus);
    }

    /**
     * @test
     */
    public function test_delete_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/marital_statuses/'.$maritalStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/marital_statuses/'.$maritalStatus->id
        );

        $this->response->assertStatus(404);
    }
}
