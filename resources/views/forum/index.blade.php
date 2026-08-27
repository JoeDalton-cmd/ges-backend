<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Forum — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root { --noir: #111111; --blanc: #FFFFFF; --gris-grille: #D8D8D8; --gris-texte: #6B6B6B; --rouge: #E4002B; --vert: #00B37E; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille { display: grid; grid-template-columns: repeat(12, 1fr); max-width: 1280px; margin: 0 auto; border-left: 1px solid var(--gris-grille); border-right: 1px solid var(--gris-grille); }
  .entete { grid-column: 1 / 13; display: flex; justify-content: space-between; align-items: center; padding: 24px; border-bottom: 1px solid var(--gris-grille); }
  .entete a { color: var(--noir); text-decoration: none; font-size: 14px; margin-left: 16px; }
  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }
  .categorie { grid-column: 3 / 9; border-top: 1px solid var(--gris-grille); padding: 20px 0; display: flex; justify-content: space-between; align-items: center; }
  .cat-nom { font-size: 18px; font-weight: 700; }
  .cat-nom a { color: var(--noir); text-decoration: none; }
  .cat-nom a:hover { color: var(--rouge); }
  .cat-desc { font-size: 14px; color: var(--gris-texte); margin-top: 4px; }
  .cat-compte { font-size: 13px; color: var(--gris-texte); }
</style>
</head>
<body>
  <div class="grille">
    <div class="entete">
      <strong>GES — Forum</strong>
      <div>
        @auth
          <span style="margin-right:16px;font-size:14px;">Bonjour, {{ auth()->user()->name }}</span>
          <form method="POST" action="/forum/deconnexion" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;font-size:14px;">Se déconnecter</button>
          </form>
        @else
          <a href="/forum/connexion">Connexion</a>
          <a href="/forum/inscription">Inscription</a>
        @endauth
      </div>
    </div>

    <div class="section-label mono">FEUILLE 09</div>
    <h1 class="section-titre">Catégories du forum</h1>

    @foreach ($categories as $categorie)
      <div class="categorie">
        <div>
          <div class="cat-nom"><a href="/forum/categorie/{{ $categorie->id }}">{{ $categorie->nom }}</a></div>
          <div class="cat-desc">{{ $categorie->description }}</div>
        </div>
        <div class="cat-compte">{{ $categorie->sujets_count }} sujet(s)</div>
      </div>
    @endforeach
  </div>
</body>
</html>