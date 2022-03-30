<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_all_asset()
    {
        $this->withoutExceptionHandling();
        $this->json('GET',url('api/asset'))
            ->assertStatus(200);
    }

    public function test_user_insert_asset()
    {
        $formData = [
        "type" => "electronic",
        "serialNumber" => "22993oi8",
        "description" => "some asset",
        "fixedOrMovable" => "moveable",
        "picturePath" => "picsurl",
        "purchaseDate" => "20-03-2022",
        "startUseDate" => "21-03-2022",
        "purchasePrice" => "50000",
        "warantyExpiryDate" => "20-03-2023",
        "degradationInYears" => "2030",
        "currentValueInNaira" => "50000",
        "location" => "head office"
        ];
        $this->withoutExceptionHandling();
        $this->json('POST',url('api/asset/store'), $formData)
            ->assertStatus(200);
    }

    public function test_user_can_update_asset()
    {
        $formData = [
            "type" => "electronic",
            "serialNumber" => "22993oi8",
            "description" => "some asset",
            "fixedOrMovable" => "moveable",
            "picturePath" => "picsurl",
            "purchaseDate" => "20-03-2022",
            "startUseDate" => "21-03-2022",
            "purchasePrice" => "50000",
            "warantyExpiryDate" => "20-03-2023",
            "degradationInYears" => "2030",
            "currentValueInNaira" => "50000",
            "location" => "head office"
            ];
            $this->withoutExceptionHandling();
            $this->json('PUT',url('api/asset/1'), $formData)
                ->assertStatus(200);
    }

    public function test_user_can_delete_asset()
    {
        $this->withoutExceptionHandling();
        $this->json('DELETE',url('api/asset/1'))
            ->assertStatus(200);
    }
}
