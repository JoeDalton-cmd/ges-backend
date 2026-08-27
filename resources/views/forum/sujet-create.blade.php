<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouveau sujet — Forum GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  .grille { max-width: 700px; margin: 0 auto; padding: 40px 24px; }
  .retour { font-size: 13px; margin-bottom: 24px; display: block; }
  .retour a { color: #6B6B6B; text-decoration: none; }
  h1 { font-size: 24px; margin-bottom: 24px; }
  input, textarea { width: 100%; padding: 12px; border: 1px solid #D8D8D8; margin-bottom: 12px; font-family: inherit; }
  .btn { background: #111111; color: white; padding: 14px 28px; border: none; text-transform: uppercase; font-size: 14px; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  .erreur { background: #E4002B; color: white; padding: 12px; margin-bottom: 16px; font-size: 14px; }
</style>
</head>
<body>
  <div class="grille">
    <span class="retour"><a href="/forum/categorie/{{ $categorie->id }}">← Retour à {{ $categorie->nom }}</a></span>
    <h1>Nouveau sujet dans "{{ $categorie->nom }}"</h1>

    @if ($errors->any())
      <div class="erreur">
        @foreach ($errors->all() as $erreur)
          {{ $erreur }}<br>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/forum/categorie/{{ $categorie->id }}/nouveau-sujet">
      @csrf
      <input type="text" name="titre" placeholder="Titre du sujet" value="{{ old('titre') }}" required>
      <textarea name="contenu" placeholder="Votre message..." style="min-height:150px;" required>{{ old('contenu') }}</textarea>
      <button type="submit" class="btn">Publier le sujet</button>
    </form>
  </div>
</body>
</html>
