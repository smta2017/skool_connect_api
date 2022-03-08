<?php namespace Tests\Repositories;

use App\Models\StudentHealthIssue;
use App\Repositories\StudentHealthIssueRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentHealthIssueRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentHealthIssueRepository
     */
    protected $StudentHealthIssueRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->StudentHealthIssueRepo = \App::make(StudentHealthIssueRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->make()->toArray();

        $createdStudentHealthIssue = $this->StudentHealthIssueRepo->create($StudentHealthIssue);

        $createdStudentHealthIssue = $createdStudentHealthIssue->toArray();
        $this->assertArrayHasKey('id', $createdStudentHealthIssue);
        $this->assertNotNull($createdStudentHealthIssue['id'], 'Created StudentHealthIssue must have id specified');
        $this->assertNotNull(StudentHealthIssue::find($createdStudentHealthIssue['id']), 'StudentHealthIssue with given id must be in DB');
        $this->assertModelData($StudentHealthIssue, $createdStudentHealthIssue);
    }

    /**
     * @test read
     */
    public function test_read_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();

        $dbStudentHealthIssue = $this->StudentHealthIssueRepo->find($StudentHealthIssue->id);

        $dbStudentHealthIssue = $dbStudentHealthIssue->toArray();
        $this->assertModelData($StudentHealthIssue->toArray(), $dbStudentHealthIssue);
    }

    /**
     * @test update
     */
    public function test_update_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();
        $fakeStudentHealthIssue = StudentHealthIssue::factory()->make()->toArray();

        $updatedStudentHealthIssue = $this->StudentHealthIssueRepo->update($fakeStudentHealthIssue, $StudentHealthIssue->id);

        $this->assertModelData($fakeStudentHealthIssue, $updatedStudentHealthIssue->toArray());
        $dbStudentHealthIssue = $this->StudentHealthIssueRepo->find($StudentHealthIssue->id);
        $this->assertModelData($fakeStudentHealthIssue, $dbStudentHealthIssue->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_health_issue()
    {
        $StudentHealthIssue = StudentHealthIssue::factory()->create();

        $resp = $this->StudentHealthIssueRepo->delete($StudentHealthIssue->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentHealthIssue::find($StudentHealthIssue->id), 'StudentHealthIssue should not exist in DB');
    }
}
