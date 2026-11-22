<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modération des sujets — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; margin-right: 20px; }
  .contenu { padding: 40px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  .btn-mini { background: none; border: 1px solid #D8D8D8; padding: 6px 12px; font-size: 12px; cursor: pointer; margin-right: 6px; }
  .btn-mini:hover { background: #111111; color: white; }
  .btn-mini.actif { background: #00B37E; color: white; border-color: #00B37E; }
  .btn-mini.danger:hover { background: #E4002B; border-color: #E4002B; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header>
    <a href="/admin/dashboard">← Tableau de bord</a>
    <a href="/admin/moderation/signalements">Signalements</a>
    <a href="/admin/moderation/membres">Membres</a>
  </header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <h1 style="margin-bottom:24px;">Tous les sujets</h1>

    <table>
      <thead>
        <tr><th>Titre</th><th>Catégorie</th><th>Auteur</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @foreach ($sujets as $sujet)
          <tr>
            <td><a href="/forum/sujet/{{ $sujet->id }}" target="_blank">{{ $sujet->titre }}</a></td>
            <td>{{ $sujet->categorie->nom }}</td>
            <td>{{ $sujet->auteur->name }}</td>
            <td>
              <form method="POST" action="/admin/moderation/sujets/{{ $sujet->id }}/epingler" style="display:inline;">
                @csrf @method('PUT')
                <button type="submit" class="btn-mini {{ $sujet->epingle ? 'actif' : '' }}">{{ $sujet->epingle ? 'Épinglé' : 'Épingler' }}</button>
              </form>
              <form method="POST" action="/admin/moderation/sujets/{{ $sujet->id }}/fermer" style="display:inline;">
                @csrf @method('PUT')
                <button type="submit" class="btn-mini {{ $sujet->ferme ? 'actif' : '' }}">{{ $sujet->ferme ? 'Fermé' : 'Fermer' }}</button>
              </form>
              <form method="POST" action="/admin/moderation/sujets/{{ $sujet->id }}" style="display:inline;" onsubmit="return confirm('Supprimer définitivement ce sujet et ses réponses ?');">
                @csrf @method('DELETE')
                <button type="submit" class="btn-mini danger">Supprimer</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
