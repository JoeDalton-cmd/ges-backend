<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Demandes de pièces — GES Admin</title>
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

    <h1 style="margin-bottom:24px;">Demandes de pièces</h1>

    <table>
      <thead>
        <tr><th>Nom</th><th>Pièce demandée</th><th>Téléphone</th><th>Message</th><th>Statut</th></tr>
      </thead>
      <tbody>
        @foreach ($demandes as $demande)
          <tr>
            <td>{{ $demande->nom_complet }}</td>
            <td>{{ $demande->piece->nom ?? '—' }}</td>
            <td>{{ $demande->telephone }}</td>
            <td>{{ $demande->message ?? '—' }}</td>
            <td>
              <form method="POST" action="/admin/demandes-pieces/{{ $demande->id }}/statut" onchange="this.submit()">
                @csrf
                @method('PUT')
                <select name="statut">
                  <option value="nouvelle" {{ $demande->statut == 'nouvelle' ? 'selected' : '' }}>Nouvelle</option>
                  <option value="contactee" {{ $demande->statut == 'contactee' ? 'selected' : '' }}>Contactée</option>
                  <option value="traitee" {{ $demande->statut == 'traitee' ? 'selected' : '' }}>Traitée</option>
                  <option value="annulee" {{ $demande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
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
