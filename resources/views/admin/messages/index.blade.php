<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Messages — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; }
  header a { color: white; text-decoration: none; font-size: 14px; }
  .contenu { padding: 40px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { text-align: left; padding: 12px; border-bottom: 1px solid #D8D8D8; font-size: 14px; }
  th { text-transform: uppercase; font-size: 11px; color: #6B6B6B; }
  select { padding: 8px; border: 1px solid #D8D8D8; font-family: inherit; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <header><a href="/admin/dashboard">← Tableau de bord</a></header>

  <div class="contenu">
    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <h1 style="margin-bottom:24px;">Messages de contact</h1>

    <table>
      <thead>
        <tr><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th><th>Statut</th></tr>
      </thead>
      <tbody>
        @foreach ($messages as $message)
          <tr>
            <td>{{ $message->nom }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->sujet ?? '—' }}</td>
            <td>{{ Str::limit($message->message, 60) }}</td>
            <td>
              <form method="POST" action="/admin/messages/{{ $message->id }}/statut" onchange="this.submit()">
                @csrf
                @method('PUT')
                <select name="statut">
                  <option value="non_lu" {{ $message->statut == 'non_lu' ? 'selected' : '' }}>Non lu</option>
                  <option value="lu" {{ $message->statut == 'lu' ? 'selected' : '' }}>Lu</option>
                  <option value="archive" {{ $message->statut == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
