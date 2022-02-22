<?php namespace Tests\Repositories;

use App\Models\Division;
use App\Repositories\DivisionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DivisionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DivisionRepository
     */
    protected $divisionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->divisionRepo = \App::make(DivisionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_division()
    {
        $division = Division::factory()->make()->toArray();

        $createdDivision = $this->divisionRepo->create($division);

        $createdDivision = $createdDivision->toArray();
        $this->assertArrayHasKey('id', $createdDivision);
        $this->assertNotNull($createdDivision['id'], 'Created Division must have id specified');
        $this->assertNotNull(Division::find($createdDivision['id']), 'Division with given id must be in DB');
        $this->assertModelData($division, $createdDivision);
    }

    /**
     * @test read
     */
    public function test_read_division()
    {
        $division = Division::factory()->create();

        $dbDivision = $this->divisionRepo->find($division->id);

        $dbDivision = $dbDivision->toArray();
        $this->assertModelData($division->toArray(), $dbDivision);
    }

    /**
     * @test update
     */
    public function test_update_division()
    {
        $division = Division::factory()->create();
        $fakeDivision = Division::factory()->make()->toArray();

        $updatedDivision = $this->divisionRepo->update($fakeDivision, $division->id);

        $this->assertModelData($fakeDivision, $updatedDivision->toArray());
        $dbDivision = $this->divisionRepo->find($division->id);
        $this->assertModelData($fakeDivision, $dbDivision->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_division()
    {
        $division = Division::factory()->create();

        $resp = $this->divisionRepo->delete($division->id);

        $this->assertTrue($resp);
        $this->assertNull(Division::find($division->id), 'Division should not exist in DB');
    }
}
