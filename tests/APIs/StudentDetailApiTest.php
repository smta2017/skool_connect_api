<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentDetail;

class StudentDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_details', $StudentDetail
        );

        $this->assertApiResponse($StudentDetail);
    }

    /**
     * @test
     */
    public function test_read_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_details/'.$StudentDetail->id
        );

        $this->assertApiResponse($StudentDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();
        $editedStudentDetail = StudentDetail::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_details/'.$StudentDetail->id,
            $editedStudentDetail
        );

        $this->assertApiResponse($editedStudentDetail);
    }

    /**
     * @test
     */
    public function test_delete_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_details/'.$StudentDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_details/'.$StudentDetail->id
        );

        $this->response->assertStatus(404);
    }
}
