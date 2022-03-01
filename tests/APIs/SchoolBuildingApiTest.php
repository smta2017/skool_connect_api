<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SchoolBuilding;

class SchoolBuildingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/school_buildings', $schoolBuilding
        );

        $this->assertApiResponse($schoolBuilding);
    }

    /**
     * @test
     */
    public function test_read_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/school_buildings/'.$schoolBuilding->id
        );

        $this->assertApiResponse($schoolBuilding->toArray());
    }

    /**
     * @test
     */
    public function test_update_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();
        $editedSchoolBuilding = SchoolBuilding::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/school_buildings/'.$schoolBuilding->id,
            $editedSchoolBuilding
        );

        $this->assertApiResponse($editedSchoolBuilding);
    }

    /**
     * @test
     */
    public function test_delete_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/school_buildings/'.$schoolBuilding->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/school_buildings/'.$schoolBuilding->id
        );

        $this->response->assertStatus(404);
    }
}
