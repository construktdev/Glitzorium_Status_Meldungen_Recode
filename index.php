<!DOCTYPE html>
<html lang="de">
<head>
      <meta charset="UTF-8">
      <link type="text/css" rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Glitzorium Status Updates</title>
</head>
<body>
<h2 class="header">Status Updates</h2>
<div class="nav">
      <a href="https://glitzorium.de">Startseite</a>
      <span style="margin-right: 10px"></span>
      <a href="https://glitzorium.de/support/general/support.php">Support</a>
      <span style="margin-right: 10px"></span>
      <a href="https://construkter.de/impressum.html">Impressum</a> <br>
      <p style="font-size: 12px; padding-top: 10px;">Neuste Meldungen werden zuerst angezeigt</p>
</div>
<div class="main">
    <?php
    $source = "data/data.txt";

    if (file_exists($source)) {
        $lines = file($source, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode(":", $line, 4);

            if (count($parts) == 4) {
                $datetime = $parts[0] . ":" . $parts[1];
                $title = $parts[2];
                $text = $parts[3];

                echo '
                    <div class="update">
                        <p class="date">' . $datetime . '</p>
                        <h3>' . $title . '</h3>
                        <p>' . $text . '</p>
		            </div>
                ';
            }
        }
    }
    ?>
</div>
</body>
</html>