<?php namespace Tests\Repositories;

use App\Models\MaritalStatus;
use App\Repositories\MaritalStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MaritalStatusRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MaritalStatusRepository
     */
    protected $maritalStatusRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->maritalStatusRepo = \App::make(MaritalStatusRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->make()->toArray();

        $createdMaritalStatus = $this->maritalStatusRepo->create($maritalStatus);

        $createdMaritalStatus = $createdMaritalStatus->toArray();
        $this->assertArrayHasKey('id', $createdMaritalStatus);
        $this->assertNotNull($createdMaritalStatus['id'], 'Created MaritalStatus must have id specified');
        $this->assertNotNull(MaritalStatus::find($createdMaritalStatus['id']), 'MaritalStatus with given id must be in DB');
        $this->assertModelData($maritalStatus, $createdMaritalStatus);
    }

    /**
     * @test read
     */
    public function test_read_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();

        $dbMaritalStatus = $this->maritalStatusRepo->find($maritalStatus->id);

        $dbMaritalStatus = $dbMaritalStatus->toArray();
        $this->assertModelData($maritalStatus->toArray(), $dbMaritalStatus);
    }

    /**
     * @test update
     */
    public function test_update_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();
        $fakeMaritalStatus = MaritalStatus::factory()->make()->toArray();

        $updatedMaritalStatus = $this->maritalStatusRepo->update($fakeMaritalStatus, $maritalStatus->id);

        $this->assertModelData($fakeMaritalStatus, $updatedMaritalStatus->toArray());
        $dbMaritalStatus = $this->maritalStatusRepo->find($maritalStatus->id);
        $this->assertModelData($fakeMaritalStatus, $dbMaritalStatus->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_marital_status()
    {
        $maritalStatus = MaritalStatus::factory()->create();

        $resp = $this->maritalStatusRepo->delete($maritalStatus->id);

        $this->assertTrue($resp);
        $this->assertNull(MaritalStatus::find($maritalStatus->id), 'MaritalStatus should not exist in DB');
    }
}
