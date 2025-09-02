<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PdfController extends Controller
{
    public function generate(Request $request)
    {
        $fields = [
            'reportNumber'      => '',
            'customerName'      => '',
            'customerAddress'   => '',
            'customerCity'      => '',
            'officeName'        => '',
            'officeAddress'     => '',
            'officeCity'        => '',
            'technikName'       => [],
            'date'              => [],
            'startTime'         => [],
            'finishTime'        => [],
            'transportKm'       => '',
            'transportTime'     => '',
            'description'       => '',
            'descriptionResult' => '',
            'typeDevice'        => '',
            'snDevice'          => '',
            'coolant'           => '',
            'oil'               => '',
            'newCoolant'        => '',
            'newOil'            => '',
            'oldCoolant'        => '',
            'oldOil'            => '',
            'nameSparePart'     => [],
            'quantitySparePart' => [],
            'noteSparePart'     => [],
            'mainTech'          => '',
            'signTech'          => '',
            'signTechPath'      => '',
            'nameCustomerSign'  => '',
            // 'signCustomer'      => '',
        ];

        // 2. Формуємо масив $data з реквеста + дефолтів
        $data = [];
        foreach ($fields as $field => $default) {
            $data[$field] = $request->input($field, $default);
        }

        // 3. Рахуємо відпрацьований час
        $workedTime = [];
        $sumWorkedTime = '';
        $startTimes = $data['startTime'];
        $finishTimes = $data['finishTime'];

        foreach ($startTimes as $i => $start) {
            $end = $finishTimes[$i] ?? null;

            if ($start && $end) {
                $startSec = strtotime($start);
                $endSec = strtotime($end);

                $workedTime[] = round(($endSec - $startSec) / 3600, 2);
            }
        }

        if (!empty($workedTime)) {
            $sumWorkedTime = array_sum($workedTime);
        }

        $data['workedTime'] = $workedTime;
        $data['sumWorkedTime'] = $sumWorkedTime;

        // 4. Обробка підпису клієнта (збереження як файл)
        if ($request->filled('signCustomer')) {
            $signCustomerBase64 = $request->input('signCustomer');
            $signCustomerBase64 = preg_replace('#^data:image/\w+;base64,#i', '', $signCustomerBase64);
            $signCustomerBinary = base64_decode($signCustomerBase64);
            if ($signCustomerBinary !== false && strlen($signCustomerBinary) > 100) {
                $signCustomerName = 'cust_' . $request->input('reportNumber') . '.png';
                $diskPath = 'signatures/' . $signCustomerName;



                /* $signCustomerBase64 = preg_replace('#^data:image/\w+;base64,#i', '', $request->input('signCustomer'));

                $signCustomerBinary = base64_decode($signCustomerBase64);
                $signCustomerName = 'cust_' . ($data['reportNumber'] ?: 'no_number') . '.png';
                $diskPath = 'signatures/' . $signCustomerName; */

                Storage::disk('public')->put($diskPath, $signCustomerBinary);

                // $data['signCustomer'] = 'storage/' . $diskPath;
                // $data['signCustomer'] = asset('storage/' . $diskPath);
                $data['signCustomer'] = storage_path('app/public/' . $diskPath);
            } else {
                $data['signCustomer'] = storage_path('app/public/signatures/default-sign.png');
            } 
        } else {
            $data['signCustomer'] = storage_path('app/public/signatures/default-sign.png');
        }

        // 5. Генеруємо PDF
        $pdf = Pdf::loadView('pdf.template', $data);

        return $pdf->stream('dokument.pdf');
    }
}
