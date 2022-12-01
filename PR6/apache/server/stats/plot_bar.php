<?php
require_once '/etc/apache2/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_bar(): void
{
    $graph = new Graph\Graph(400, 300, 'auto');
    $graph->SetShadow();

    $labels_and_values = get_labels_and_values('get_gender_type_count');
    $labels = $labels_and_values["labels"];
    $values = $labels_and_values["values"];

    $databary = $values;
    $graph->SetScale('textlin');
    $graph->xaxis->SetTickLabels($labels);
    $graph->title->Set($_GET['property']);
    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    $b1 = new Plot\BarPlot($databary);
    $b1->SetLegend($_GET['property']);
    $graph->Add($b1);

    $graph->Stroke('images/plot_bar.png');
}