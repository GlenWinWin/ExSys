<?php

	require("fpdf.php");
	$pdf = new FPDF('L');
	// var_dump(get_class_methods($pdf));

	$pdf->AddPage();

	$pdf->SetFont("Helvetica", "", 20);
	$pdf->Cell(0, 10, "Examination System", 1);
	$pdf->Output();
?>