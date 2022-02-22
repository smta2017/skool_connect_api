<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Bus;

class BusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_bus()
    {
        $bus = Bus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/buses', $bus
        );

        $this->assertApiResponse($bus);
    }

    /**
     * @test
     */
    public function test_read_bus()
    {
        $bus = Bus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/buses/'.$bus->id
        );

        $this->assertApiResponse($bus->toArray());
    }

    /**
     * @test
     */
    public function test_update_bus()
    {
        $bus = Bus::factory()->create();
        $editedBus = Bus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/buses/'.$bus->id,
            $editedBus
        );

        $this->assertApiResponse($editedBus);
    }

    /**
     * @test
     */
    public function test_delete_bus()
    {
        $bus = Bus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/buses/'.$bus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/buses/'.$bus->id
        );

        $this->response->assertStatus(404);
    }
}
