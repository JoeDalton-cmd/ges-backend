<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Formations — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --noir: #111111; --blanc: #FFFFFF;
    --gris-grille: #D8D8D8; --gris-texte: #6B6B6B;
    --rouge: #E4002B; --vert: #00B37E;
  }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    max-width: 1280px;
    margin: 0 auto;
    border-left: 1px solid var(--gris-grille);
    border-right: 1px solid var(--gris-grille);
  }
  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }
  .formation {
    grid-column: span 4;
    border-top: 1px solid var(--gris-grille);
    padding: 24px 24px 24px 0;
  }
  .formation:nth-child(3n+1) { grid-column: 1 / 5; padding-left: 0; }
  .formation:nth-child(3n+2) { grid-column: 5 / 9; padding-left: 24px; }
  .formation:nth-child(3n)   { grid-column: 9 / 13; padding-left: 24px; }
  .formation-statut { font-size: 11px; text-transform: uppercase; color: var(--vert); margin-bottom: 8px; }
  .formation-titre { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
  .formation-meta { font-size: 13px; color: var(--gris-texte); margin-bottom: 12px; }
  .formation-desc { font-size: 14px; color: var(--noir); }
</style>
</head>
<body>

  <section class="grille">
    <div class="section-label mono">FEUILLE 03</div>
    <h1 class="section-titre">Nos formations</h1>

    @foreach ($formations as $formation)
      <article class="formation">
        <div class="formation-statut">{{ $formation->statut }}</div>
        <h2 class="formation-titre">{{ $formation->titre }}</h2>
        <p class="formation-meta">{{ $formation->duree }} · {{ number_format($formation->prix, 0, ',', ' ') }} FCFA</p>
        <p class="formation-desc">{{ $formation->description }}</p>
<a href="/formations/{{ $formation->id }}" style="display:inline-block;margin-top:12px;font-size:13px;border-bottom:1px solid var(--noir);text-decoration:none;color:var(--noir);">Voir détails</a>
      </article>
    @endforeach

  </section>

</body>
</html>