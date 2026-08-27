<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Nouvelle publication — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; }
  .contenu { padding: 40px; max-width: 600px; }
  input, textarea, select { width: 100%; padding: 12px; border: 1px solid #D8D8D8; margin-bottom: 12px; font-family: inherit; }
  label { font-size: 13px; color: #6B6B6B; display: block; margin-bottom: 4px; }
  .btn { background: #111111; color: white; padding: 14px 28px; border: none; text-transform: uppercase; font-size: 14px; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  .erreur { background: #E4002B; color: white; padding: 12px; margin-bottom: 16px; font-size: 14px; }
</style>
</head>
<body>
  <header><a href="/admin/publications">← Retour aux publications</a></header>

  <div class="contenu">
    <h1 style="margin-bottom:24px;">Nouvelle publication</h1>

    @if ($errors->any())
      <div class="erreur">
        @foreach ($errors->all() as $erreur)
          {{ $erreur }}<br>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/admin/publications">
      @csrf
      <label>Titre</label>
      <input type="text" name="titre" value="{{ old('titre') }}" required>

      <label>Catégorie</label>
      <input type="text" name="categorie" value="{{ old('categorie') }}" placeholder="Actualité, Article technique, Événement...">

      <label>Contenu</label>
      <textarea name="contenu" required style="min-height:200px;">{{ old('contenu') }}</textarea>

      <label>Statut</label>
      <select name="statut" required>
        <option value="brouillon">Brouillon</option>
        <option value="publie">Publié</option>
      </select>

      <button type="submit" class="btn">Créer la publication</button>
    </form>
  </div>
</body>
</html>
