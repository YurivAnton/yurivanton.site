<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Servisný protokol</title>
    <style>
        {!! file_get_contents(public_path('css/pdf.css')) !!}
    </style>
</head>
<body>
    <table style="width: 100%; margin-bottom: 25px;" class="no-border">
        <tr>
            {{-- Logo --}}
            <td style="width: 30%; text-align: left;">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="max-height: 60px;">
            </td>

            {{-- title --}}
            <td style="width: 40%; text-align: center; font-size: 25px; font-weight: bold; vertical-align: middle;">
                {{ __('templatePDF.title') }}
            </td>

            {{-- Company Information --}}
            <td style="width: 30%; text-align: center; font-size: 9px; line-height: 1.4;">
                <strong>{{ __('templatePDF.companyName') }}</strong><br>
                {{ __('templatePDF.companyDetails') }}
            </td>
        </tr>
    </table>

    <table class="" style=" border-collapse: collapse;">
        <tr>
            <td rowspan="3" class="orderer-title"><strong>{{ __('templatePDF.orderer') }}</strong></td>
            <td class="orderer-subtitle-name">{{ __('templatePDF.name') }}:</td>
            <td class="orderer-name">{{ $customerName ?? '---' }}</td>
            <td class="orderer-info">{{ __('templatePDF.ordererType') }}:</td>
        </tr>
        <tr>
            <td class="orderer-subtitle-address">{{ __('templatePDF.address') }}:</td>
            <td class="orderer-address">{{ $customerAddress ?? '---' }}</td>
            <td rowspan="2" class="orderer-info-data">{{ $ordererType ?? '---' }}</td>
        </tr>
        <tr>
            <td class="orderer-subtitle-city">{{ __('templatePDF.city') }}:</td>
            <td class="orderer-city">{{ $customerCity ?? '---' }}</td>
        </tr>
        <tr>
            <td rowspan="3" class="orderer-title"><strong>{{ __('templatePDF.user') }}</strong></td>
            <td class="orderer-subtitle-name">{{ __('templatePDF.name') }}:</td>
            <td class="orderer-name">{{ $officeName ?? '---' }}</td>
            <td class="orderer-info">{{ __('templatePDF.reportNum') }}:</td>
        </tr>
        <tr>
            <td class="orderer-subtitle-address">{{ __('templatePDF.address') }}:</td>
            <td class="orderer-address">{{ $officeAddress ?? '---' }}</td>
            <td rowspan="2" class="orderer-info-data">{{ $reportNumber ?? '---' }}</td>
        </tr>
        <tr>
            <td class="orderer-subtitle-city">{{ __('templatePDF.city') }}:</td>
            <td class="orderer-city">{{ $officeCity ?? '---' }}</td>
        </tr>
    </table>

    <div class="section-title">{{ __('templatePDF.summaryRecord') }}</div>
    <table>
        <tr>
            <th>{{ __('templatePDF.transport') }}</th>
            <th>{{ __('templatePDF.transportH') }}</th>
        </tr>
        <tr>
            <td>{{ $transportKm }}</td>
            <td>{{ $transportTime }}</td>
        </tr>
    </table>

    <div class="section-title">{{ __('templatePDF.detailedWorks') }}</div>
    <table>
        <thead>
            <tr>
                <th>{{ __('templatePDF.technicianName') }}</th>
                <th>{{ __('templatePDF.date') }}</th>
                <th>{{ __('templatePDF.startWork') }}</th>
                <th>{{ __('templatePDF.endWork') }}</th>
                <th>{{ __('templatePDF.hoursWorked') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = max(count($date), 1);
            @endphp
            @for($i = 0; $i < $count; $i++)
            <tr>
                <td>{{ $technikName[$i] ?? '---' }}</td>
                <td>{{ $date[$i] ?? '---' }}</td>
                <td>{{ $startTime[$i] ?? '---' }}</td>
                <td>{{ $finishTime[$i] ?? '---' }}</td>
                <td>{{ $workedTime[$i] ?? '---' }}</td>
            </tr>
            @endfor
            <tr>
                <td colspan="4">{{ __('templatePDF.sum') }}</td>
                <td>{{ $sumWorkedTime ?? '---' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">{{ __('templatePDF.description') }}</div>
    <p>{{ $description ?? '---' }}</p>

    <div class="section-title">{{ __('templatePDF.resultRecommend') }}</div>
    <p>{{ $descriptionResult ?? '---' }}</p>

    @if(!empty($typeDevice))
        <div class="section-title">{{ __('templatePDF.deviceIdent') }}</div>
        <table>
            <thead>
                <tr>
                    <th>{{ __('templatePDF.type') }}</th>
                    <th>{{ __('templatePDF.serialNumber') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $typeDevice }}</td>
                    <td>{{ $snDevice }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    @if(!empty($coolant) OR !empty($oil))
        <div class="section-title">{{ __('templatePDF.coolOil') }}</div>
        <table>
            <thead>
                <tr>
                    <th colspan="2">{{ __('templatePDF.coolant') }}</th>
                    <th colspan="2">{{ __('templatePDF.oil') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ __('templatePDF.coolantType') }}:</td>
                    <td>{{ $coolant }}</td>
                    <td>{{ __('templatePDF.oilType') }}:</td>
                    <td>{{ $oil }}</td>
                </tr>
                <tr>
                    <td>{{ __('templatePDF.newCoolant') }}:</td>
                    <td>{{ $newCoolant ?? '---' }}</td>
                    <td>{{ __('templatePDF.newOild') }}:</td>
                    <td>{{ $newOil ?? '---' }}</td>
                </tr>
                <tr>
                    <td>{{ __('templatePDF.oldCoolant') }}:</td>
                    <td>{{ $oldCoolant ?? '---' }}</td>
                    <td>{{ __('templatePDF.oldOil') }}:</td>
                    <td>{{ $oldOil ?? '---' }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    @if($nameSparePart[0])
        <div class="section-title">{{ __('templatePDF.spareParts') }}</div>
        <table>
            <thead>
                <tr>
                    <th>{{ __('templatePDF.nameSparePart') }}</th>
                    <th>{{ __('templatePDF.quantitySparePart') }}</th>
                    <th>{{ __('templatePDF.noteSparePart') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $countSparePart = max(count($nameSparePart), 1);
                @endphp
                @for($i = 0; $i < $countSparePart; $i++)
                <tr>
                    <td>{{ $nameSparePart[$i] ?? '---' }}</td>
                    <td>{{ $quantitySparePart[$i] ?? '---' }}</td>
                    <td>{{ $noteSparePart[$i] ?? '---' }}</td>
                </tr>
                @endfor
            </tbody>
        </table>
    @endif

    <table style="width: 100%; margin-top: 40px;">
        <tr>
            <td style="width: 50%; text-align: center;">
                <p><strong>{{ __('templatePDF.mainTech') }}</strong></p>

                @if (!empty($signTechPath))
                    <img src="{{ public_path($signTechPath) }}" style="width: 200px; height: auto; border: 1px solid #000; padding: 4px;">
                @else
                    <div style="width: 200px; height: 60px; border-bottom: 1px solid #000; margin: 0 auto;"></div>
                @endif

                <p style="margin-top: 5px;">{{ $mainTech ?? '---' }}</p>
            </td>

            <td style="width: 50%; text-align: center;">
                <p><strong>{{ __('templatePDF.customer') }}</strong></p>

                @if (!empty($signCustomer))
                    <img src="{{ $signCustomer }}" style="width: 200px; height: auto; border: 1px solid #000; padding: 4px;">
                @else
                    <div style="width: 200px; height: 60px; border-bottom: 1px solid #000; margin: 0 auto;"></div>
                @endif

                <p style="margin-top: 5px;">{{ $nameCustomerSign ?? '---' }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
