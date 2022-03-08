<?php namespace Tests\Repositories;

use App\Models\EmergencyContact;
use App\Repositories\EmergencyContactRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EmergencyContactRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmergencyContactRepository
     */
    protected $emergencyContactRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->emergencyContactRepo = \App::make(EmergencyContactRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->make()->toArray();

        $createdEmergencyContact = $this->emergencyContactRepo->create($emergencyContact);

        $createdEmergencyContact = $createdEmergencyContact->toArray();
        $this->assertArrayHasKey('id', $createdEmergencyContact);
        $this->assertNotNull($createdEmergencyContact['id'], 'Created EmergencyContact must have id specified');
        $this->assertNotNull(EmergencyContact::find($createdEmergencyContact['id']), 'EmergencyContact with given id must be in DB');
        $this->assertModelData($emergencyContact, $createdEmergencyContact);
    }

    /**
     * @test read
     */
    public function test_read_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();

        $dbEmergencyContact = $this->emergencyContactRepo->find($emergencyContact->id);

        $dbEmergencyContact = $dbEmergencyContact->toArray();
        $this->assertModelData($emergencyContact->toArray(), $dbEmergencyContact);
    }

    /**
     * @test update
     */
    public function test_update_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();
        $fakeEmergencyContact = EmergencyContact::factory()->make()->toArray();

        $updatedEmergencyContact = $this->emergencyContactRepo->update($fakeEmergencyContact, $emergencyContact->id);

        $this->assertModelData($fakeEmergencyContact, $updatedEmergencyContact->toArray());
        $dbEmergencyContact = $this->emergencyContactRepo->find($emergencyContact->id);
        $this->assertModelData($fakeEmergencyContact, $dbEmergencyContact->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_emergency_contact()
    {
        $emergencyContact = EmergencyContact::factory()->create();

        $resp = $this->emergencyContactRepo->delete($emergencyContact->id);

        $this->assertTrue($resp);
        $this->assertNull(EmergencyContact::find($emergencyContact->id), 'EmergencyContact should not exist in DB');
    }
}
