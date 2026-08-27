<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier la pièce — GES Admin</title>
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
  <header><a href="/admin/pieces">← Retour aux pièces</a></header>

  <div class="contenu">
    <h1 style="margin-bottom:24px;">Modifier la pièce</h1>

    @if ($errors->any())
      <div class="erreur">
        @foreach ($errors->all() as $erreur)
          {{ $erreur }}<br>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/admin/pieces/{{ $piece->id }}">
      @csrf
      @method('PUT')

      <label>Nom</label>
      <input type="text" name="nom" value="{{ old('nom', $piece->nom) }}" required>

      <label>Description</label>
      <textarea name="description" style="min-height:100px;">{{ old('description', $piece->description) }}</textarea>

      <label>Catégorie</label>
      <input type="text" name="categorie" value="{{ old('categorie', $piece->categorie) }}">

      <label>Marque</label>
      <input type="text" name="marque" value="{{ old('marque', $piece->marque) }}">

      <label>État</label>
      <select name="etat" required>
        <option value="neuf" {{ $piece->etat == 'neuf' ? 'selected' : '' }}>Neuf</option>
        <option value="occasion" {{ $piece->etat == 'occasion' ? 'selected' : '' }}>Occasion</option>
      </select>

      <label>Référence</label>
      <input type="text" name="reference" value="{{ old('reference', $piece->reference) }}">

      <label>Prix (FCFA)</label>
      <input type="number" name="prix" value="{{ old('prix', $piece->prix) }}" required>

      <label>Disponible</label>
      <select name="disponible" required>
        <option value="1" {{ $piece->disponible ? 'selected' : '' }}>Oui</option>
        <option value="0" {{ !$piece->disponible ? 'selected' : '' }}>Non</option>
      </select>

      <button type="submit" class="btn">Enregistrer les modifications</button>
    </form>
  </div>
</body>
</html>
