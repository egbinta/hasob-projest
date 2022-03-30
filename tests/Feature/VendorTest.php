<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_all_vendor()
    {
        $this->withoutExceptionHandling();
        $this->json('GET',url('api/vendor'))
            ->assertStatus(200);
    }

    public function test_can_user_insert_vendor()
    {
        $formData = [
            "name" => "Soft Surport",
            "category" => "Software"
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',url('api/vendor/store'), $formData)
            ->assertStatus(200);
    }

    public function test_can_user_update_vendor()
    {
        $formData = [
            "name" => "Soft Surport",
            "category" => "hadware"
        ];
        $this->withoutExceptionHandling();
        $this->json('PUT',url('api/vendor/1'), $formData)
            ->assertStatus(200);
    }

    public function test_can_user_delete_vendor()
    {
        $this->withoutExceptionHandling();
        $this->json('DELETE',url('api/vendor/1'))
            ->assertStatus(200);
    }
}
