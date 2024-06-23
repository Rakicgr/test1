<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numEmployees = $_POST['numEmployees'];
    $businessCategory = $_POST['businessCategory'];
    $revenueEstimate = $_POST['revenueEstimate'];
    $marketArea = $_POST['marketArea'];
    $numOwners = $_POST['numOwners'];

    if ($numEmployees == '1' && $revenueEstimate == '<50000' && $numOwners == '1') {
    $recommendation = "Preporučamo otvaranje obrta.";
} elseif ($numOwners != '1' && $revenueEstimate == '100000+') {
    $recommendation = "Preporučamo otvaranje d.o.o.";
} else {
    $recommendation = "Preporučamo otvaranje j.d.o.o.";
}

    if ($numEmployees <= 5 && $revenueEstimate < 50000 && $numOwners == 1) {
        $recommendation = "Preporučamo otvaranje obrta.";
    } elseif ($numOwners > 1 && $revenueEstimate > 100000) {
        $recommendation = "Preporučamo otvaranje d.o.o.";
    } else {
        $recommendation = "Preporučamo otvaranje j.d.o.o.";
    }

    // Prikaz rezultata
echo "<div class='container mt-5'>";
echo "<div class='card shadow-lg border-0'>";
echo "<div class='card-header bg-success text-white text-center'><h1>Vaša preporuka</h1></div>";
echo "<div class='card-body p-5'>";
echo "<p class='lead'>$recommendation</p>";
echo "<a href='index.html' class='btn btn-primary'>Natrag</a>";
echo "</div></div></div>";

echo "<div class='container mt-5'>";
echo "<div class='card shadow-lg border-0'>";
echo "<div class='card-header bg-success text-white text-center'><h1>Vaša preporuka</h1></div>";
echo "<div class='card-body p-5'>";
echo "<p class='lead'>$recommendation</p>";
echo "<a href='index.html' class='btn btn-primary'>Natrag</a>";
echo "</div></div></div>";

echo "<div class='container mt-5'>";
echo "<div class='card shadow-lg border-0'>";
echo "<div class='card-header bg-success text-white text-center'><h1>Vaša preporuka</h1></div>";
echo "<div class='card-body p-5'>";
echo "<p class='lead'>$recommendation</p>";
echo "<a href='index.html' class='btn btn-primary'>Natrag</a>";
echo "</div></div></div>";

    echo "<div class='container mt-5'>";
    echo "<div class='card'>";
    echo "<div class='card-header'><h1>Vaša preporuka</h1></div>";
    echo "<div class='card-body'>";
    echo "<p class='lead'>$recommendation</p>";
    echo "<a href='index.html' class='btn btn-primary'>Natrag</a>";
    echo "</div></div></div>";
}
?>
