<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentPreviousSchool;

class StudentPreviousSchoolApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_previous_schools', $studentPreviousSchool
        );

        $this->assertApiResponse($studentPreviousSchool);
    }

    /**
     * @test
     */
    public function test_read_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_previous_schools/'.$studentPreviousSchool->id
        );

        $this->assertApiResponse($studentPreviousSchool->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();
        $editedStudentPreviousSchool = StudentPreviousSchool::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_previous_schools/'.$studentPreviousSchool->id,
            $editedStudentPreviousSchool
        );

        $this->assertApiResponse($editedStudentPreviousSchool);
    }

    /**
     * @test
     */
    public function test_delete_student_previous_school()
    {
        $studentPreviousSchool = StudentPreviousSchool::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_previous_schools/'.$studentPreviousSchool->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_previous_schools/'.$studentPreviousSchool->id
        );

        $this->response->assertStatus(404);
    }
}
