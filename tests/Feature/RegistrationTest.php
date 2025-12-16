<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_register_page_can_be_rendered()
    {
        $this->get(route('register'))
            ->assertSeeText('Halaman Register')
            ->assertStatus(200);
    }
}
