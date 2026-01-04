<?php
// Language handling (EN default)
$lang = $_GET['lang'] ?? 'en';
if (!in_array($lang, ['en', 'fr', 'ar'])) $lang = 'en';

$text = [
  'en' => [
    'title' => 'Airport Wi-Fi | Connect',
    'headline' => 'Welcome to Airport Wi-Fi',
    'sub' => 'Connect securely to access the internet.',
    'terms' => 'By continuing, you agree to the Terms & Privacy Policy.',
    'btn' => 'Accept & Connect',
    'help' => 'Need help? Visit the Wi-Fi desk or contact airport support.',
    'speed' => 'Fast & Secure',
    'free' => 'Free Access',
    'support' => '24/7 Support',
  ],
  'fr' => [
    'title' => 'Wi-Fi Aéroport | Connexion',
    'headline' => 'Bienvenue sur le Wi-Fi de l’aéroport',
    'sub' => 'Connectez-vous en toute sécurité pour accéder à Internet.',
    'terms' => 'En continuant, vous acceptez les Conditions & la Politique de confidentialité.',
    'btn' => 'Accepter & Se connecter',
    'help' => 'Besoin d’aide ? Rendez-vous au comptoir Wi-Fi ou contactez le support.',
    'speed' => 'Rapide & Sécurisé',
    'free' => 'Accès Gratuit',
    'support' => 'Support 24/7',
  ],
  'ar' => [
    'title' => 'واي فاي المطار | اتصال',
    'headline' => 'مرحباً بكم في واي فاي المطار',
    'sub' => 'اتصل بأمان للوصول إلى الإنترنت.',
    'terms' => 'بمتابعة الاتصال، فإنك توافق على الشروط وسياسة الخصوصية.',
    'btn' => 'موافقة و اتصال',
    'help' => 'تحتاج مساعدة؟ تفضل بزيارة مكتب الواي فاي أو اتصل بالدعم.',
    'speed' => 'سريع وآمن',
    'free' => 'ولوج مجاني',
    'support' => 'دعم 24/7',
  ],
];

$t = $text[$lang];
$isRTL = ($lang === 'ar');
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $isRTL ? 'rtl' : 'ltr' ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $t['title'] ?></title>

  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $isRTL ? 'rtl' : '' ?>">
  <div class="bg-overlay"></div>

  <!-- Top Bar -->
  <header class="topbar">
    <div class="brand">
      <div class="brand-logo">✈</div>
      <div class="brand-text">
        <div class="brand-name">Airport Wi-Fi</div>
        <div class="brand-sub">Secure Internet Access</div>
      </div>
    </div>

    <!-- Language Switch -->
    <nav class="lang-switch">
      <a class="<?= $lang==='en'?'active':'' ?>" href="?lang=en">EN</a>
      <a class="<?= $lang==='fr'?'active':'' ?>" href="?lang=fr">FR</a>
      <a class="<?= $lang==='ar'?'active':'' ?>" href="?lang=ar">AR</a>
    </nav>
  </header>

  <!-- Main Container -->
  <main class="wrap">
    <section class="card-airport">
      <div class="card-left">
        <div class="welcome">
          <h1><?= $t['headline'] ?></h1>
          <p class="lead"><?= $t['sub'] ?></p>
        </div>

        <div class="features">
          <div class="feature">
            <span class="icon">🔒</span>
            <span><?= $t['speed'] ?></span>
          </div>
          <div class="feature">
            <span class="icon">📶</span>
            <span><?= $t['free'] ?></span>
          </div>
          <div class="feature">
            <span class="icon">🕘</span>
            <span><?= $t['support'] ?></span>
          </div>
        </div>

        <p class="terms"><?= $t['terms'] ?></p>

        <!-- Legit captive portal submit -->
        <form method="POST" action="helper.php" class="connect-form">
          <button type="submit" class="btn-airport"><?= $t['btn'] ?></button>
        </form>

        <p class="help"><?= $t['help'] ?></p>
      </div>

      <!-- Right Panel -->
      <div class="card-right">
        <div class="flight-board">
          <div class="board-title"><?= $lang==='ar'?'لوحة الرحلات':'Flight Board' ?></div>

          <div class="row-head">
            <span><?= $lang==='ar'?'الوجهة':'Destination' ?></span>
            <span><?= $lang==='ar'?'الوقت':'Time' ?></span>
            <span><?= $lang==='ar'?'الحالة':'Status' ?></span>
          </div>

          <div class="row">
            <span><?= $lang==='ar'?'لشبونة':'Lisbon' ?></span>
            <span>10:15</span>
            <span class="ok"><?= $lang==='ar'?'في الوقت':'On Time' ?></span>
          </div>

          <div class="row">
            <span><?= $lang==='ar'?'باريس':'Paris' ?></span>
            <span>11:05</span>
            <span class="ok"><?= $lang==='ar'?'في الوقت':'On Time' ?></span>
          </div>

          <div class="row">
            <span><?= $lang==='ar'?'ميونخ':'Munich' ?></span>
            <span>12:30</span>
            <span class="late"><?= $lang==='ar'?'متأخر':'Delayed' ?></span>
          </div>

          <div class="row">
            <span><?= $lang==='ar'?'الدار البيضاء':'Casablanca' ?></span>
            <span>13:40</span>
            <span class="ok"><?= $lang==='ar'?'في الوقت':'On Time' ?></span>
          </div>
        </div>

        <div class="footer-note">
          <?= $lang==='ar'
            ? 'تم تصميم هذه الصفحة خصيصاً لشبكة الواي فاي بالمطار.'
            : ($lang==='fr'
              ? 'Page conçue pour l’accès Wi-Fi de l’aéroport.'
              : 'Designed for secure airport Wi-Fi access.') ?>
        </div>
      </div>
    </section>
  </main>

</body>
</html>
