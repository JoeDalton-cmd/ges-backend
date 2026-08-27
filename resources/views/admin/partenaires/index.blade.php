<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des partenaires — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; }
  .contenu { padding: 40px; }
  .barre { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
  .btn { display: inline-block; background: #111111; color: white; padding: 12px 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  .action-lien { color: #111111; text-decoration: none; margin-right: 12px; font-size: 13px; }
  .action-lien.supprimer { color: #E4002B; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header><a href="/admin/dashboard">← Tableau de bord</a></header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <div class="barre">
      <h1>Partenaires</h1>
      <a href="/admin/partenaires/creer" class="btn">+ Nouveau partenaire</a>
    </div>

    <table>
      <thead>
        <tr><th>Nom</th><th>Type</th><th>Actif</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @foreach ($partenaires as $partenaire)
          <tr>
            <td>{{ $partenaire->nom }}</td>
            <td>{{ $partenaire->type ?? '—' }}</td>
            <td>{{ $partenaire->actif ? 'Oui' : 'Non' }}</td>
            <td>
              <a href="/admin/partenaires/{{ $partenaire->id }}/modifier" class="action-lien">Modifier</a>
              <form method="POST" action="/admin/partenaires/{{ $partenaire->id }}" style="display:inline;" onsubmit="return confirm('Supprimer ce partenaire ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-lien supprimer" style="background:none;border:none;cursor:pointer;">Supprimer</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
