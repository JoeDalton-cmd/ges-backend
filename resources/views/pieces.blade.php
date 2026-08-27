<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Pièces automobiles — GES</title>
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
  .piece {
    grid-column: span 4;
    border-top: 1px solid var(--gris-grille);
    padding: 24px 24px 24px 0;
  }
  .piece:nth-child(3n+1) { grid-column: 1 / 5; padding-left: 0; }
  .piece:nth-child(3n+2) { grid-column: 5 / 9; padding-left: 24px; }
  .piece:nth-child(3n)   { grid-column: 9 / 13; padding-left: 24px; }
  .piece-ref { font-size: 12px; color: var(--rouge); margin-bottom: 8px; }
  .piece-nom { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
  .piece-meta { font-size: 13px; color: var(--gris-texte); margin-bottom: 12px; }
  .piece-lien { font-size: 13px; color: var(--noir); text-decoration: none; border-bottom: 1px solid var(--noir); }
</style>
</head>
<body>
  <section class="grille">
    <div class="section-label mono">FEUILLE 05</div>
    <h1 class="section-titre">Pièces disponibles</h1>

    @forelse ($pieces as $piece)
      <article class="piece">
        <div class="piece-ref mono">REF. {{ $piece->reference ?? '—' }}</div>
        <h2 class="piece-nom">{{ $piece->nom }}</h2>
        <p class="piece-meta">{{ $piece->marque }} · {{ ucfirst($piece->etat) }} · {{ number_format($piece->prix, 0, ',', ' ') }} FCFA</p>
        <a href="/pieces/{{ $piece->id }}" class="piece-lien">Voir détails</a>
      </article>
    @empty
      <p style="grid-column:3/9;padding:20px 0;color:var(--gris-texte);">Aucune pièce disponible pour le moment.</p>
    @endforelse
  </section>
</body>
</html>