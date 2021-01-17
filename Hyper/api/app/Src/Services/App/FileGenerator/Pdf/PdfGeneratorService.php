<?php


namespace App\Src\Services\App\FileGenerator\Pdf;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \setasign\Fpdi\Fpdi;

abstract class PdfGeneratorService implements ILoadPdfService, ISavePdfService, IWriteLineService, IGenerateService
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var Fpdi
     */
    protected $pdf;

    /**
     * @var int
     */
    protected $x = 0;

    /**
     * @var int
     */
    protected $y = 0;

    /**
     * @var int
     */
    protected $currentPage = 0;

    /**
     * @var int
     */
    protected $totalPages;

    /**
     * @var int
     */
    const FONT_SIZE = 9;

    /**
     * @var int
     */
    const ROW_BETWEEN = 4;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->pdf = new Fpdi();
    }

    /**
     * @param string $fileName
     * @return PdfGeneratorService
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    public function load(string $fileName): PdfGeneratorService
    {
        $this->totalPages = $this->pdf->setSourceFile($this->path . '/' . $fileName);

        $this->initialise();

        return $this;
    }

    /**
     * @param int $pageNr
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException Init the pdf
     */
    public function initialise()
    {
        $this->pdf->SetFont('Arial');
        $this->pdf->SetFontSize(self::FONT_SIZE);
    }

    /**
     * @return bool
     * @throws \setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException
     * @throws \setasign\Fpdi\PdfParser\Filter\FilterException
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     * @throws \setasign\Fpdi\PdfParser\Type\PdfTypeException
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    public function addPage()
    {
        $this->currentPage++;

        if ($this->currentPage > $this->totalPages) {
            return false;
        }

        $page = $this->pdf->importPage($this->currentPage);
        $this->pdf->AddPage();
        $this->pdf->useImportedPage($page);
    }

    /**
     * @param string $text
     */
    public function writeLine(string $text)
    {
        $this->pdf->SetXY($this->x, $this->y);
        $this->pdf->Write(0, $text);
    }

    /**
     * @param float $x
     * @param float $y
     * Save last coordinates
     */
    protected function setXy(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    protected function newRow()
    {
        $this->setXy($this->x, $this->y + self::ROW_BETWEEN);
    }

    /**
     * @return PdfGeneratorService
     */
    public function save(): PdfGeneratorService
    {
        $this->generate();

        $this->pdf->Output($this->path . '/' . Str::random(32) . '.pdf', 'F');

        return $this;
    }
}
