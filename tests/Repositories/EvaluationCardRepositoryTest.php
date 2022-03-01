<?php namespace Tests\Repositories;

use App\Models\EvaluationCard;
use App\Repositories\EvaluationCardRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EvaluationCardRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EvaluationCardRepository
     */
    protected $evaluationCardRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->evaluationCardRepo = \App::make(EvaluationCardRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->make()->toArray();

        $createdEvaluationCard = $this->evaluationCardRepo->create($evaluationCard);

        $createdEvaluationCard = $createdEvaluationCard->toArray();
        $this->assertArrayHasKey('id', $createdEvaluationCard);
        $this->assertNotNull($createdEvaluationCard['id'], 'Created EvaluationCard must have id specified');
        $this->assertNotNull(EvaluationCard::find($createdEvaluationCard['id']), 'EvaluationCard with given id must be in DB');
        $this->assertModelData($evaluationCard, $createdEvaluationCard);
    }

    /**
     * @test read
     */
    public function test_read_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();

        $dbEvaluationCard = $this->evaluationCardRepo->find($evaluationCard->id);

        $dbEvaluationCard = $dbEvaluationCard->toArray();
        $this->assertModelData($evaluationCard->toArray(), $dbEvaluationCard);
    }

    /**
     * @test update
     */
    public function test_update_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();
        $fakeEvaluationCard = EvaluationCard::factory()->make()->toArray();

        $updatedEvaluationCard = $this->evaluationCardRepo->update($fakeEvaluationCard, $evaluationCard->id);

        $this->assertModelData($fakeEvaluationCard, $updatedEvaluationCard->toArray());
        $dbEvaluationCard = $this->evaluationCardRepo->find($evaluationCard->id);
        $this->assertModelData($fakeEvaluationCard, $dbEvaluationCard->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();

        $resp = $this->evaluationCardRepo->delete($evaluationCard->id);

        $this->assertTrue($resp);
        $this->assertNull(EvaluationCard::find($evaluationCard->id), 'EvaluationCard should not exist in DB');
    }
}
