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
        $studentParent = StudentParent::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_parents', $studentParent
        );

        $this->assertApiResponse($studentParent);
    }

    /**
     * @test
     */
    public function test_read_student_parent()
    {
        $studentParent = StudentParent::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_parents/'.$studentParent->id
        );

        $this->assertApiResponse($studentParent->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_parent()
    {
        $studentParent = StudentParent::factory()->create();
        $editedStudentParent = StudentParent::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_parents/'.$studentParent->id,
            $editedStudentParent
        );

        $this->assertApiResponse($editedStudentParent);
    }

    /**
     * @test
     */
    public function test_delete_student_parent()
    {
        $studentParent = StudentParent::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_parents/'.$studentParent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_parents/'.$studentParent->id
        );

        $this->response->assertStatus(404);
    }
}
