<?php

namespace Tests\Feature;

use App\CEO;
use App\User;
use Tests\TestCase;

class CEOTestcopy extends TestCase
{
       // public function testCEO_store_data()
    // {
    //     $this->actingAsUser();

    //     // non json
    //     // $response = $this->post('api/ceo', $this->data());
    //     // $response->assertSuccessful();
    // }
    
    public function testCEOCreatedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $ceoData = [
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
            "company_address" => "cdo"
        ];

        $this->json('POST', 'api/ceo', $ceoData, ['Accept' => 'application/json'])
            ->assertSuccessful()
            ->assertJson([
                "headers" => [],
                        "original" => [
                            "ceo"=> [
                                "name"=> "Susan Wojcicki",
                                "company_name"=> "YouTube",
                                "company_address"=> "cdo",
                                "id"=> 1
                            ],
                            "message"=> "Created successfully"
                        ],
                        "exception"=> null
            ]);
    }

    public function testCEOListedSuccessfully()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        factory(CEO::class)->create([
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
              "company_address" => "cdo"
        ]);

        factory(CEO::class)->create([
            "name" => "Mark Zuckerberg",
            "company_name" => "FaceBook",
              "company_address" => "cdo"
        ]);

        $this->json('GET', 'api/ceo', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "ceos" => [
                    [
                        "id" => 1,
                        "name" => "Susan Wojcicki",
                        "company_name" => "YouTube",
             "company_address" => "cdo"
                    ],
                    [
                        "id" => 2,
                        "name" => "Mark Zuckerberg",
                        "company_name" => "FaceBook",
              "company_address" => "cdo"
                    ]
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testRetrieveCEOSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $ceo = factory(CEO::class)->create([
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
             "company_address" => "cdo"
        ]);

        $this->json('GET', 'api/ceo/' . $ceo->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "ceo" => [
                    "name" => "Susan Wojcicki",
                    "company_name" => "YouTube",
                     "company_address" => "cdo"
                ],
                "message" => "Retrieved successfully"
            ]);
    }

    public function testCEOUpdatedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $ceo = factory(CEO::class)->create([
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
            "company_address" => "cdo"
        ]);

        $payload = [
            "name" => "Demo User",
            "company_name" => "Sample Company",
             "company_address" => "cdo"
        ];

        $this->json('PATCH', 'api/ceo/' . $ceo->id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "ceo" => [
                    "name" => "Demo User",
                    "company_name" => "Sample Company",
                   "company_address" => "cdo"
                ],
                "message" => "Updated successfully"
            ]);
    }

    public function testDeleteCEO()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $ceo = factory(CEO::class)->create([
            "name" => "Susan Wojcicki",
            "company_name" => "YouTube",
             "company_address" => "cdo"
        ]);

        $this->json('DELETE', 'api/ceo/' . $ceo->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}

