<?php
require_once '/etc/apache2/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_pie(): void
{
    $graph = new Graph\PieGraph(400, 300);
    $graph->SetBox(true);

    $labels_and_values = get_labels_and_values('get_gender_count');
    $labels = $labels_and_values["labels"];
    $values = $labels_and_values["values"];

    $p1 = new Plot\PiePlot($values);
    $p1->ShowBorder();
    $p1->SetColor('black');
    $p1->SetLabels($labels);

    $graph->Add($p1);

    $graph->Stroke("images/plot_pie.png");
}