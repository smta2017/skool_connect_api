<?php namespace Tests\Repositories;

use App\Models\StudentDetail;
use App\Repositories\StudentDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class StudentDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var StudentDetailRepository
     */
    protected $StudentDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->StudentDetailRepo = \App::make(StudentDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->make()->toArray();

        $createdStudentDetail = $this->StudentDetailRepo->create($StudentDetail);

        $createdStudentDetail = $createdStudentDetail->toArray();
        $this->assertArrayHasKey('id', $createdStudentDetail);
        $this->assertNotNull($createdStudentDetail['id'], 'Created StudentDetail must have id specified');
        $this->assertNotNull(StudentDetail::find($createdStudentDetail['id']), 'StudentDetail with given id must be in DB');
        $this->assertModelData($StudentDetail, $createdStudentDetail);
    }

    /**
     * @test read
     */
    public function test_read_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();

        $dbStudentDetail = $this->StudentDetailRepo->find($StudentDetail->id);

        $dbStudentDetail = $dbStudentDetail->toArray();
        $this->assertModelData($StudentDetail->toArray(), $dbStudentDetail);
    }

    /**
     * @test update
     */
    public function test_update_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();
        $fakeStudentDetail = StudentDetail::factory()->make()->toArray();

        $updatedStudentDetail = $this->StudentDetailRepo->update($fakeStudentDetail, $StudentDetail->id);

        $this->assertModelData($fakeStudentDetail, $updatedStudentDetail->toArray());
        $dbStudentDetail = $this->StudentDetailRepo->find($StudentDetail->id);
        $this->assertModelData($fakeStudentDetail, $dbStudentDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_student_detail()
    {
        $StudentDetail = StudentDetail::factory()->create();

        $resp = $this->StudentDetailRepo->delete($StudentDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(StudentDetail::find($StudentDetail->id), 'StudentDetail should not exist in DB');
    }
}
