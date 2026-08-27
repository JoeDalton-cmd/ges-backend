<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription — Forum GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; background: #f5f5f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
  .box { background: white; padding: 40px; width: 380px; border: 1px solid #D8D8D8; }
  h1 { font-size: 20px; margin-bottom: 24px; }
  input { width: 100%; padding: 12px; border: 1px solid #D8D8D8; margin-bottom: 12px; font-family: inherit; }
  .btn { width: 100%; padding: 14px; background: #111111; color: white; border: none; text-transform: uppercase; font-size: 14px; cursor: pointer; }
  .btn:hover { background: #E4002B; }
  .erreur { background: #E4002B; color: white; padding: 12px; margin-bottom: 16px; font-size: 14px; }
  .lien { text-align: center; margin-top: 16px; font-size: 13px; }
  .lien a { color: #111111; }
</style>
</head>
<body>
  <div class="box">
    <h1>Rejoindre le forum GES</h1>

    @if ($errors->any())
      <div class="erreur">
        @foreach ($errors->all() as $erreur)
          {{ $erreur }}<br>
        @endforeach
      </div>
    @endif

    <form method="POST" action="/forum/inscription">
      @csrf
      <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}" required>
      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
      <button type="submit" class="btn">S'inscrire</button>
    </form>

    <div class="lien">Déjà membre ? <a href="/forum/connexion">Se connecter</a></div>
  </div>
</body>
</html>
