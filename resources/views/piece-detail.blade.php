<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>{{ $piece->nom }} — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root {
    --noir: #111111; --blanc: #FFFFFF;
    --gris-grille: #D8D8D8; --gris-texte: #6B6B6B;
    --rouge: #E4002B; --vert: #00B37E;
  }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    max-width: 1280px;
    margin: 0 auto;
    border-left: 1px solid var(--gris-grille);
    border-right: 1px solid var(--gris-grille);
  }
  .retour { grid-column: 1 / 13; padding: 24px 0 0 24px; font-size: 13px; }
  .retour a { color: var(--gris-texte); text-decoration: none; }
  .retour a:hover { color: var(--rouge); }
  .label { grid-column: 1 / 3; padding: 32px 0; font-size: 13px; color: var(--gris-texte); }
  .titre { grid-column: 3 / 11; padding: 32px 0; font-size: 36px; font-weight: 700; }
  .fiche { grid-column: 3 / 9; padding-bottom: 60px; }
  .fiche p { margin-bottom: 16px; font-size: 16px; line-height: 1.6; }
  .specs { grid-column: 9 / 13; border-left: 1px solid var(--gris-grille); padding: 0 0 60px 24px; }
  .spec-item { padding: 16px 0; border-bottom: 1px solid var(--gris-grille); }
  .spec-label { font-size: 11px; text-transform: uppercase; color: var(--gris-texte); margin-bottom: 4px; }
  .spec-valeur { font-size: 16px; font-weight: 700; }
  .btn { display: inline-block; background: var(--noir); color: var(--blanc); padding: 14px 28px; text-decoration: none; font-size: 14px; text-transform: uppercase; border: none; cursor: pointer; margin-top: 8px; }
  .btn:hover { background: var(--rouge); }
  input, textarea { width: 100%; padding: 12px; border: 1px solid var(--gris-grille); margin-bottom: 12px; font-family: inherit; }
</style>
</head>
<body>
  <div class="grille">
    <div class="retour"><a href="/pieces">← Retour aux pièces</a></div>

    <div class="label mono">FICHE PIÈCE</div>
    <h1 class="titre">{{ $piece->nom }}</h1>

    <div class="fiche">
      <p>{{ $piece->description }}</p>

      @if (session('succes'))
        <p style="background:var(--vert);color:white;padding:16px;margin-bottom:16px;">{{ session('succes') }}</p>
      @endif

      <h3 style="margin-bottom:12px;">Demander la disponibilité</h3>
      <form method="POST" action="/demandes-pieces">
        @csrf
        <input type="hidden" name="piece_id" value="{{ $piece->id }}">
        <input type="text" name="nom_complet" placeholder="Nom complet" required>
        <input type="text" name="telephone" placeholder="Téléphone" required>
        <input type="email" name="email" placeholder="Email (optionnel)">
        <textarea name="message" placeholder="Message (optionnel)"></textarea>
        <button type="submit" class="btn">Envoyer la demande</button>
      </form>
    </div>

    <div class="specs">
      <div class="spec-item">
        <div class="spec-label">Référence</div>
        <div class="spec-valeur">{{ $piece->reference ?? '—' }}</div>
      </div>
      <div class="spec-item">
        <div class="spec-label">Marque</div>
        <div class="spec-valeur">{{ $piece->marque ?? '—' }}</div>
      </div>
      <div class="spec-item">
        <div class="spec-label">État</div>
        <div class="spec-valeur">{{ ucfirst($piece->etat) }}</div>
      </div>
      <div class="spec-item">
        <div class="spec-label">Prix</div>
        <div class="spec-valeur">{{ number_format($piece->prix, 0, ',', ' ') }} FCFA</div>
      </div>
    </div>
  </div>
</body>
</html>