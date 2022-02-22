<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Division;

class DivisionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_division()
    {
        $division = Division::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/divisions', $division
        );

        $this->assertApiResponse($division);
    }

    /**
     * @test
     */
    public function test_read_division()
    {
        $division = Division::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/divisions/'.$division->id
        );

        $this->assertApiResponse($division->toArray());
    }

    /**
     * @test
     */
    public function test_update_division()
    {
        $division = Division::factory()->create();
        $editedDivision = Division::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/divisions/'.$division->id,
            $editedDivision
        );

        $this->assertApiResponse($editedDivision);
    }

    /**
     * @test
     */
    public function test_delete_division()
    {
        $division = Division::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/divisions/'.$division->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/divisions/'.$division->id
        );

        $this->response->assertStatus(404);
    }
}
