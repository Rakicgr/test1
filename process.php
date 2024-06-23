<?php
// Učitaj JpGraph potrebne datoteke
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_pie.php');
require_once ('jpgraph/src/jpgraph_pie3d.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numEmployees = $_POST['numEmployees'];
    $businessCategory = $_POST['businessCategory'];
    $revenueEstimate = $_POST['revenueEstimate'];
    $marketArea = $_POST['marketArea'];
    $numOwners = $_POST['numOwners'];

    $recommendation = "";
    $explanation = "";

    // Logika za određivanje preporuke
    if ($numEmployees == '1' && $revenueEstimate == '<50000' && $numOwners == '1') {
        $recommendation = "Preporučamo otvaranje obrta.";
        $explanation = "Obrti su idealni za samostalne poduzetnike s niskim početnim troškovima i manjim prihodima. Brže i jeftinije je otvoriti obrt u usporedbi s drugim pravnim oblicima.";
    } elseif ($numOwners != '1' && $revenueEstimate == '100000+') {
        $recommendation = "Preporučamo otvaranje d.o.o.";
        $explanation = "Društvo s ograničenom odgovornošću (d.o.o.) je prikladno za poduzetnike s višim prihodima i većim brojem suvlasnika. Omogućava ograničenu osobnu odgovornost vlasnika, što znači da su vlasnici odgovorni samo do visine svog uloga.";
    } else {
        $recommendation = "Preporučamo otvaranje j.d.o.o.";
        $explanation = "Jednostavno društvo s ograničenom odgovornošću (j.d.o.o.) je dobro za poduzetnike s nižim prihodima i više suvlasnika. Ima niže troškove osnivanja od standardnog d.o.o.-a, ali nudi slične prednosti kao što su ograničena odgovornost.";
    }

    // Generiranje analize i grafova
    $analysis = generateAnalysis($numEmployees, $businessCategory, $revenueEstimate, $marketArea, $numOwners, $recommendation);

    // Prikaz rezultata
    echo "<div class='container mt-5'>";
    echo "<div class='card shadow-lg border-0'>";
    echo "<div class='card-header bg-success text-white text-center'><h1>Vaša preporuka</h1></div>";
    echo "<div class='card-body p-5'>";
    echo "<p class='lead'>$recommendation</p>";
    echo "<p>$explanation</p>";
    echo $analysis;
    echo "<a href='index.html' class='btn btn-primary'>Natrag</a>";
    echo "</div></div></div>";
}

function generateAnalysis($numEmployees, $businessCategory, $revenueEstimate, $marketArea, $numOwners, $recommendation) {
    $analysis = "<h2>Analiza i Objašnjenje</h2>";
    $analysis .= "<p>Detaljna analiza za preporuku otvaranja $recommendation:</p>";

    // Dummy data for generating charts
    $categories = ['Obrt', 'j.d.o.o.', 'd.o.o.'];
    $values = [20, 30, 50];

    // Generiranje pie chart
    $pieChart = generatePieChart($categories, $values);
    $analysis .= "<h3>Distribucija Preporuka</h3>";
    $analysis .= "<img src='data:image/png;base64," . base64_encode($pieChart) . "' />";

    return $analysis;
}

function generatePieChart($categories, $values) {
    // Set up the graph
    $graph = new PieGraph(400, 300);
    $graph->SetShadow();
    $graph->title->Set("Distribucija Preporuka");

    // Set up the pie plot
    $piePlot = new PiePlot($values);
    $piePlot->SetLegends($categories);
    $piePlot->SetCenter(0.4);
    $graph->Add($piePlot);

    // Output the graph as a PNG image
    ob_start();
    $graph->Stroke(_IMG_HANDLER);
    $image = ob_get_contents();
    ob_end_clean();

    return $image;
}
?>
