<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Tableau de bord — GES Admin</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: #111111; }
  header { background: #111111; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
  header a { color: white; text-decoration: none; font-size: 14px; }
  .contenu { padding: 40px; }
  .grille-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
  .stat { border: 1px solid #D8D8D8; padding: 24px; }
  .stat-nombre { font-size: 36px; font-weight: 700; }
  .stat-label { font-size: 13px; color: #6B6B6B; text-transform: uppercase; margin-top: 8px; }
</style>
</head>
<body>
  <header>
    <strong>GES — Administration</strong>
    <form method="POST" action="/admin/logout">
      @csrf
      <button type="submit" style="background:none;border:none;color:white;cursor:pointer;font-size:14px;">Se déconnecter</button>
    </form>
  </header>

  <div class="contenu">
    <h1 style="margin-bottom:24px;">Tableau de bord</h1>
    <div class="grille-stats">
    <a href="/admin/formations" style="text-decoration:none;color:inherit;">
  <div class="stat"><div class="stat-nombre">{{ $nbFormations }}</div><div class="stat-label">Formations</div></div>
</a>
      <div class="stat"><div class="stat-nombre">{{ $nbPieces }}</div><div class="stat-label">Pièces</div></div>
      <div class="stat"><div class="stat-nombre">{{ $nbPublications }}</div><div class="stat-label">Publications</div></div>
      <div class="stat"><div class="stat-nombre">{{ $nbInscriptions }}</div><div class="stat-label">Inscriptions</div></div>
      <div class="stat"><div class="stat-nombre">{{ $nbDemandesPieces }}</div><div class="stat-label">Demandes de pièces</div></div>
      <div class="stat"><div class="stat-nombre">{{ $nbMessages }}</div><div class="stat-label">Messages</div></div>
    </div>
  </div>
</body>
</html>
