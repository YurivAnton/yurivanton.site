<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PdfController extends Controller
{
    public function generate(Request $request)
    {
        $workedTime = [];
        $startTimes = $request->input('startTime');
        $finishTimes = $request->input('finishTime');

        foreach ($startTimes as $i => $start) {
            $end = $finishTimes[$i] ?? null;

            if ($start && $end) {
                $startSec = strtotime($start);
                $endSec = strtotime($end);

                $workedTime[] = round(($endSec - $startSec) / 3600, 2);
            } else {
                $workedTime[] = '---';
            }
        }

        $sumWorkedTime = array_sum($workedTime);

        if ($request->filled('signCustomer')) {
            $signCustomerBase64 = $request->input('signCustomer');
            $signCustomerBase64 = preg_replace('#^data:image/\w+;base64,#i', '', $signCustomerBase64);
            $signCustomerBinary = base64_decode($signCustomerBase64);
            $signCustomerName = 'cust_' . $request->input('reportNumber') . '.png';
            $diskPath = 'signatures/' . $signCustomerName;

            // if (!Storage::disk('public')->exists($diskPath)) {
                Storage::disk('public')->put($diskPath, $signCustomerBinary);
            // }

            $signCustomerPath = 'storage/' . $diskPath; 
        }
        
        $data = $request->only([
            'reportNumber',
            'customerName',
            'customerAddress',
            'customerCity',
            'officeName',
            'officeAddress',
            'officeCity',
            'technikName',
            'date',
            'startTime',
            'finishTime',
            'transportKm',
            'transportTime',
            'description',
            'descriptionResult',
            'typeDevice',
            'snDevice',
            'coolant',
            'oil',
            'newCoolant',
            'newOil',
            'oldCoolant',
            'oldOil',
            'nameSparePart',
            'quantitySparePart',
            'noteSparePart',
            'mainTech',
            'signTech',
            'signTechPath',
            'nameCustomerSign',
            'signCustomer'
        ]);
        $data['workedTime'] = $workedTime;
        $data['sumWorkedTime'] = $sumWorkedTime;

        $pdf = Pdf::loadView('pdf.template', $data);
        return $pdf->stream('dokument.pdf');
    }
}
