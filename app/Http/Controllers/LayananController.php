<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use App\Models\Layanan;
use App\Models\Warga;

use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class LayananController extends Controller
{
    public function byJenis($id)
    {
        return view('layanans.by-jenis', compact('id'));
    }

    public function export(Request $request, $jenisLayananId, $searchYear = null, $searchMonth = 'all')
    {
        $jenisLayanan = JenisLayanan::findOrFail($jenisLayananId);
        
        if ($searchMonth === 'all') {
            $searchMonth = null;
        }
        // Fetch the Layanan records based on the provided filters
        // dd("dasher");

        $layanans = Layanan::where('jenis_layanan_id', $jenisLayananId)
            ->when($searchMonth, function ($query) use ($searchMonth) {
                return $query->whereMonth('created_at', $searchMonth);
            })
            ->when($searchYear, function ($query) use ($searchYear) {
                return $query->whereYear('created_at', $searchYear);
            })
            ->with(['jenisLayanan', 'warga'])
            ->orderBy('created_at', 'desc')
            ->get();

        
        if($jenisLayananId == 6){
            $header = ['No', 'Nama Lengkap', 'Alamat Asal', 'NIK', 'Jenis Kelamin', 'Alamat Domisili', 'Tanggal Kedatangan'];
        }else{
            $header = ['No', 'Hari/Tgl', 'Nama Lengkap', 'NIK', 'Alamat', 'Keperluan', 'Hasil Pelayanan', 'Kode Arsip', 'Keterangan'];    
        }

        $data = [];
        $data[] = $header;
        foreach ($layanans as $index => $layanan) {
            if($jenisLayananId == 6){
                $data[] = [
                    $index + 1,
                    $layanan->warga->nama ?? 'N/A',
                    $layanan->warga->alamat_asal ?? 'N/A',
                    $layanan->warga->nik ?? 'N/A',
                    $layanan->warga->jenis_kelamin ?? 'N/A',
                    $layanan->warga->alamat_domisili ?? 'N/A',
                    (($layanan->warga->tanggal_kedatangan ?? '') !== '' ? \Carbon\Carbon::parse($layanan->warga->tanggal_kedatangan)->locale('id')->translatedFormat('l, d F Y') : 'N/A'),
                ];
                continue;
            }else{
                $data[] = [
                    $index + 1,
                    \Carbon\Carbon::parse($layanan->created_at)->locale('id')->translatedFormat('l, d F Y'),
                    $layanan->warga->nama ?? 'N/A',
                    $layanan->warga->nik ?? 'N/A',
                    $layanan->warga->alamat_domisili ?? 'N/A',
                    $layanan->jenisLayanan->nama_jenis_layanan ?? 'N/A',
                    $layanan->hasil_pelayanan ?? 'N/A',
                    $layanan->kode_arsip ?? 'N/A',
                    $layanan->keterangan ?? 'N/A',
                ];
            }
        }

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Loop isi data ke sel Excel
        foreach ($data as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                // Misal: A1, B1, C1 dst
                $cell = chr(65 + $colIndex) . ($rowIndex + 1);
                $sheet->setCellValue($cell, $value);
            }
        }

        // set header text bold
        $sheet->getStyle('A1:' . chr(65 + count($header) - 1) . '1')->getFont()->setBold(true);
        // Set lebar kolom otomatis
        foreach (range('A', chr(65 + count($header) - 1)) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        // set border color semua kolom
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A1:' . chr(65 + count($header) - 1) . (count($data)))->applyFromArray($styleArray);

        // Simpan file ke sementara
        $writer = new Xlsx($spreadsheet);
        $fileName = 'export report '.$jenisLayanan->nama_jenis_layanan.' '.$searchMonth.' '.$searchYear.'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        // Kirim file sebagai download
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        //
    }
}
