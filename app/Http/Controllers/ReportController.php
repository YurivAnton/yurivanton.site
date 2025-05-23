<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Worker;
use App\Models\Report;
use App\Models\DateTransport;
use App\Models\Technik;
use App\Models\SparePart;
use Carbon\Carbon;

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

    public function saveReport(Request $request)
    {
        $request->validate([
            'reportNumber' => 'required|string',
            'description' => 'nullable|string',
            'date.*' => 'required|date',
            'transportKm.*' => 'required|numeric',
            // і т.д.
        ]);

        DB::beginTransaction();
        try {
            $report = new Report;
            
            $report->reportNumber = $request->input('reportNumber');
            $report->customer_id = $request->input('officeName');
            $report->office_id = $request->input('officeName');
            $report->description = $request->input('description');
            $report->descriptionResult = $request->input('descriptionResult');
            $report->typeDevice = $request->input('typeDevice');
            $report->snDevice = $request->input('snDevice');
            $report->coolant = $request->input('coolant');
            $report->newCoolant = $request->input('newCoolant');
            $report->oldCoolant = $request->input('oldCoolant');
            $report->mainTech = $request->input('mainTech');
            $report->signTech = $request->input('signTech');
            $report->nameCustomerSign = $request->input('nameCustomerSign');
            $report->signCustomer = $request->input('signCustomer');

            if (!$report->save()) {
                throw new \Exception('Не вдалося зберегти репорт.');
            }
            
            foreach($request->input('date') as $key => $elem){
                $dateTransport = new DateTransport;

                $dateTransport->date = $request->input('date')[$key];
                $dateTransport->transportKm = $request->input('transportKm')[$key];
                $dateTransport->transportTime = $request->input('transportTime')[$key];
                $dateTransport->report_id = $report->id;

                if (!$dateTransport->save()) {
                    throw new \Exception('Не вдалося зберегти репорт.');
                }
            }

            /* for($i=0; $i < count($request->input('date')); $i++){
                $dateTransport = new DateTransport;

                $dateTransport->date = $request->input('date')[$i];
                $dateTransport->transportKm = $request->input('transportKm')[$i];
                $dateTransport->transportTime = $_POST['transportTime'][$i];
                $dateTransport->report_id = $report->id;

                if (!$dateTransport->save()) {
                    throw new \Exception('Не вдалося зберегти репорт.');
                }
            } */

            for($i=0; $i < count($_POST['technikName']); $i++){
                $technik = new Technik;

                $technik->worker_id = $_POST['technikName'][$i];
                $technik->startTime = $_POST['startTime'][$i];
                $technik->finishTime = $_POST['finishTime'][$i];
                $technik->report_id = $report->id;

                if (!$technik->save()) {
                    throw new \Exception('Не вдалося зберегти репорт.');
                }
            }

            for($i=0; $i < count($_POST['nameSparePart']); $i++){
                $sparePart = new SparePart;

                $sparePart->nameSparePart = $_POST['nameSparePart'][$i];
                $sparePart->quantitySparePart = $_POST['quantitySparePart'][$i];
                $sparePart->noteSparePart = $_POST['noteSparePart'][$i];
                $sparePart->report_id = $report->id;

                if (!$sparePart->save()) {
                    throw new \Exception('Не вдалося зберегти репорт.');
                }
            }

            DB::commit();

            return response()->json([
                'success' => true, 'report_id' => $report->id]
            );

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Помилка при збереженні: ' . $e->getMessage()
            ], 500);
        }
    }

    private function reportNumber(){
        $latestReport = Report::latest()->first();

        if($latestReport){
            return Carbon::now()->format('Ym') . '-' . ($latestReport->id + 1);
        }

        return $reportNumber = Carbon::now()->format('Ym') .'-1'; 
    }
}
