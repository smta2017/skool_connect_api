<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StParent;

class ParentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_parent()
    {
        $parent = StParent::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/parents', $parent
        );

        $this->assertApiResponse($parent);
    }

    /**
     * @test
     */
    public function test_read_parent()
    {
        $parent = StParent::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/parents/'.$parent->id
        );

        $this->assertApiResponse($parent->toArray());
    }

    /**
     * @test
     */
    public function test_update_parent()
    {
        $parent = StParent::factory()->create();
        $editedParent = StParent::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/parents/'.$parent->id,
            $editedParent
        );

        $this->assertApiResponse($editedParent);
    }

    /**
     * @test
     */
    public function test_delete_parent()
    {
        $parent = StParent::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/parents/'.$parent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/parents/'.$parent->id
        );

        $this->response->assertStatus(404);
    }
}
