<?php namespace Tests\Repositories;

use App\Models\SchoolBuilding;
use App\Repositories\SchoolBuildingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SchoolBuildingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SchoolBuildingRepository
     */
    protected $schoolBuildingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->schoolBuildingRepo = \App::make(SchoolBuildingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->make()->toArray();

        $createdSchoolBuilding = $this->schoolBuildingRepo->create($schoolBuilding);

        $createdSchoolBuilding = $createdSchoolBuilding->toArray();
        $this->assertArrayHasKey('id', $createdSchoolBuilding);
        $this->assertNotNull($createdSchoolBuilding['id'], 'Created SchoolBuilding must have id specified');
        $this->assertNotNull(SchoolBuilding::find($createdSchoolBuilding['id']), 'SchoolBuilding with given id must be in DB');
        $this->assertModelData($schoolBuilding, $createdSchoolBuilding);
    }

    /**
     * @test read
     */
    public function test_read_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();

        $dbSchoolBuilding = $this->schoolBuildingRepo->find($schoolBuilding->id);

        $dbSchoolBuilding = $dbSchoolBuilding->toArray();
        $this->assertModelData($schoolBuilding->toArray(), $dbSchoolBuilding);
    }

    /**
     * @test update
     */
    public function test_update_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();
        $fakeSchoolBuilding = SchoolBuilding::factory()->make()->toArray();

        $updatedSchoolBuilding = $this->schoolBuildingRepo->update($fakeSchoolBuilding, $schoolBuilding->id);

        $this->assertModelData($fakeSchoolBuilding, $updatedSchoolBuilding->toArray());
        $dbSchoolBuilding = $this->schoolBuildingRepo->find($schoolBuilding->id);
        $this->assertModelData($fakeSchoolBuilding, $dbSchoolBuilding->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_school_building()
    {
        $schoolBuilding = SchoolBuilding::factory()->create();

        $resp = $this->schoolBuildingRepo->delete($schoolBuilding->id);

        $this->assertTrue($resp);
        $this->assertNull(SchoolBuilding::find($schoolBuilding->id), 'SchoolBuilding should not exist in DB');
    }
}
