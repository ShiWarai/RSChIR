<?php
require_once '/etc/apache2/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class PlotModel extends Model
{
    private array $gender_type;
    private array $gender_count;
    private array $gender_and_blood;
    private string $IMAGES_PATH;

    function __construct(array $data)
    {
        $this->IMAGES_PATH = $_SERVER['DOCUMENT_ROOT']."/static/images/";

        $this->gender_type = $data['gender_type'];
        $this->gender_count = $data['gender_count'];
        $this->gender_and_blood = $data['gender_and_blood'];
    }

    function draw_plot_bar(string $plot_name): string
    {
        $graph = new Graph\Graph(400, 300, 'auto');
        $graph->SetShadow();

        $labels_and_values = $this->gender_type;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $dataarray = $values;
        $graph->SetScale('textlin');
        $graph->xaxis->SetTickLabels($labels);
        $graph->title->Set($_GET['property']);
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        $b1 = new Plot\BarPlot($dataarray);
        $b1->SetLegend($_GET['property']);
        $graph->Add($b1);

        $graph->Stroke($this->IMAGES_PATH.$plot_name.".png");
        $this->add_watermark($this->IMAGES_PATH.$plot_name.".png");

        return "/static/images/".$plot_name.".png";
    }

    function draw_plot_pie(string $plot_name): string
    {
        $graph = new Graph\PieGraph(400, 300);
        $graph->SetBox(true);

        $labels_and_values = $this->gender_count;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $p1 = new Plot\PiePlot($values);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetLabels($labels);

        $graph->Add($p1);

        $graph->Stroke($this->IMAGES_PATH.$plot_name.".png");
        $this->add_watermark($this->IMAGES_PATH.$plot_name.".png");

        return "/static/images/".$plot_name.".png";
    }

    function draw_plot_scatter(string $plot_name): string
    {
        $data = $this->gender_and_blood;
        $datax = $data["gender"];
        $datay = $data["blood"];

        $graph = new Graph\Graph(400, 300);
        $graph->SetScale('linlin');

        $graph->img->SetMargin(40, 40, 40, 40);
        $graph->SetShadow();


        $sp1 = new Plot\ScatterPlot($datay, $datax);
        $sp1->mark->SetType(MARK_FILLEDCIRCLE);
        $sp1->mark->SetFillColor("#ff8800");
        $sp1->mark->SetWidth(8);

        $graph->Add($sp1);

        $graph->Stroke($this->IMAGES_PATH.$plot_name.".png");
        $this->add_watermark($this->IMAGES_PATH.$plot_name.".png");

        return "/static/images/".$plot_name.".png";
    }

    private function add_watermark($image_name) {
        $watermark = $this->IMAGES_PATH."watermark.png";
        list($width, $height) = getimagesize($watermark);

        print_r($width, $height);

        $image = imagecreatefromstring(file_get_contents($image_name));
        $watermark = imagecreatefromstring(file_get_contents($watermark));

        imagealphablending($watermark, false);
        imagesavealpha($watermark, true);
        $alpha = round(64); // convert to [0-127]

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($watermark, $x, $y);

                $r = ($rgb >> 16) & 0xff;
                $g = ($rgb >> 8) & 0xff;
                $b = $rgb & 0xff;

                $col = imagecolorallocatealpha($watermark, $r, $g, $b, $alpha);

                imagesetpixel($watermark, $x, $y, $col);
            }
        }

        imagecopy($image, $watermark, 64, 64, 0, 0, $width, $height);
        imagepng($image, $image_name);
    }
}