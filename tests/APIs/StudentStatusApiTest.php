<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentStatus;

class StudentStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_status()
    {
        $studentStatus = StudentStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_statuses', $studentStatus
        );

        $this->assertApiResponse($studentStatus);
    }

    /**
     * @test
     */
    public function test_read_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_statuses/'.$studentStatus->id
        );

        $this->assertApiResponse($studentStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();
        $editedStudentStatus = StudentStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_statuses/'.$studentStatus->id,
            $editedStudentStatus
        );

        $this->assertApiResponse($editedStudentStatus);
    }

    /**
     * @test
     */
    public function test_delete_student_status()
    {
        $studentStatus = StudentStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_statuses/'.$studentStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_statuses/'.$studentStatus->id
        );

        $this->response->assertStatus(404);
    }
}
