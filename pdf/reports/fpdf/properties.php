<?php
require('fpdf/fpdf.php');
mysql_connect('localhost','root','');
mysql_select_db('database_santolan');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$locquery=mysql_query("select * from ptr where reservno = '0000187' group by ptr_id asc") or die(mysql_error());

while($locrow=mysql_fetch_array($locquery))
{
    $pdf->Cell(30, 6, $locrow['location'], 1, 0, 'C');
}
$pdf->Ln();
$fquoquery=mysql_query("select distinct fquo_id as 'fquo_id' from passengers where reservno = '0000187' group by pass_id asc") or die(mysql_error());
while($fquorow=mysql_fetch_array($fquoquery))
{
    $fquo=$fquorow['fquo_id'];
    $passquery=mysql_query("select * from passengers where fquo_id = '$fquo' group by pass_id asc") or die(mysql_error());
    while($passrow=mysql_fetch_array($passquery))
    {
        $pdf->Cell(30, 6, $passrow['pass_name'], 1, 0, 'C');
    }
    $pdf->Ln();
}
$pdf->Output();
?>