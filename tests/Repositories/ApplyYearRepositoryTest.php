<?php namespace Tests\Repositories;

use App\Models\ApplyYear;
use App\Repositories\ApplyYearRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ApplyYearRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplyYearRepository
     */
    protected $applyYearRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applyYearRepo = \App::make(ApplyYearRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_apply_year()
    {
        $applyYear = ApplyYear::factory()->make()->toArray();

        $createdApplyYear = $this->applyYearRepo->create($applyYear);

        $createdApplyYear = $createdApplyYear->toArray();
        $this->assertArrayHasKey('id', $createdApplyYear);
        $this->assertNotNull($createdApplyYear['id'], 'Created ApplyYear must have id specified');
        $this->assertNotNull(ApplyYear::find($createdApplyYear['id']), 'ApplyYear with given id must be in DB');
        $this->assertModelData($applyYear, $createdApplyYear);
    }

    /**
     * @test read
     */
    public function test_read_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();

        $dbApplyYear = $this->applyYearRepo->find($applyYear->id);

        $dbApplyYear = $dbApplyYear->toArray();
        $this->assertModelData($applyYear->toArray(), $dbApplyYear);
    }

    /**
     * @test update
     */
    public function test_update_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();
        $fakeApplyYear = ApplyYear::factory()->make()->toArray();

        $updatedApplyYear = $this->applyYearRepo->update($fakeApplyYear, $applyYear->id);

        $this->assertModelData($fakeApplyYear, $updatedApplyYear->toArray());
        $dbApplyYear = $this->applyYearRepo->find($applyYear->id);
        $this->assertModelData($fakeApplyYear, $dbApplyYear->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_apply_year()
    {
        $applyYear = ApplyYear::factory()->create();

        $resp = $this->applyYearRepo->delete($applyYear->id);

        $this->assertTrue($resp);
        $this->assertNull(ApplyYear::find($applyYear->id), 'ApplyYear should not exist in DB');
    }
}
