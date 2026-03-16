<?php


namespace App\Services;

use Mpdf\Mpdf as PDF;

use Illuminate\Support\Facades\Storage;

class PDFDownload
{
    private $fileName, $html, $data;


    public function __construct($fileName, $html, $data)
    {
        $this->fileName = $fileName;
        $this->html = $html;
        $this->data = $data;
    }

    public function download()
    {
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'Khmeros',
            'orientation' => 'L',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $this->fileName . '"'
        ];
        $document->WriteHTML(view($this->html, $this->data));

        // Save PDF on your public storage
        Storage::disk('public')->put($this->fileName, $document->Output($this->fileName, "S"));

        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($this->fileName, 'Request', $header); //
    }
}
