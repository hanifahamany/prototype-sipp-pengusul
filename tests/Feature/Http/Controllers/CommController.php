<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class CommController extends TestCase
{
    public function test_proposal_communication_page_renders_as_a_static_prototype(): void
    {
        $this->get(route('usulan.comm'))
            ->assertOk()
            ->assertViewIs('usulan.comm')
            ->assertViewHas('id', '1')
            ->assertSee(route('dashboard'))
            ->assertSee('ID Usulan: 001')
            ->assertSee('Belum ada percakapan untuk usulan ini.')
            ->assertSee('textarea id="isi-pesan" rows="2" placeholder="Ketik pesan Anda..." disabled', false)
            ->assertDontSee('<form class="border-t border-[#E5E7EB] bg-[#F9FAFB] px-6 py-5">', false)
            ->assertDontSee('Tekan Enter untuk mengirim');
    }

    public function test_legacy_proposal_communication_url_still_renders(): void
    {
        $this->get(route('usulan.comm.legacy', 1))
            ->assertOk()
            ->assertViewHas('id', '1');
    }

    public function test_dashboard_links_to_the_proposal_communication_page(): void
    {
        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee(route('usulan.comm'));
    }
}