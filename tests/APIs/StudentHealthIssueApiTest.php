<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentHealthIssue;

class StudentHealthIssueApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_health_issues', $StudentHealthIssue
        );

        $this->assertApiResponse($StudentHealthIssue);
    }

    /**
     * @test
     */
    public function test_read_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_health_issues/'.$StudentHealthIssue->id
        );

        $this->assertApiResponse($StudentHealthIssue->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();
        $editedStudentHealthIssue = StudentHealthIssue::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_health_issues/'.$StudentHealthIssue->id,
            $editedStudentHealthIssue
        );

        $this->assertApiResponse($editedStudentHealthIssue);
    }

    /**
     * @test
     */
    public function test_delete_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_health_issues/'.$StudentHealthIssue->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_health_issues/'.$StudentHealthIssue->id
        );

        $this->response->assertStatus(404);
    }
}
