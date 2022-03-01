<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EvaluationCard;

class EvaluationCardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/evaluation_cards', $evaluationCard
        );

        $this->assertApiResponse($evaluationCard);
    }

    /**
     * @test
     */
    public function test_read_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/evaluation_cards/'.$evaluationCard->id
        );

        $this->assertApiResponse($evaluationCard->toArray());
    }

    /**
     * @test
     */
    public function test_update_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();
        $editedEvaluationCard = EvaluationCard::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/evaluation_cards/'.$evaluationCard->id,
            $editedEvaluationCard
        );

        $this->assertApiResponse($editedEvaluationCard);
    }

    /**
     * @test
     */
    public function test_delete_evaluation_card()
    {
        $evaluationCard = EvaluationCard::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/evaluation_cards/'.$evaluationCard->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/evaluation_cards/'.$evaluationCard->id
        );

        $this->response->assertStatus(404);
    }
}
