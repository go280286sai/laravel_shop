<?php

namespace Feature;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Actions\GetParseDataClass;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\MockBuilder;
use Tests\CreatesApplication;
use Tests\TestCase;

class GetParseDataTest extends BaseTestCase
{
    use CreatesApplication;
    use WithoutMiddleware;
    use DatabaseTransactions;
    public object $obj_class;
    public function setUp(): void
    {
        parent::setUp();
        $this->obj_class = $this->getMockBuilder('App\Actions\GetParseDataClass')->getMock();
        Storage::fake('public');
    }
    /**
     * A basic feature test example.
     */
    public function test_get_files(): void
    {
        $this->obj_class->path_jsons = "";
        $this->assertFalse($this->obj_class->existsFiles());
    }

    public function test_clear_jsons()
    {
        Storage::fake('public');
        Storage::put('uploads/jsons/test.json', 'test');
        $this->assertTrue(Storage::exists('public/test.json'));
        $ob = new GetParseDataClass();
        $ob->clearJsons();
        $this->assertFalse(Storage::exists('uploads/jsons/test.json'));
    }
}
