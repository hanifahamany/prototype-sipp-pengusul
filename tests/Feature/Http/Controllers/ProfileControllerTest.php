<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    public function test_profile_page_displays_demo_data_without_authentication(): void
    {
        $this->get(route('profile.edit'))
            ->assertOk()
            ->assertViewIs('profile.edit')
            ->assertSee(' ')
            ->assertSee(' ')
            ->assertSee(' data dummy ');
    }

    public function test_profile_cannot_be_updated_while_demo_data_is_used(): void
    {
        $this->put('/profil', [
            'email_lama' => ' ',
            'email_baru' => ' ',
        ])->assertMethodNotAllowed();
    }
}