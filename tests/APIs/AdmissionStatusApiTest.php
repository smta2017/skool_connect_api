<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AdmissionStatus;

class AdmissionStatusApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admission_statuses', $admissionStatus
        );

        $this->assertApiResponse($admissionStatus);
    }

    /**
     * @test
     */
    public function test_read_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admission_statuses/'.$admissionStatus->id
        );

        $this->assertApiResponse($admissionStatus->toArray());
    }

    /**
     * @test
     */
    public function test_update_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();
        $editedAdmissionStatus = AdmissionStatus::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admission_statuses/'.$admissionStatus->id,
            $editedAdmissionStatus
        );

        $this->assertApiResponse($editedAdmissionStatus);
    }

    /**
     * @test
     */
    public function test_delete_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admission_statuses/'.$admissionStatus->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admission_statuses/'.$admissionStatus->id
        );

        $this->response->assertStatus(404);
    }
}
