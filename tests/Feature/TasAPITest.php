<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Assert;

class TaskAPITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testタスクリストAPIの検証()
    {
        $response = $this->json('get','/api/tasks');

        $response->assertStatus(200);
        $data = $response->decodeResponseJson();
        Assert::assertTrue(array_key_exists("tasks",$data));
    }
}