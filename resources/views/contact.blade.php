<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Contact — GES</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  :root { --noir: #111111; --blanc: #FFFFFF; --gris-grille: #D8D8D8; --gris-texte: #6B6B6B; --rouge: #E4002B; --vert: #00B37E; }
  body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--noir); background: var(--blanc); }
  .mono { font-family: 'Courier New', monospace; }
  .grille { display: grid; grid-template-columns: repeat(12, 1fr); max-width: 1280px; margin: 0 auto; border-left: 1px solid var(--gris-grille); border-right: 1px solid var(--gris-grille); }
  .section-label { grid-column: 1 / 3; padding: 40px 0 20px; font-size: 13px; color: var(--gris-texte); }
  .section-titre { grid-column: 3 / 9; padding: 40px 0 20px; font-size: 28px; font-weight: 700; }

  .infos { grid-column: 1 / 5; border-top: 1px solid var(--gris-grille); padding: 24px 0 60px; }
  .info-item { margin-bottom: 20px; }
  .info-label { font-size: 11px; text-transform: uppercase; color: var(--gris-texte); margin-bottom: 4px; }
  .info-valeur { font-size: 16px; font-weight: 700; }
  .info-valeur a { color: var(--noir); text-decoration: none; }
  .info-valeur a:hover { color: var(--rouge); }

  .formulaire { grid-column: 5 / 13; border-top: 1px solid var(--gris-grille); border-left: 1px solid var(--gris-grille); padding: 24px 0 60px 24px; }
  input, textarea { width: 100%; padding: 12px; border: 1px solid var(--gris-grille); margin-bottom: 12px; font-family: inherit; }
  .btn { display: inline-block; background: var(--noir); color: var(--blanc); padding: 14px 28px; border: none; font-size: 14px; text-transform: uppercase; cursor: pointer; }
  .btn:hover { background: var(--rouge); }
</style>
</head>
<body>
  <section class="grille">
    <div class="section-label mono">FEUILLE 08</div>
    <h1 class="section-titre">Contact</h1>

    <div class="infos">
      <div class="info-item">
        <div class="info-label">Téléphone</div>
        <div class="info-valeur"><a href="tel:+237600000000">+237 6XX XXX XXX</a></div>
      </div>
      <div class="info-item">
        <div class="info-label">WhatsApp</div>
        <div class="info-valeur"><a href="https://wa.me/237600000000" target="_blank">Écrire sur WhatsApp</a></div>
      </div>
      <div class="info-item">
        <div class="info-label">Email</div>
        <div class="info-valeur"><a href="mailto:contact@ges.cm">contact@ges.cm</a></div>
      </div>
      <div class="info-item">
        <div class="info-label">Adresse</div>
        <div class="info-valeur">Yaoundé, Cameroun</div>
      </div>
    </div>

    <div class="formulaire">
      @if (session('succes'))
        <p style="background:var(--vert);color:white;padding:16px;margin-bottom:16px;">{{ session('succes') }}</p>
      @endif

      <form method="POST" action="/contact">
        @csrf
        <input type="text" name="nom" placeholder="Nom complet" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telephone" placeholder="Téléphone (optionnel)">
        <input type="text" name="sujet" placeholder="Sujet (optionnel)">
        <textarea name="message" placeholder="Votre message" required style="min-height:120px;"></textarea>
        <button type="submit" class="btn">Envoyer le message</button>
      </form>
    </div>
  </section>
</body>
</html>
