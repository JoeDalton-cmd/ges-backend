<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Publications — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root { --noir: #111111; --blanc: #FFFFFF; --gris-grille: #D8D8D8; --gris-texte: #6B6B6B; --rouge: #E4002B; --vert: #00B37E; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille { display: grid; grid-template-columns: repeat(12, 1fr); max-width: 1280px; margin: 0 auto; border-left: 1px solid var(--gris-grille); border-right: 1px solid var(--gris-grille); }
  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }
  .pub { grid-column: 3 / 11; border-top: 1px solid var(--gris-grille); padding: 24px 0; }
  .pub-cat { font-size: 11px; text-transform: uppercase; color: var(--vert); margin-bottom: 8px; }
  .pub-titre { font-size: 22px; font-weight: 700; margin-bottom: 8px; }
  .pub-extrait { font-size: 15px; color: var(--gris-texte); margin-bottom: 12px; }
  .pub-lien { font-size: 13px; color: var(--noir); text-decoration: none; border-bottom: 1px solid var(--noir); }
</style>
</head>
<body>
  <section class="grille">
    <div class="section-label mono">FEUILLE 06</div>
    <h1 class="section-titre">Publications</h1>

    @forelse ($publications as $publication)
      <article class="pub">
        <div class="pub-cat">{{ $publication->categorie ?? 'Actualité' }}</div>
        <h2 class="pub-titre">{{ $publication->titre }}</h2>
        <p class="pub-extrait">{{ Str::limit($publication->contenu, 150) }}</p>
        <a href="/publications/{{ $publication->id }}" class="pub-lien">Lire l'article</a>
      </article>
    @empty
      <p style="grid-column:3/9;padding:20px 0;color:var(--gris-texte);">Aucune publication pour le moment.</p>
    @endforelse
  </section>
</body>
</html>