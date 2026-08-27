<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $sujet->titre }} — Forum GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  .grille { max-width: 800px; margin: 0 auto; padding: 40px 24px; }
  .retour { font-size: 13px; margin-bottom: 24px; display: block; }
  .retour a { color: #6B6B6B; text-decoration: none; }
  h1 { font-size: 26px; margin-bottom: 8px; }
  .meta { font-size: 13px; color: #6B6B6B; margin-bottom: 24px; }
  .message { border: 1px solid #D8D8D8; padding: 20px; margin-bottom: 16px; }
  .message-auteur { font-weight: 700; font-size: 14px; margin-bottom: 4px; }
  .message-date { font-size: 12px; color: #6B6B6B; margin-bottom: 12px; }
  .message-contenu { font-size: 15px; line-height: 1.6; white-space: pre-line; }
  textarea { width: 100%; padding: 12px; border: 1px solid #D8D8D8; margin-bottom: 12px; font-family: inherit; min-height: 100px; }
  .btn { background: #111111; color: white; padding: 12px 24px; border: none; text-transform: uppercase; font-size: 14px; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  .succes { background: #00B37E; color: white; padding: 16px; margin-bottom: 20px; }
</style>
</head>
<body>
  <div class="grille">
    <span class="retour"><a href="/forum/categorie/{{ $sujet->categorie->id }}">← Retour à {{ $sujet->categorie->nom }}</a></span>

    @if (session('succes'))
      <div class="succes">{{ session('succes') }}</div>
    @endif

    <h1>{{ $sujet->titre }}</h1>
    <div class="meta">Par {{ $sujet->auteur->name }} · {{ $sujet->created_at->diffForHumans() }}</div>

    <div class="message">
      <div class="message-auteur">{{ $sujet->auteur->name }}</div>
      <div class="message-date">{{ $sujet->created_at->format('d/m/Y à H:i') }}</div>
      <div class="message-contenu">{{ $sujet->contenu }}</div>
    </div>

    <h3 style="margin:24px 0 12px;">{{ $sujet->reponses->count() }} réponse(s)</h3>

    @foreach ($sujet->reponses as $reponse)
      <div class="message">
        <div class="message-auteur">{{ $reponse->auteur->name }}</div>
        <div class="message-date">{{ $reponse->created_at->format('d/m/Y à H:i') }}</div>
        <div class="message-contenu">{{ $reponse->contenu }}</div>
      </div>
    @endforeach

    @auth
      <h3 style="margin:24px 0 12px;">Répondre</h3>
      <form method="POST" action="/forum/sujet/{{ $sujet->id }}/repondre">
        @csrf
        <textarea name="contenu" placeholder="Votre réponse..." required></textarea>
        <button type="submit" class="btn">Publier la réponse</button>
      </form>
    @else
      <p style="margin-top:24px;font-size:14px;color:#6B6B6B;"><a href="/forum/connexion">Connecte-toi</a> pour répondre à ce sujet.</p>
    @endauth
  </div>
</body>
</html>
