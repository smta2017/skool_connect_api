<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Nationality;

class NationalityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nationality()
    {
        $nationality = Nationality::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nationalities', $nationality
        );

        $this->assertApiResponse($nationality);
    }

    /**
     * @test
     */
    public function test_read_nationality()
    {
        $nationality = Nationality::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/nationalities/'.$nationality->id
        );

        $this->assertApiResponse($nationality->toArray());
    }

    /**
     * @test
     */
    public function test_update_nationality()
    {
        $nationality = Nationality::factory()->create();
        $editedNationality = Nationality::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nationalities/'.$nationality->id,
            $editedNationality
        );

        $this->assertApiResponse($editedNationality);
    }

    /**
     * @test
     */
    public function test_delete_nationality()
    {
        $nationality = Nationality::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nationalities/'.$nationality->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nationalities/'.$nationality->id
        );

        $this->response->assertStatus(404);
    }
}
