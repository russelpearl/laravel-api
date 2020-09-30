<?php

namespace Tests\Feature;

use App\CEO;
use App\User;
use Tests\TestCase;
// use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

// ValidationExeption
class CEOTest extends TestCase
{
    use RefreshDatabase;

 
    
    // create
    public function testCEOCreatedSuccessfully()
    {
        $this->actingAsUser();

        $this->json('POST', 'api/ceo', $this->data(), ['Accept' => 'application/json'])
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

    // retrieve
    public function testRetrieveCEOSuccessfully()
    {
        $this->actingAsUser();
        $ceo = factory(CEO::class)->create($this->data());

        $this->json('GET', 'api/ceo/' . $ceo->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "headers" => [],
                "original" => [
                    "ceo" => [
                        "id" => 1,
                        "name" => "Susan Wojcicki",
                        "company_name" => "YouTube",
                        "company_address" => "cdo"
                    ],
                    "message" => "Retrieved successfully"
                ],
                "exception" => null
            ]);
    }

    // update 
    public function testCEOUpdatedSuccessfully()
    {
        $this->actingAsUser();
        $ceo = factory(CEO::class)->create($this->data());

        $update_info = [
            "name" => "Demo User",
            "company_name" => "Sample Company",
            "company_address" => "cdo"
        ];

        $this->json('PATCH', 'api/ceo/' . $ceo->id, $update_info, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "headers" => [],
                "original" => [
                    "ceo" => [
                        "id" => 1,
                        "name" => "Demo User",
                        "company_name" => "Sample Company",
                        "company_address" => "cdo"
                    ],
                    "message" => "Retrieved successfully"
                ],
                "exception" => null
            ]);
    }

    // delete
    public function testDeleteCEO()
    {
        $this->actingAsUser();
        $ceo = factory(CEO::class)->create($this->data());
        $this->json('DELETE', 'api/ceo/' . $ceo->id, [], ['Accept' => 'application/json'])
            ->assertSuccessful();
    }


    // private func
    private function actingAsUser()
    {
        // $this->actingAs(factory(User::class)->create());
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
    }

    private function data()
    {
        return [
            'name' => 'Susan Wojcicki',
            'company_name' => 'YouTube',
            'company_address' => 'cdo',
            'id' => '1',
        ];
    }
}
