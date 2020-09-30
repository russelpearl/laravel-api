<?php

namespace Tests\Feature;

use App\CEO;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

// ValidationExeption
class CEOTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp;
        Event::fake();
    }

 
    // public function testonly_logged_in_users_can_see_the_ceo_list()
    // {
    //     $response = $this->get('/ceo')
    //     ->assertRedirect('/login');
    // }
    public function testauthenticated_users_can_see_the_ceo_list()
    {
        $this->actingAsAdmin();
                $response = $this->get('/ceo')
        ->assertOK();
    }

    public function testcustomer_can_be_added_through_the_form()
    {
        $this->actingAsAdmin();

        $response = $this->post('/ceo', $this->data());
        $this->assertCount(1, CEO::all());
    }

    public function testname_is_required()
    {
        $this->actingAsAdmin();

        $response = $this->post('/ceo', array_merge($this->data(), ['name' => '']));
        $response->assertSessionHasErrors('name');
        $this->assertCount(0, CEO::all());
    }

    public function testname_is_at_least_3_characters()
    {
        $this->actingAsAdmin();

        $response = $this->post('/ceo', array_merge($this->data(), ['name' => 'a']));
        $response->assertSessionHasErrors('name');
        $this->assertCount(0, CEO::all());
    }

    public function testemail_is_required()
    {
        $this->actingAsAdmin();

        $response = $this->post('/ceo', array_merge($this->data(), ['email' => 'testtesttest']));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, CEO::all());
    }

    public function testvalid_email_is_required()
    {
        $this->actingAsAdmin();

        $response = $this->post('/ceo', array_merge($this->data(), ['email' => '']));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, CEO::all());
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

    private function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
    }
    

}  