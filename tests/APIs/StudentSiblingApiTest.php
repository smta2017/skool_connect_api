<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\StudentSibling;

class StudentSiblingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/student_siblings', $studentSibling
        );

        $this->assertApiResponse($studentSibling);
    }

    /**
     * @test
     */
    public function test_read_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/student_siblings/'.$studentSibling->id
        );

        $this->assertApiResponse($studentSibling->toArray());
    }

    /**
     * @test
     */
    public function test_update_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();
        $editedStudentSibling = StudentSibling::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/student_siblings/'.$studentSibling->id,
            $editedStudentSibling
        );

        $this->assertApiResponse($editedStudentSibling);
    }

    /**
     * @test
     */
    public function test_delete_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/student_siblings/'.$studentSibling->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/student_siblings/'.$studentSibling->id
        );

        $this->response->assertStatus(404);
    }
}
