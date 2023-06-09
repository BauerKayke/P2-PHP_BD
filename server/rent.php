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



  $conexao = mysqli_connect("localhost", "root", "", "popflix") or die("Falha de conexão");



  $tabela;
  $total = 0;




  foreach ($_COOKIE as $key => $ids) {
    $tabela = mysqli_query($conexao, "SELECT * FROM clientes");
    while ($linhas = mysqli_fetch_array($tabela)) {
      if ($ids == $linhas["usuario"]) {
        $email = $linhas['email'];
        $personName = $linhas['nome'];
      }
    }
  }


  foreach ($_COOKIE as $key => $ids) {
    if ($ids == "onCartFilm") {
      $tabela = mysqli_query($conexao, "SELECT * FROM filmes WHERE id = $key");
      while ($linhas = mysqli_fetch_array($tabela)) {
        $id = $id . "\n\t - " . $linhas["id"];
        $titles = $titles . "\n\t - " . $linhas["nome"];
        $price = "R$" . number_format($linhas["valor"], 2, ',', '.');
        $totalF += $linhas["valor"];
      }
    }
  }

  foreach ($_COOKIE as $key => $ids) {
    if ($ids == "onCartSerie") {
      $tabela = mysqli_query($conexao, "SELECT * FROM series WHERE id = $key");
      while ($linhas = mysqli_fetch_array($tabela)) {
        $idsSeries = $idsSeries . "\n\t - " . $linhas["id"];
        $titlesSeries = $titlesSeries . "\n\t - " . $linhas["nome"];
        $price = "R$" . number_format($linhas["valor"], 2, ',', '.');
        $totalS += $linhas["valor"];
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
