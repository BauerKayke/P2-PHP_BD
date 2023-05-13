<?php
$i = 0;
$personName = "";
$email = "";
$cidade = "";
$totalF = 0;
$id = "";
$titles = "";
$totalS = 0;
$titlesSeries = "";
$idsSeries = "";
$totalT = 0;
$timestamp = '';

require_once '../lib/TCPDF-main/tcpdf.php';

foreach ($_COOKIE as $key) {
  $i++;
  break;
}
if ($i != 0) {
  date_default_timezone_set('America/Sao_Paulo');

  $dataFilmes = file_get_contents('../data/movies.json');
  $itemsFilmes = json_decode($dataFilmes);

  $dataSeries = simplexml_load_file('../data/series.xml')->series;

  if (isset($_POST['firstname'], $_POST['email'])) {
    $email = $_POST['email'];
    $personName = $_POST['firstname'];
  }

  foreach ($itemsFilmes as $item) {
    foreach ($_COOKIE as $key => $n) {
      if ($item->id == $key) {
        $id = $id . "\n\t - " . $item->id;
        $titles = $titles . "\n\t - " . $item->title;
        $totalF += $item->price;
      }
    }
  }

  foreach ($dataSeries->children() as $data) {
    foreach ($_COOKIE as $key => $ids) {
      if ($data->id == $key) {
        $idsSeries = $idsSeries . "\n\t - " . $data->id;
        $titlesSeries = $titlesSeries . "\n\t - " . $data->name;
        $totalS += $data->price;
      }
    }
  }
  $totalT = $totalF + $totalS;

  //api para pegar localizacao
  try {
    $url = "http://ip-api.com/json";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
  } catch (Exception $e) {
    echo $e;
  }
  $cidade = isset($data['city']) ? $data['city'] : 'Não identificado';
  $timestamp = date("d-m-Y_H_i_s");
}

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetTitle('Nota Fiscal');
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->AddPage();
// Configurar a fonte a ser usada na célula
$pdf->SetFont('helvetica', 'B', 16);

// Definir o conteúdo da célula com a string em negrito
$txt = <<<EOD
Nota Fiscal
EOD;

// print a block of text using Write()
$pdf->Write(20, $txt, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('times', '', 12);

$pdf->Cell(0, 10, "Nome: " . $personName);
$pdf->Ln();
$pdf->Cell(0, 10, "Email: " . $email);
$pdf->Ln();
$pdf->Cell(0, 10, "Cidade: " . $cidade);
$pdf->Ln();
$pdf->Cell(0, 10, "Data: " . date("d-m-Y H:i:s"));
$pdf->Ln();
$pdf->SetLineWidth(0.2);
$pdf->Line(10, $pdf->GetY() + 5, 200, $pdf->GetY() + 5);
$pdf->Ln(5);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY(), array('width' => 0.2, 'color' => array(0, 0, 0)));

if ($totalF != 0) {
  $totalF = "R$" . number_format($totalF, 2, ',', '.');
  $pdf->Ln();
  $pdf->Cell(0, 10, "Filmes alugados: " . $titles);
  $pdf->Ln();
  $pdf->Cell(0, 10, "ID dos filmes alugados: " . $id);
  $pdf->Ln();
  $pdf->Cell(0, 10, "Valor pago nos filmes: " . $totalF);
  $pdf->Ln();
  $pdf->SetLineWidth(0.2);
  $pdf->Line(10, $pdf->GetY() + 5, 200, $pdf->GetY() + 5);
  $pdf->Ln(5);
  $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY(), array('width' => 0.2, 'color' => array(0, 0, 0)));
  $pdf->Ln(5);
  
}
if ($totalS != 0) {
  $totalS = "R$" . number_format($totalS, 2, ',', '.');
  $pdf->Cell(0, 10, "Series alugadas: " . $titlesSeries);
  $pdf->Ln();
  $pdf->Cell(0, 10, "ID das series alugadas: " . $idsSeries);
  $pdf->Ln();
  $pdf->Cell(0, 10, "Valor pago nas series: " . $totalS);
  $pdf->Ln(10);
  $pdf->SetLineWidth(0.2);
  $pdf->Line(10, $pdf->GetY() + 5, 200, $pdf->GetY() + 5);
  $pdf->Ln(5);
  $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY(), array('width' => 0.2, 'color' => array(0, 0, 0)));
}
$totalT = "R$" . number_format($totalT, 2, ',', '.');
$pdf->Ln(5);
$pdf->Cell(0, 10, "Valor total: " . $totalT);
$pdf->Ln();


// Gerar o arquivo PDF e enviar para o navegador para download
$pdf->Output("notaFiscal_" . $timestamp . ".pdf", 'D');
foreach ($_COOKIE as $key => $value) {
  // Define uma data de validade passada para o cookie
  setcookie($key, '', time() - 3600, '/');
}
?>
