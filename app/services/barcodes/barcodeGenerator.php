<?php namespace Services\Barcodes;

class barcodeGenerator {
	protected $stock;

	public function __construct()
	{
		$this->stock = \App::make('StockItemRepository');
	}

	public function generate($id) 
	{
		$stock = $this->stock->find($id);

		$pagelayout = array(62, 29); //  or array($height, $width) 

		// create new PDF document
		$pdf = new \TCPDF('l', 'mm', $pagelayout, true, 'UTF-8', false);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


		$pdf->SetFont('helvetica', '', 11);

		$pdf->AddPage();

		$pdf->SetFont('helvetica', '', 6);

		// define barcode style
		$style = array(
			'position' => '0',
			'align' => 'P',
			'stretch' => true,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'hpadding' => '0',
			'vpadding' => '0',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 4
		);

		$pdf->setY('20');

		// $txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
		// $pdf->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
		// $pdf->SetY(30);

		// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
		$pdf->SetXY( 1, 17 );
		$txt = $stock->stock_description;
		$pdf->Cell(0, 0, $txt, 0, 1);

		$pdf->SetXY( 1, 20 );
		$txt = 'Created On: '. date('F j, Y', strtotime($stock->created_at));
		$pdf->Cell(0, 0, $txt, 0, 1);

		$pdf->write1DBarcode($stock->stock_number, 'C39', '3', '2', '55', '15', 1, $style, 'N');

		//Close and output PDF document
		return $pdf->Output('barcode.pdf', 'I');
	}

	public function htmlBarcode()
	{
		$barcodeobj = new \TCPDFBarcode('123456', 'C128');
		return $barcodeobj->getBarcodeHTML(2, 30, 'black');
	}

}