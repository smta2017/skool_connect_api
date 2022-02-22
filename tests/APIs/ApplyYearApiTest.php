<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ApplyYear;

class ApplyYearApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_apply_year()
    {
        $applyYear = ApplyYear::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/apply_years', $applyYear
        );

        $this->assertApiResponse($applyYear);
    }

    /**
     * @test
     */
    public function test_read_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/apply_years/'.$applyYear->id
        );

        $this->assertApiResponse($applyYear->toArray());
    }

    /**
     * @test
     */
    public function test_update_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();
        $editedApplyYear = ApplyYear::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/apply_years/'.$applyYear->id,
            $editedApplyYear
        );

        $this->assertApiResponse($editedApplyYear);
    }

    /**
     * @test
     */
    public function test_delete_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/apply_years/'.$applyYear->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/apply_years/'.$applyYear->id
        );

        $this->response->assertStatus(404);
    }
}
