<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Membres — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; margin-right: 20px; }
  .contenu { padding: 40px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  .btn-mini { background: none; border: 1px solid #D8D8D8; padding: 6px 12px; font-size: 12px; cursor: pointer; }
  .btn-mini.suspendu { background: #E4002B; color: white; border-color: #E4002B; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header>
    <a href="/admin/dashboard">← Tableau de bord</a>
    <a href="/admin/moderation/signalements">Signalements</a>
    <a href="/admin/moderation/sujets">Sujets</a>
  </header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <h1 style="margin-bottom:24px;">Membres du forum</h1>

    <table>
      <thead>
        <tr><th>Nom</th><th>Email</th><th>Statut</th><th>Action</th></tr>
      </thead>
      <tbody>
        @foreach ($membres as $membre)
          <tr>
            <td>{{ $membre->name }}</td>
            <td>{{ $membre->email }}</td>
            <td>{{ $membre->suspendu ? 'Suspendu' : 'Actif' }}</td>
            <td>
              <form method="POST" action="/admin/moderation/membres/{{ $membre->id }}/suspendre">
                @csrf @method('PUT')
                <button type="submit" class="btn-mini {{ $membre->suspendu ? 'suspendu' : '' }}">
                  {{ $membre->suspendu ? 'Réactiver' : 'Suspendre' }}
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
