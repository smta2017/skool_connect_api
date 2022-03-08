<?php namespace Tests\Repositories;

use App\Models\StudentSibling;
use App\Repositories\StudentSiblingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentSiblingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentSiblingRepository
     */
    protected $studentSiblingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->studentSiblingRepo = \App::make(StudentSiblingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->make()->toArray();

        $createdStudentSibling = $this->studentSiblingRepo->create($studentSibling);

        $createdStudentSibling = $createdStudentSibling->toArray();
        $this->assertArrayHasKey('id', $createdStudentSibling);
        $this->assertNotNull($createdStudentSibling['id'], 'Created StudentSibling must have id specified');
        $this->assertNotNull(StudentSibling::find($createdStudentSibling['id']), 'StudentSibling with given id must be in DB');
        $this->assertModelData($studentSibling, $createdStudentSibling);
    }

    /**
     * @test read
     */
    public function test_read_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();

        $dbStudentSibling = $this->studentSiblingRepo->find($studentSibling->id);

        $dbStudentSibling = $dbStudentSibling->toArray();
        $this->assertModelData($studentSibling->toArray(), $dbStudentSibling);
    }

    /**
     * @test update
     */
    public function test_update_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();
        $fakeStudentSibling = StudentSibling::factory()->make()->toArray();

        $updatedStudentSibling = $this->studentSiblingRepo->update($fakeStudentSibling, $studentSibling->id);

        $this->assertModelData($fakeStudentSibling, $updatedStudentSibling->toArray());
        $dbStudentSibling = $this->studentSiblingRepo->find($studentSibling->id);
        $this->assertModelData($fakeStudentSibling, $dbStudentSibling->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_sibling()
    {
        $studentSibling = StudentSibling::factory()->create();

        $resp = $this->studentSiblingRepo->delete($studentSibling->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentSibling::find($studentSibling->id), 'StudentSibling should not exist in DB');
    }
}
