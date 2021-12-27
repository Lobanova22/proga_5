<?php
include("checks.php");
require('tfpdf/tfpdf.php');
require_once 'connect1.php';
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к БД";
}

$pdf = new tFPDF();
$pdf->AddFont('PDFFont', '', 'cour.ttf');
$pdf->SetFont('PDFFont', '', 12);
$pdf->AddPage();

$pdf->Cell(80);
$pdf->Cell(30, 10, 'Экзамены', 1, 0, 'C');
$pdf->Ln(20);

$pdf->SetFillColor(200, 200, 200);
$pdf->SetFontSize(6);

$header = array("п/п", "Группа", "Факультет", "Аудитория", "Дата экзамена");
$w = array(6, 20, 25, 20, 20);
$h = 20;
for ($c = 0; $c < 5; $c++) {
    $pdf->Cell($w[$c], $h, $header[$c], 'LRTB', '0', '', true);
}
$pdf->Ln();

// Запрос на выборку сведений о пользователях
$result = $mysqli->query("SELECT
        subject.fac_s as fac_s,
        grup.name_g,
        rasp.audit as audit,
        rasp.date_ex as date_ex

        FROM rasp
        LEFT JOIN subject ON rasp.id_s=subject.id_s
        LEFT JOIN grup ON rasp.id_g=grup.id_g"
);

if ($result) {
    $counter = 1;
    // Для каждой строки из запроса
    while ($row = $result->fetch_row()) {
        $pdf->Cell($w[0], $h, $counter, 'LRBT', '0', 'C', true);
        $pdf->Cell($w[1], $h, $row[0], 'LRB');

        for ($c = 2; $c < 5; $c++) {
            if ($c == 4) {
                $row[$c - 1] = date('d-m-Y', strtotime($row[$c - 1]));
            }
            $pdf->Cell($w[$c], $h, $row[$c - 1], 'RB');
        }
        $pdf->Ln();
        $counter++;
    }
}

$pdf->Output("I", 'exame.pdf', true);
?>