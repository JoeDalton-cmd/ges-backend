<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion des formations — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
  header a { color: white; text-decoration: none; font-size: 14px; margin-right: 16px; }
  .contenu { padding: 40px; }
  .barre { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
  .btn { display: inline-block; background: #111111; color: white; padding: 12px 20px; text-decoration: none; font-size: 14px; border: none; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  .statut-publie { color: #00B37E; font-weight: 700; }
  .statut-brouillon { color: #6B6B6B; }
  .action-lien { color: #111111; text-decoration: none; margin-right: 12px; font-size: 13px; }
  .action-lien.supprimer { color: #E4002B; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header>
    <div><a href="/admin/dashboard">← Tableau de bord</a></div>
    <div><strong>GES — Formations</strong></div>
  </header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <div class="barre">
      <h1>Formations</h1>
      <a href="/admin/formations/creer" class="btn">+ Nouvelle formation</a>
    </div>

    <table>
      <thead>
        <tr><th>Titre</th><th>Durée</th><th>Prix</th><th>Statut</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @foreach ($formations as $formation)
          <tr>
            <td>{{ $formation->titre }}</td>
            <td>{{ $formation->duree }}</td>
            <td>{{ number_format($formation->prix, 0, ',', ' ') }} FCFA</td>
            <td class="statut-{{ $formation->statut }}">{{ ucfirst($formation->statut) }}</td>
            <td>
              <a href="/admin/formations/{{ $formation->id }}/modifier" class="action-lien">Modifier</a>
              <form method="POST" action="/admin/formations/{{ $formation->id }}" style="display:inline;" onsubmit="return confirm('Supprimer cette formation ?');">
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
