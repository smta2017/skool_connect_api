<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentStepParent;

class StudentStepParentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_step_parents', $studentStepParent
        );

        $this->assertApiResponse($studentStepParent);
    }

    /**
     * @test
     */
    public function test_read_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_step_parents/'.$studentStepParent->id
        );

        $this->assertApiResponse($studentStepParent->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();
        $editedStudentStepParent = StudentStepParent::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_step_parents/'.$studentStepParent->id,
            $editedStudentStepParent
        );

        $this->assertApiResponse($editedStudentStepParent);
    }

    /**
     * @test
     */
    public function test_delete_student_step_parent()
    {
        $studentStepParent = StudentStepParent::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_step_parents/'.$studentStepParent->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_step_parents/'.$studentStepParent->id
        );

        $this->response->assertStatus(404);
    }
}
