<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReportRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Worker;
use App\Models\Report;
use App\Models\Technik;
use App\Models\SparePart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\ReportMail;

class ReportController extends Controller
{
    public function show()
    {
        return view('dashboard');
    }

    public function newReport()
    {
        $customers = Customer::with('offices')->get();
        $workers = Worker::all();
        $reportNumber = self::reportNumber();

        return view('newReport', [
            'customers' => $customers,
            'workers' => $workers,
            'reportNumber' => $reportNumber,
        ]);
    }

    public function saveReport(StoreReportRequest $request)
    {
        DB::beginTransaction();
        
        try {
            $this->storeReportData($request);

            DB::commit();

            return redirect()
                ->route('report')
                ->with('success', 'Report bol úspešne uložený.');

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Помилка при збереженні: ' . $e->getMessage()
            ], 500);
        }
    }

    public function saveAndSend(StoreReportRequest $request)
    {
        DB::beginTransaction();
        try {
            $report = $this->storeReportData($request);

            // 🔧 Обчислення годин
            $workedTime = [];
            foreach ($request->startTime as $i => $start) {
                $end = $request->finishTime[$i] ?? null;
                if ($start && $end) {
                    $workedTime[] = round((strtotime($end) - strtotime($start)) / 3600, 2);
                } else {
                    $workedTime[] = '---';
                }
            }

            $sumWorkedTime = array_sum(array_filter($workedTime, 'is_numeric'));

            DB::commit();

            // 📄 Дані для PDF
            $data = $request->all();
            $data['workedTime'] = $workedTime;
            $data['sumWorkedTime'] = $sumWorkedTime;

            $pdf = Pdf::loadView('pdf.template', $data);
            $pdfPath = storage_path('app/public/reports/report_' . $report->id . '.pdf');
            Storage::disk('public')->put('reports/report_' . $report->id . '.pdf', $pdf->output());

            $email = $request->input('customerEmail');

            if(empty($email)){
                $email = $request->input('sendEmail');
            }
            // ✉️ Надіслати PDF на e-mail
            Mail::to($email) // заміни на потрібний e-mail
                ->send(new ReportMail($pdfPath, $report->reportNumber));

            return redirect()->route('report')->with('success', 'Report uložený a odoslaný e-mailom.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Chyba pri ukladaní alebo odoslaní: ' . $e->getMessage()]);
        }
    }

    private function reportNumber(){
        $latestReport = Report::latest()->first();

        if($latestReport){
            return Carbon::now()->format('Ym') . '-' . ($latestReport->id + 1);
        }

        return $reportNumber = Carbon::now()->format('Ym') .'-1'; 
    }

    private function storeReportData(StoreReportRequest $request): Report
    {
        $signCustomerPath = null;

        if ($request->filled('signCustomer')) {
            $signCustomerBase64 = preg_replace('#^data:image/\w+;base64,#i', '', $request->signCustomer);
            $signCustomerBinary = base64_decode($signCustomerBase64);
            $signCustomerName = 'cust_' . $request->reportNumber . '.png';
            $diskPath = 'signatures/' . $signCustomerName;
            Storage::disk('public')->put($diskPath, $signCustomerBinary);
            $signCustomerPath = 'storage/' . $diskPath;
        }

        $report = new Report();
        $report->reportNumber = $request->reportNumber;
        $report->customer_id = $request->customerId;
        $report->office_id = $request->officeId;
        $report->transportKm = $request->transportKm;
        $report->transportTime = $request->transportTime;
        $report->description = $request->description;
        $report->descriptionResult = $request->descriptionResult;
        $report->typeDevice = $request->typeDevice;
        $report->snDevice = $request->snDevice;
        $report->coolant = $request->coolant;
        $report->newCoolant = $request->newCoolant;
        $report->oldCoolant = $request->oldCoolant;
        $report->oil = $request->oil;
        $report->newOil = $request->newOil;
        $report->oldOil = $request->oldOil;
        $report->mainTech = $request->mainTech;
        $report->signTech = $request->signTechPath;
        $report->nameCustomerSign = $request->nameCustomerSign;
        $report->signCustomer = $signCustomerPath;

        $report->saveOrFail();

        foreach($request->input('technikName') as $key => $elem){
            $technik = new Technik;

            $technik->worker_id = $request->input('technikId')[$key];
            $technik->date = $request->input('date')[$key];
            $technik->startTime = $request->input('startTime')[$key];
            $technik->finishTime = $request->input('finishTime')[$key];
            $technik->report_id = $report->id;

            if (!$technik->save()) {
                throw new \Exception('Не вдалося зберегти працівника.');
            }
        }

        foreach($request->input('nameSparePart') as $key => $elem){
            $sparePart = new SparePart;

            $sparePart->nameSparePart = $request->input('nameSparePart')[$key];
            $sparePart->quantitySparePart = $request->input('quantitySparePart')[$key];
            $sparePart->noteSparePart = $request->input('noteSparePart')[$key];
            $sparePart->report_id = $report->id;

            if (!$sparePart->save()) {
                throw new \Exception('Не вдалося зберегти зап частину.');
            }
        }

        return $report;
    }
}
