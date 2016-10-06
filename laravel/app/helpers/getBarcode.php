<?php 

function get_barcode($stockNumber)
{
	$barcodeobj = new \TCPDFBarcode($stockNumber, 'C128');
	return $barcodeobj->getBarcodeHTML(2, 30, 'black');
}