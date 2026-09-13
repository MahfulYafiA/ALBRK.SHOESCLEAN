<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_landing_page_is_public(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_protected_pages_redirect_guests_to_login(): void
    {
        $this->get('/profil')->assertRedirect(route('login'));
        $this->get('/admin/dashboard')->assertRedirect(route('login'));
        $this->get('/superadmin/dashboard')->assertRedirect(route('login'));
    }
}
