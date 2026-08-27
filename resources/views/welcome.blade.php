<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GES — General Electronic & Services</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --noir: #111111; --blanc: #FFFFFF;
    --gris-grille: #D8D8D8; --gris-texte: #6B6B6B;
    --rouge: #E4002B; --vert: #00B37E;
  }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); line-height: 1.4; }
  .mono { font-family: 'Courier New', monospace; letter-spacing: 0.02em; }

  .grille { display: grid; grid-template-columns: repeat(12, 1fr); max-width: 1280px; margin: 0 auto; border-left: 1px solid var(--gris-grille); border-right: 1px solid var(--gris-grille); }
  .ligne-haute { border-top: 1px solid var(--gris-grille); }
  .ligne-basse { border-bottom: 1px solid var(--gris-grille); }

  header.grille { align-items: center; padding: 24px 0; }
  .logo { grid-column: 1 / 5; font-size: 20px; font-weight: 700; letter-spacing: -0.02em; }
  .logo span { color: var(--rouge); }
  nav { grid-column: 5 / 13; display: flex; justify-content: flex-end; gap: 32px; font-size: 14px; }
  nav a { color: var(--noir); text-decoration: none; text-transform: uppercase; letter-spacing: 0.04em; }
  nav a:hover { color: var(--rouge); }

  .hero { padding: 60px 0 80px; }
  .hero-num { grid-column: 1 / 3; font-size: 13px; color: var(--gris-texte); }
  .hero-titre { grid-column: 3 / 11; font-size: clamp(36px, 6vw, 72px); font-weight: 700; line-height: 1.05; letter-spacing: -0.02em; }
  .hero-titre em { font-style: normal; color: var(--rouge); }
  .hero-sous { grid-column: 3 / 9; margin-top: 24px; font-size: 18px; color: var(--gris-texte); }
  .hero-cta { grid-column: 3 / 6; margin-top: 32px; }
  .btn { display: inline-block; background: var(--noir); color: var(--blanc); padding: 14px 28px; text-decoration: none; font-size: 14px; text-transform: uppercase; letter-spacing: 0.04em; transition: background 0.2s; }
  .btn:hover { background: var(--rouge); }
  .btn-outline { display: inline-block; border: 1px solid var(--noir); color: var(--noir); padding: 13px 28px; text-decoration: none; font-size: 14px; text-transform: uppercase; letter-spacing: 0.04em; margin-left: 12px; }

  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }

  .pilier { grid-column: span 4; border-top: 1px solid var(--gris-grille); padding: 24px 24px 40px 0; }
  .pilier:nth-child(3n+1) { grid-column: 1 / 5; padding-left: 0; }
  .pilier:nth-child(3n+2) { grid-column: 5 / 9; padding-left: 24px; }
  .pilier:nth-child(3n)   { grid-column: 9 / 13; padding-left: 24px; }
  .pilier-ref { font-size: 12px; color: var(--rouge); margin-bottom: 12px; }
  .pilier-titre { font-size: 20px; font-weight: 700; margin-bottom: 8px; }
  .pilier-texte { font-size: 14px; color: var(--gris-texte); }

  .formation { grid-column: span 4; border-top: 1px solid var(--gris-grille); padding-top: 20px; }
  .formation:nth-child(3n+1) { grid-column: 1 / 5; }
  .formation:nth-child(3n+2) { grid-column: 5 / 9; }
  .formation:nth-child(3n)   { grid-column: 9 / 13; }
  .formation-statut { display: inline-block; font-size: 11px; text-transform: uppercase; letter-spacing: 0.04em; color: var(--vert); margin-bottom: 8px; }
  .formation-titre { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
  .formation-meta { font-size: 13px; color: var(--gris-texte); margin-bottom: 16px; }
  .formation-lien { font-size: 13px; color: var(--noir); text-decoration: none; border-bottom: 1px solid var(--noir); }
  .formation-lien:hover { color: var(--rouge); border-color: var(--rouge); }

  .pub { grid-column: span 4; border-top: 1px solid var(--gris-grille); padding-top: 20px; padding-right: 24px; }
  .pub:nth-child(3n+1) { grid-column: 1 / 5; padding-left: 0; }
  .pub:nth-child(3n+2) { grid-column: 5 / 9; padding-left: 24px; }
  .pub:nth-child(3n)   { grid-column: 9 / 13; padding-left: 24px; }
  .pub-cat { font-size: 11px; text-transform: uppercase; color: var(--vert); margin-bottom: 8px; }
  .pub-titre { font-size: 16px; font-weight: 700; margin-bottom: 8px; }
  .pub-lien { font-size: 13px; color: var(--noir); text-decoration: none; border-bottom: 1px solid var(--noir); }

  .bandeau { background: var(--noir); color: var(--blanc); padding: 60px 0; margin-top: 40px; }
  .bandeau-eyebrow { grid-column: 1 / 3; font-size: 13px; color: var(--vert); }
  .bandeau-titre { grid-column: 3 / 10; font-size: 32px; font-weight: 700; line-height: 1.2; }
  .bandeau-titre span { color: var(--vert); }

  footer.grille { padding: 40px 0; }
  .footer-col { grid-column: span 3; font-size: 13px; color: var(--gris-texte); }
  .footer-col strong { display: block; color: var(--noir); margin-bottom: 8px; }
  .footer-col a { color: var(--gris-texte); text-decoration: none; }

  .vide { grid-column: 3 / 9; padding: 20px 0; color: var(--gris-texte); font-size: 14px; }

  @media (max-width: 720px) {
    .grille { grid-template-columns: repeat(4, 1fr); }
    .logo, nav, .hero-num, .hero-titre, .hero-sous, .hero-cta,
    .section-label, .section-titre, .bandeau-eyebrow, .bandeau-titre,
    .footer-col, .vide { grid-column: 1 / 5 !important; }
    .pilier:nth-child(3n+1), .pilier:nth-child(3n+2), .pilier:nth-child(3n),
    .formation:nth-child(3n+1), .formation:nth-child(3n+2), .formation:nth-child(3n),
    .pub:nth-child(3n+1), .pub:nth-child(3n+2), .pub:nth-child(3n) {
      grid-column: 1 / 5 !important; padding-left: 0;
    }
    nav { flex-direction: column; align-items: flex-start; gap: 12px; margin-top: 16px; }
    .btn-outline { margin-left: 0; margin-top: 12px; display: block; width: fit-content; }
  }
</style>
</head>
<body>

  <header class="grille ligne-basse">
    <div class="logo">GES<span>.</span></div>
    <nav>
      <a href="/formations">Formations</a>
      <a href="/pieces">Pièces</a>
      <a href="/publications">Publications</a>
      <a href="/forum">Forum</a>
      <a href="/partenariats">Partenariats</a>
      <a href="/contact">Contact</a>
    </nav>
  </header>

  <section class="grille hero">
    <div class="hero-num mono">FEUILLE 01</div>
    <h1 class="hero-titre">Nous préparons le Cameroun aux technologies automobiles de <em>demain</em>.</h1>
    <p class="hero-sous">Formation professionnelle, diagnostic avancé, maintenance hybride et électrique, pièces automobiles et mobilité durable.</p>
    <div class="hero-cta">
      <a href="/formations" class="btn">S'inscrire à une formation</a>
      <a href="/contact" class="btn-outline">Demander un diagnostic</a>
    </div>
  </section>

  <section class="grille ligne-haute" id="piliers">
    <div class="section-label mono">FEUILLE 02</div>
    <h2 class="section-titre">Nos domaines de compétence</h2>

    <article class="pilier">
      <div class="pilier-ref mono">REF. 01 / FORMATION</div>
      <h3 class="pilier-titre">Formation professionnelle</h3>
      <p class="pilier-texte">Diagnostic, hybride, électrique — des parcours conçus avec les écoles et les entreprises.</p>
    </article>
    <article class="pilier">
      <div class="pilier-ref mono">REF. 02 / GARAGE</div>
      <h3 class="pilier-titre">Garage spécialisé</h3>
      <p class="pilier-texte">Diagnostic électronique, batteries haute tension, programmation calculateurs.</p>
    </article>
    <article class="pilier">
      <div class="pilier-ref mono">REF. 03 / PIÈCES</div>
      <h3 class="pilier-titre">Pièces automobiles</h3>
      <p class="pilier-texte">Catalogue de pièces vérifiées, disponibilité en temps réel.</p>
    </article>
    <article class="pilier">
      <div class="pilier-ref mono">REF. 04 / FORUM</div>
      <h3 class="pilier-titre">Communauté technique</h3>
      <p class="pilier-texte">Étudiants, techniciens et passionnés échangent et s'entraident.</p>
    </article>
    <article class="pilier">
      <div class="pilier-ref mono">REF. 05 / MOBILITÉ</div>
      <h3 class="pilier-titre">Mobilité durable</h3>
      <p class="pilier-texte">Notre vision de la transition automobile au Cameroun.</p>
    </article>
    <article class="pilier">
      <div class="pilier-ref mono">REF. 06 / PARTENARIATS</div>
      <h3 class="pilier-titre">Partenariats</h3>
      <p class="pilier-texte">Écoles, universités et entreprises accompagnées par GES.</p>
    </article>
  </section>

  <section class="grille ligne-haute" id="formations">
    <div class="section-label mono">FEUILLE 03</div>
    <h2 class="section-titre">Formations à venir</h2>

    @forelse ($formations as $formation)
      <article class="formation">
        <div class="formation-statut">{{ $formation->statut }}</div>
        <h3 class="formation-titre">{{ $formation->titre }}</h3>
        <p class="formation-meta">{{ $formation->duree }} · {{ number_format($formation->prix, 0, ',', ' ') }} FCFA</p>
        <a href="/formations/{{ $formation->id }}" class="formation-lien">Voir détails</a>
      </article>
    @empty
      <p class="vide">Aucune formation publiée pour le moment.</p>
    @endforelse
  </section>

  <section class="grille ligne-haute" id="publications">
    <div class="section-label mono">FEUILLE 04</div>
    <h2 class="section-titre">Dernières publications</h2>

    @forelse ($publications as $publication)
      <article class="pub">
        <div class="pub-cat">{{ $publication->categorie ?? 'Actualité' }}</div>
        <h3 class="pub-titre">{{ $publication->titre }}</h3>
        <a href="/publications/{{ $publication->id }}" class="pub-lien">Lire l'article</a>
      </article>
    @empty
      <p class="vide">Aucune publication pour le moment.</p>
    @endforelse
  </section>

  <section class="grille bandeau">
    <div class="bandeau-eyebrow mono">FEUILLE 05</div>
    <h2 class="bandeau-titre">La transition vers l'hybride et l'électrique commence par une <span>expertise locale</span>.</h2>
  </section>

  <footer class="grille ligne-haute">
    <div class="footer-col"><strong>GES</strong>General Electronic & Services — Cameroun</div>
    <div class="footer-col"><strong>Contact</strong><a href="/contact">Nous contacter</a></div>
    <div class="footer-col"><strong>Communauté</strong><a href="/forum">Forum</a> · <a href="/publications">Publications</a></div>
    <div class="footer-col"><strong>© 2026</strong>Tous droits réservés</div>
  </footer>

</body>
</html>
