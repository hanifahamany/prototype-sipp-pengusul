<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UsulanControllerTest extends TestCase
{
    public function test_dashboard_links_to_the_proposal_creation_page(): void
    {
        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee(route('usulan.create'))
            ->assertSee(route('usulan.show'));
    }

    public function test_create_page_displays_the_new_proposal_form_without_authentication(): void
    {
        $this->get(route('usulan.create'))
            ->assertOk()
            ->assertViewIs('usulan.create')
            ->assertSee('Form Pengajuan Satyalancana Karya Satya')
            ->assertSee('Tambah Nama Pegawai')
            ->assertSee('pegawai[0][nip]')
            ->assertSee('pegawai[0][nama]')
            ->assertSee('pegawai[0][jenis]')
            ->assertSee('pegawai[0][dokumen][surat_pengantar]')
            ->assertSeeInOrder(['</fieldset>', 'id="tambah-pegawai"']);
    }

    public function test_proposal_detail_page_renders(): void
    {
        $this->get(route('usulan.show'))
            ->assertOk()
            ->assertViewIs('usulan.show')
            ->assertSee('Detail Usulan Satyalancana')
            ->assertSee('Budi Santoso');
    }

    public function test_proposal_id_url_redirects_to_the_canonical_detail_page(): void
    {
        $this->get('/usulan/1')
            ->assertRedirect(route('usulan.show'));
    }

    public function test_canonical_proposal_detail_url_rejects_a_non_numeric_identifier(): void
    {
        $this->get('/usulan/show?id=invalid')
            ->assertNotFound();
    }

    public function test_proposal_documents_can_be_previewed_and_downloaded(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('usulan/1/dokumen_doc1.pdf', 'PDF content');

        $this->get(route('usulan.dokumen.lihat', [1, 1]))
            ->assertOk();

        $this->get(route('usulan.dokumen.unduh', [1, 1]))
            ->assertDownload('dokumen_doc1.pdf');
    }

    public function test_proposal_document_returns_not_found_when_the_file_is_missing(): void
    {
        Storage::fake('local');

        $this->get(route('usulan.dokumen.lihat', [1, 1]))
            ->assertNotFound();
    }

    public function test_proposal_update_does_not_claim_changes_were_saved(): void
    {
        $this->put(route('usulan.update', 1), [
            'pangkat_golongan' => 'Penata Muda Tk. I (III/b)',
            'jabatan' => 'Analis Kepegawaian',
            'unit_kerja' => 'Biro Organisasi dan SDM',
        ])
            ->assertRedirect(route('usulan.show'))
            ->assertSessionHas('status', 'Penyimpanan perubahan belum tersedia.');
    }
}