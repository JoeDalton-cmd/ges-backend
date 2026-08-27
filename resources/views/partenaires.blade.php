<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Partenariats — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root { --noir: #111111; --blanc: #FFFFFF; --gris-grille: #D8D8D8; --gris-texte: #6B6B6B; --rouge: #E4002B; --vert: #00B37E; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille { display: grid; grid-template-columns: repeat(12, 1fr); max-width: 1280px; margin: 0 auto; border-left: 1px solid var(--gris-grille); border-right: 1px solid var(--gris-grille); }
  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }
  .partenaire { grid-column: span 4; border-top: 1px solid var(--gris-grille); padding: 24px 24px 24px 0; }
  .partenaire:nth-child(3n+1) { grid-column: 1 / 5; padding-left: 0; }
  .partenaire:nth-child(3n+2) { grid-column: 5 / 9; padding-left: 24px; }
  .partenaire:nth-child(3n)   { grid-column: 9 / 13; padding-left: 24px; }
  .part-type { font-size: 11px; text-transform: uppercase; color: var(--rouge); margin-bottom: 8px; }
  .part-nom { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
  .part-desc { font-size: 14px; color: var(--gris-texte); }

  .formulaire { grid-column: 3 / 9; border-top: 1px solid var(--gris-grille); padding: 40px 0 60px; margin-top: 20px; }
  .formulaire h2 { font-size: 22px; margin-bottom: 20px; }
  input, textarea { width: 100%; padding: 12px; border: 1px solid var(--gris-grille); margin-bottom: 12px; font-family: inherit; }
  .btn { display: inline-block; background: var(--noir); color: var(--blanc); padding: 14px 28px; border: none; font-size: 14px; text-transform: uppercase; cursor: pointer; }
  .btn:hover { background: var(--rouge); }
</style>
</head>
<body>
  <section class="grille">
    <div class="section-label mono">FEUILLE 07</div>
    <h1 class="section-titre">Nos partenaires</h1>

    @forelse ($partenaires as $partenaire)
      <article class="partenaire">
        <div class="part-type">{{ $partenaire->type ?? 'Partenaire' }}</div>
        <h2 class="part-nom">{{ $partenaire->nom }}</h2>
        <p class="part-desc">{{ $partenaire->description }}</p>
      </article>
    @empty
      <p style="grid-column:3/9;padding:20px 0;color:var(--gris-texte);">Aucun partenaire pour le moment.</p>
    @endforelse

    <div class="formulaire">
      @if (session('succes'))
        <p style="background:var(--vert);color:white;padding:16px;margin-bottom:16px;">{{ session('succes') }}</p>
      @endif

      <h2>Proposer un partenariat</h2>
      <form method="POST" action="/partenariats">
        @csrf
        <input type="text" name="nom_organisation" placeholder="Nom de votre organisation" required>
        <input type="text" name="contact_nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telephone" placeholder="Téléphone (optionnel)">
        <textarea name="message" placeholder="Décrivez votre proposition" required></textarea>
        <button type="submit" class="btn">Envoyer la proposition</button>
      </form>
    </div>
  </section>
</body>
</html>