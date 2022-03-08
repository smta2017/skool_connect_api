<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentParent;

class StudentParentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_parent()
    {
        $StudentParent = StudentParent::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_parents', $StudentParent
        );

        $this->assertApiResponse($StudentParent);
    }

    /**
     * @test
     */
    public function test_read_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_parents/'.$StudentParent->id
        );

        $this->assertApiResponse($StudentParent->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();
        $editedStudentParent = StudentParent::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_parents/'.$StudentParent->id,
            $editedStudentParent
        );

        $this->assertApiResponse($editedStudentParent);
    }

    /**
     * @test
     */
    public function test_delete_student_parent()
    {
        $StudentParent = StudentParent::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_parents/'.$StudentParent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_parents/'.$StudentParent->id
        );

        $this->response->assertStatus(404);
    }
}
