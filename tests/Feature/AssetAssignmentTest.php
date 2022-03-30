<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssetAssignmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_all_asset_assignment()
    {
        $this->withoutExceptionHandling();
        $this->json('GET',url('api/asset-assignment'))
            ->assertStatus(200);
    }

    public function test_can_user_insert_asset_assignment()
    {
        $formData = [
            "asset_id" => "2",
            "assignmentDate" => "10-03-2022",
            "status" => "Not in use",
            "isDue" => "Yes",
            "dueDate" => "20-03-2025",
            "assignmentUserId" => "22002",
            "assignedBy" => "admin"
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',url('api/asset-assignment/store'), $formData)
            ->assertStatus(200);
    }

    public function test_can_user_update_asset_assignment()
    {
        $formData = [
            "asset_id" => "2",
            "assignmentDate" => "10-03-2022",
            "status" => "Not in use",
            "isDue" => "Yes",
            "dueDate" => "20-03-2025",
            "assignmentUserId" => "22002",
            "assignedBy" => "admin"
        ];
        $this->withoutExceptionHandling();
        $this->json('PUT',url('api/asset-assignment/1'), $formData)
            ->assertStatus(200);
    }

    public function test_can_user_delete_asset_assignment()
    {
        $this->withoutExceptionHandling();
        $this->json('DELETE',url('api/asset/1'))
            ->assertStatus(200);
    }
}
