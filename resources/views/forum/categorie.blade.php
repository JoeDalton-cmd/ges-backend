<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $categorie->nom }} — Forum GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  .grille { max-width: 900px; margin: 0 auto; padding: 40px 24px; }
  .retour { font-size: 13px; margin-bottom: 24px; display: block; }
  .retour a { color: #6B6B6B; text-decoration: none; }
  .barre { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
  .btn { background: #111111; color: white; padding: 12px 20px; text-decoration: none; font-size: 14px; text-transform: uppercase; }
  .btn:hover { background: #E4002B; }
  .sujet { border-top: 1px solid #D8D8D8; padding: 16px 0; display: flex; justify-content: space-between; align-items: center; }
  .sujet-titre { font-size: 16px; font-weight: 700; }
  .sujet-titre a { color: #111111; text-decoration: none; }
  .sujet-titre a:hover { color: #E4002B; }
  .sujet-meta { font-size: 13px; color: #6B6B6B; margin-top: 4px; }
  .sujet-reponses { font-size: 13px; color: #6B6B6B; }
  .epingle { color: #E4002B; font-size: 11px; text-transform: uppercase; margin-right: 8px; }
</style>
</head>
<body>
  <div class="grille">
    <span class="retour"><a href="/forum">← Retour au forum</a></span>

    <div class="barre">
      <h1>{{ $categorie->nom }}</h1>
      @auth
        <a href="/forum/categorie/{{ $categorie->id }}/nouveau-sujet" class="btn">+ Nouveau sujet</a>
      @else
        <a href="/forum/connexion" class="btn">Connexion pour poster</a>
      @endauth
    </div>

    @forelse ($sujets as $sujet)
      <div class="sujet">
        <div>
          <div class="sujet-titre">
            @if ($sujet->epingle)<span class="epingle">Épinglé</span>@endif
            <a href="/forum/sujet/{{ $sujet->id }}">{{ $sujet->titre }}</a>
          </div>
          <div class="sujet-meta">Par {{ $sujet->auteur->name }} · {{ $sujet->created_at->diffForHumans() }}</div>
        </div>
        <div class="sujet-reponses">{{ $sujet->reponses_count }} réponse(s)</div>
      </div>
    @empty
      <p style="padding:20px 0;color:#6B6B6B;">Aucun sujet pour le moment. Sois le premier à en créer un !</p>
    @endforelse
  </div>
</body>
</html>
