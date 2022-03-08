<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EmergencyContact;

class EmergencyContactApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/emergency_contacts', $emergencyContact
        );

        $this->assertApiResponse($emergencyContact);
    }

    /**
     * @test
     */
    public function test_read_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/emergency_contacts/'.$emergencyContact->id
        );

        $this->assertApiResponse($emergencyContact->toArray());
    }

    /**
     * @test
     */
    public function test_update_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();
        $editedEmergencyContact = EmergencyContact::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/emergency_contacts/'.$emergencyContact->id,
            $editedEmergencyContact
        );

        $this->assertApiResponse($editedEmergencyContact);
    }

    /**
     * @test
     */
    public function test_delete_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/emergency_contacts/'.$emergencyContact->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/emergency_contacts/'.$emergencyContact->id
        );

        $this->response->assertStatus(404);
    }
}
