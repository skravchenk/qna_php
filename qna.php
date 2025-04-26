<?php
require_once 'config.php';
require_once 'QnAA.php';

$qna = new QnA($db);
$data = $qna->getAllQnA();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QnA</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/accordion.css">
  <link rel="stylesheet" href="css/banner.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <header class="container main-header">
    <div class="logo-holder">
      <a href="index.php"><img src="img/logo.png" height="40"></a>
    </div>
    <nav class="main-nav">
      <ul class="main-menu" id="main-menu container">
        <li><a href="index.php">Domov</a></li>
        <li><a href="portfolio.php">Portfólio</a></li>
        <li><a href="qna.php">Q&A</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
      <a class="hamburger" id="hamburger">
        <i class="fa fa-bars"></i>
      </a>
    </nav>
  </header>

  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Q&A</h1>
      </div>
    </section>

    <section class="container">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Eit culpa id mollit irure sit. Ex ut et ea esse culpa officia ea incididunt elit velit veniam qui. Mollit deserunt culpa incididunt laborum commodo in culpa.</em></strong></p>
        </div>
      </div>
    </section>

    <section class="container">
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $item): ?>
          <div class="accordion">
            <div class="question"><?= htmlspecialchars($item['question']) ?></div>
            <div class="answer"><?= nl2br(htmlspecialchars($item['answer'])) ?></div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Momentálne nie sú dostupné žiadne otázky a odpovede.</p>
      <?php endif; ?>
    </section>

  </main>
  <section class="container">
  <h2>Pridať novú otázku a odpoveď</h2>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');

    if ($question && $answer) {
      if ($qna->insertQnA($question, $answer)) {
        echo '<p style="color:green;">Otázka bola úspešne pridaná.</p>';
      } else {
        echo '<p style="color:red;">Táto otázka a odpoveď už existujú.</p>';
      }
    } else {
      echo '<p style="color:red;">Vyplňte obidve polia.</p>';
    }
  }
  ?>

  <form method="post" class="form">
    <label for="question">Otázka:</label><br>
    <textarea name="question" id="question" rows="3" style="width:100%;" required></textarea><br><br>

    <label for="answer">Odpoveď:</label><br>
    <textarea name="answer" id="answer" rows="5" style="width:100%;" required></textarea><br><br>

    <button type="submit">Pridať</button>
  </form>
</section>


  <footer class="container bg-dark text-white">
    <div class="row">
      <div class="col-25">
        <h4>Kto sme</h4>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
        <p>Laboris duis ut est fugiat et reprehenderit magna labore aute.</p>
      </div>
      <div class="col-25 text-left">
        <h4>Kontaktujte nás</h4>
        <p><i class="fa fa-envelope" aria-hidden="true"><a href="mailto:livia.kelebercova@gmail.com"> livia.kelebercova@gmail.com</a></i></p>
        <p><i class="fa fa-phone" aria-hidden="true"><a href="tel:0909500600"> 0909500600</a></i></p>
      </div>
      <div class="col-25">
        <h4>Rýchle odkazy</h4>
        <p><a href="/">Domov</a></p>
        <p><a href="/qna">Q&A</a></p>
        <p><a href="/kontakt">Kontakt</a></p>
      </div>
      <div class="col-25">
        <h4>Nájdete nás</h4>
        <iframe src="https://www.google.com/maps/embed?pb=..." width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
    <div class="row">
      Created and designed by Lívia
    </div>
  </footer>

  <script src="js/accordion.js"></script>
  <script src="js/menu.js"></script>
</body>
</html>
