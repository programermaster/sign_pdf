<?php

namespace App\Http\Controllers;
use App\Http\Resourse\PdfResourse;
use App\Models\Pdf;
use App\Http\Requests\Pdf\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use App\Http\Resourse\PdfCollection;

class PDFController extends Controller
{

    public function index(){
        return view('index');
    }

    public function edit(){
        return view('edit');
    }

    public function list(){
        $pdfs = Pdf::all();

        return new PdfCollection($pdfs);
    }

    public function store(Request $request){
        $pdf = $request->file('pdf');
        $encoded_image = explode(",", $request->signed_image)[1];
        $decoded_image = base64_decode($encoded_image);

        //store signed image
        Storage::disk('public')->put($pdf->getClientOriginalName().".png", $decoded_image);

        //store original pdf
        $pathOriginalPdf = Storage::disk('public')->putFileAs('/', $pdf, $pdf->getClientOriginalName());

        $fpdi = new FPDI;
        //find last page and put sign image
        $max_page = $fpdi->setSourceFile(Storage::disk('public')->path($pathOriginalPdf));
        for($i=1; $i<$max_page;$i++){
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
        }

        $template = $fpdi->importPage($max_page);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
        $fpdi->useTemplate($template);

        $fpdi->Image(Storage::disk('public')->path($pdf->getClientOriginalName().".png"), 120, 240);

        $fpdi->Output(Storage::disk('public')->path(pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) ."_signed.pdf"), 'F');

        Pdf::query()->create([
            "original_pdf"=>$pdf->getClientOriginalName(),
            "signed_pdf"=>pathinfo($pdf->getClientOriginalName(),PATHINFO_FILENAME) ."_signed.pdf"
        ]);

        Storage::disk('public')->delete($pdf->getClientOriginalName().".png");

        return redirect()->route('index');
    }
}
