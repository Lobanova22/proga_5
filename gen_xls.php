<?php
include("checks.php");
require_once 'connect1.php';
require_once('php_excel/Classes/PHPExcel.php');
require_once('php_excel/Classes/PHPExcel/Writer/Excel2007.php');

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к БД";
}

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

$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Экзамены');
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Экзамены');
$sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
// Объединяем ячейки
$sheet->mergeCells('A1:I1');
// Выравнивание текста
$sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$c = 0;

$header = array("п/п", "Группа", "Факультет", "Аудитория", "Дата экзамена");
foreach ($header as $h) {
    $sheet->setCellValueByColumnAndRow($c, 2, $h);
    // Применяем выравнивание
    $sheet->getColumnDimensionByColumn($c)->setAutoSize(true);
    $c++;
}

if ($result) {
    $r = 3;
    // Для каждой строки из запроса
    while ($row = $result->fetch_row()) {
        $c = 0;

        $sheet->setCellValueByColumnAndRow($c, $r, $r - 2);
        $c++;

        foreach ($row as $cell) {
            if ($c == 4) {
                $cell = date('d-m-Y', strtotime($cell));
            }
            $sheet->setCellValueByColumnAndRow($c, $r, $cell);
            $c++;
        }
        $r++;
    }
}

header('Content-Type: application/xls');
header('Content-Disposition: inline; filename=exame.xls');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output');
?>