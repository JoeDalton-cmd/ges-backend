<?php

namespace Tests\Feature;

use App\Models\CategorieForum;
use App\Models\Piece;
use App\Models\Reponse;
use App\Models\Signalement;
use App\Models\Sujet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModerationForumTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function membre(array $attrs = []): User
    {
        return User::factory()->create($attrs + ['role' => 'membre']);
    }

    private function sujet(User $auteur, array $attrs = []): Sujet
    {
        $cat = CategorieForum::firstOrCreate(['nom' => 'Général'], ['description' => 'Discussions']);

        return Sujet::create($attrs + [
            'categorie_forum_id' => $cat->id,
            'user_id' => $auteur->id,
            'titre' => 'Titre test',
            'contenu' => 'Contenu test',
        ]);
    }

    public function test_la_demande_de_disponibilite_dune_piece_fonctionne_toujours(): void
    {
        $piece = Piece::create(['nom' => 'Batterie HT', 'prix' => 1000]);

        $this->post('/demandes-pieces', [
            'piece_id' => $piece->id,
            'nom_complet' => 'Client Test',
            'telephone' => '699000000',
        ])->assertSessionHas('succes');

        $this->assertDatabaseHas('demande_pieces', ['piece_id' => $piece->id]);
    }

    public function test_un_membre_ne_peut_pas_acceder_a_ladministration(): void
    {
        $membre = $this->membre();

        $this->actingAs($membre)->get('/admin/dashboard')->assertForbidden();
        $this->actingAs($membre)->get('/admin/moderation/signalements')->assertForbidden();
        $this->actingAs($membre)->get('/admin/formations')->assertForbidden();
    }

    public function test_un_invite_est_redirige_vers_la_connexion_admin(): void
    {
        $this->get('/admin/moderation/signalements')->assertRedirect('/admin/login');
    }

    public function test_ladmin_accede_aux_pages_de_moderation(): void
    {
        $this->actingAs($this->admin());
        $this->get('/admin/dashboard')->assertOk();
        $this->get('/admin/moderation/signalements')->assertOk();
        $this->get('/admin/moderation/sujets')->assertOk();
        $this->get('/admin/moderation/membres')->assertOk();
    }

    public function test_la_connexion_admin_refuse_un_membre(): void
    {
        $membre = $this->membre(['password' => 'secret123']);

        $this->post('/admin/login', ['email' => $membre->email, 'password' => 'secret123'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_un_membre_peut_signaler_un_sujet_une_seule_fois(): void
    {
        $sujet = $this->sujet($this->membre());
        $lecteur = $this->membre();

        $this->actingAs($lecteur)->post('/forum/signaler', ['sujet_id' => $sujet->id, 'raison' => 'Spam'])->assertSessionHas('succes');
        $this->actingAs($lecteur)->post('/forum/signaler', ['sujet_id' => $sujet->id, 'raison' => 'Spam'])->assertSessionHas('succes');

        $this->assertSame(1, Signalement::count());
        $this->assertSame('nouveau', Signalement::first()->statut);
    }

    public function test_un_membre_peut_signaler_une_reponse(): void
    {
        $auteur = $this->membre();
        $sujet = $this->sujet($auteur);
        $reponse = Reponse::create(['sujet_id' => $sujet->id, 'user_id' => $auteur->id, 'contenu' => 'Hello']);

        $this->actingAs($this->membre())
            ->post('/forum/signaler', ['reponse_id' => $reponse->id, 'raison' => 'Insultes'])
            ->assertSessionHas('succes');

        $this->assertDatabaseHas('signalements', ['reponse_id' => $reponse->id, 'raison' => 'Insultes']);
    }

    public function test_un_signalement_sans_cible_est_refuse(): void
    {
        $this->actingAs($this->membre())
            ->post('/forum/signaler', ['raison' => 'Spam'])
            ->assertSessionHasErrors(['sujet_id', 'reponse_id']);
    }

    public function test_un_invite_ne_peut_pas_signaler(): void
    {
        $sujet = $this->sujet($this->membre());

        $this->post('/forum/signaler', ['sujet_id' => $sujet->id, 'raison' => 'Spam'])->assertRedirect('/admin/login');
        $this->assertSame(0, Signalement::count());
    }

    public function test_un_sujet_ferme_refuse_les_reponses(): void
    {
        $sujet = $this->sujet($this->membre(), ['ferme' => true]);

        $this->actingAs($this->membre())
            ->post("/forum/sujet/{$sujet->id}/repondre", ['contenu' => 'Je réponds'])
            ->assertSessionHasErrors('contenu');

        $this->assertSame(0, Reponse::count());
    }

    public function test_ladmin_ferme_epingle_et_supprime_un_sujet(): void
    {
        $sujet = $this->sujet($this->membre());
        $this->actingAs($this->admin());

        $this->put("/admin/moderation/sujets/{$sujet->id}/fermer")->assertRedirect();
        $this->assertTrue($sujet->fresh()->ferme);

        $this->put("/admin/moderation/sujets/{$sujet->id}/fermer");
        $this->assertFalse($sujet->fresh()->ferme);

        $this->put("/admin/moderation/sujets/{$sujet->id}/epingler");
        $this->assertTrue($sujet->fresh()->epingle);

        $this->delete("/admin/moderation/sujets/{$sujet->id}")->assertRedirect();
        $this->assertNull(Sujet::find($sujet->id));
    }

    public function test_ladmin_traite_un_signalement_et_supprime_la_reponse(): void
    {
        $auteur = $this->membre();
        $sujet = $this->sujet($auteur);
        $reponse = Reponse::create(['sujet_id' => $sujet->id, 'user_id' => $auteur->id, 'contenu' => 'Spam']);
        $signalement = Signalement::create(['reponse_id' => $reponse->id, 'user_id' => $this->membre()->id, 'raison' => 'Spam']);

        $this->actingAs($this->admin());
        $this->get('/admin/moderation/signalements')->assertOk()->assertSee('Spam');

        $this->put("/admin/moderation/signalements/{$signalement->id}/traiter")->assertRedirect();
        $this->assertSame('traite', $signalement->fresh()->statut);

        $this->delete("/admin/moderation/reponses/{$reponse->id}")->assertRedirect();
        $this->assertNull(Reponse::find($reponse->id));
    }

    public function test_la_page_signalements_affiche_le_sujet_signale(): void
    {
        $sujet = $this->sujet($this->membre(), ['titre' => 'Sujet litigieux']);
        Signalement::create(['sujet_id' => $sujet->id, 'user_id' => $this->membre()->id, 'raison' => 'Hors sujet']);

        $this->actingAs($this->admin())
            ->get('/admin/moderation/signalements')
            ->assertOk()
            ->assertSee('Sujet litigieux');
    }

    public function test_suspension_dun_membre_bloque_ses_actions_et_sa_connexion(): void
    {
        $membre = $this->membre(['password' => 'secret123']);
        $sujet = $this->sujet($this->membre());

        $this->actingAs($this->admin())->put("/admin/moderation/membres/{$membre->id}/suspendre")->assertRedirect();
        $this->assertTrue($membre->fresh()->suspendu);

        auth()->logout();
        $this->actingAs($membre->fresh())
            ->post("/forum/sujet/{$sujet->id}/repondre", ['contenu' => 'test'])
            ->assertRedirect('/forum/connexion');
        $this->assertSame(0, Reponse::count());

        $this->post('/forum/connexion', ['email' => $membre->email, 'password' => 'secret123'])
            ->assertSessionHasErrors('email');
    }

    public function test_on_ne_peut_pas_suspendre_un_admin_ni_soi_meme(): void
    {
        $admin = $this->admin();
        $autreAdmin = $this->admin();

        $this->actingAs($admin)->put("/admin/moderation/membres/{$autreAdmin->id}/suspendre")->assertSessionHasErrors('membre');
        $this->put("/admin/moderation/membres/{$admin->id}/suspendre")->assertSessionHasErrors('membre');

        $this->assertFalse($autreAdmin->fresh()->suspendu);
        $this->assertFalse($admin->fresh()->suspendu);
    }

    public function test_la_page_du_sujet_affiche_les_formulaires_de_signalement(): void
    {
        $auteur = $this->membre();
        $sujet = $this->sujet($auteur);
        Reponse::create(['sujet_id' => $sujet->id, 'user_id' => $auteur->id, 'contenu' => 'Une réponse']);

        $this->actingAs($this->membre())->get("/forum/sujet/{$sujet->id}")
            ->assertOk()
            ->assertSee('Signaler ce sujet')
            ->assertSee('Signaler cette réponse');
    }
}
