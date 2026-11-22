<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Signalements — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; margin-right: 20px; }
  .contenu { padding: 40px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  .btn { background: #111111; color: white; padding: 8px 16px; border: none; font-size: 13px; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  .statut-nouveau { color: #E4002B; font-weight: 700; }
  .statut-traite { color: #00B37E; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header>
    <a href="/admin/dashboard">← Tableau de bord</a>
    <a href="/admin/moderation/sujets">Sujets</a>
    <a href="/admin/moderation/membres">Membres</a>
  </header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <h1 style="margin-bottom:24px;">Signalements</h1>

    <table>
      <thead>
        <tr><th>Signalé par</th><th>Concerne</th><th>Raison</th><th>Statut</th><th>Action</th></tr>
      </thead>
      <tbody>
        @foreach ($signalements as $signalement)
          <tr>
            <td>{{ $signalement->auteur->name }}</td>
            <td>
              @if ($signalement->sujet)
                Sujet : <a href="/forum/sujet/{{ $signalement->sujet->id }}" target="_blank">{{ $signalement->sujet->titre }}</a>
              @elseif ($signalement->reponse)
                Une réponse dans le sujet #{{ $signalement->reponse->sujet_id }}
              @else
                Contenu supprimé
              @endif
            </td>
            <td>{{ $signalement->raison }}</td>
            <td class="statut-{{ $signalement->statut }}">{{ ucfirst($signalement->statut) }}</td>
            <td>
              @if ($signalement->statut === 'nouveau')
                <form method="POST" action="/admin/moderation/signalements/{{ $signalement->id }}/traiter">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="btn">Marquer traité</button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
