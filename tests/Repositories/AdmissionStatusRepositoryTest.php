<?php namespace Tests\Repositories;

use App\Models\AdmissionStatus;
use App\Repositories\AdmissionStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdmissionStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdmissionStatusRepository
     */
    protected $admissionStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->admissionStatusRepo = \App::make(AdmissionStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->make()->toArray();

        $createdAdmissionStatus = $this->admissionStatusRepo->create($admissionStatus);

        $createdAdmissionStatus = $createdAdmissionStatus->toArray();
        $this->assertArrayHasKey('id', $createdAdmissionStatus);
        $this->assertNotNull($createdAdmissionStatus['id'], 'Created AdmissionStatus must have id specified');
        $this->assertNotNull(AdmissionStatus::find($createdAdmissionStatus['id']), 'AdmissionStatus with given id must be in DB');
        $this->assertModelData($admissionStatus, $createdAdmissionStatus);
    }

    /**
     * @test read
     */
    public function test_read_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();

        $dbAdmissionStatus = $this->admissionStatusRepo->find($admissionStatus->id);

        $dbAdmissionStatus = $dbAdmissionStatus->toArray();
        $this->assertModelData($admissionStatus->toArray(), $dbAdmissionStatus);
    }

    /**
     * @test update
     */
    public function test_update_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();
        $fakeAdmissionStatus = AdmissionStatus::factory()->make()->toArray();

        $updatedAdmissionStatus = $this->admissionStatusRepo->update($fakeAdmissionStatus, $admissionStatus->id);

        $this->assertModelData($fakeAdmissionStatus, $updatedAdmissionStatus->toArray());
        $dbAdmissionStatus = $this->admissionStatusRepo->find($admissionStatus->id);
        $this->assertModelData($fakeAdmissionStatus, $dbAdmissionStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_admission_status()
    {
        $admissionStatus = AdmissionStatus::factory()->create();

        $resp = $this->admissionStatusRepo->delete($admissionStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(AdmissionStatus::find($admissionStatus->id), 'AdmissionStatus should not exist in DB');
    }
}
