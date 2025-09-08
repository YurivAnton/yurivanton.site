<script>
    const customers = @json($customers);
</script>

<fieldset class="mb-4">
    <legend>{{ __('report.orderer') }}</legend>
    @error('customerId')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <select id="customerId" name="customerId" class="form-select">
            <option value="">{{ __('report.selectCustomer') }}</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customerId') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}  
                </option>
            @endforeach
        </select>
        <input type="hidden" id="customerName" name="customerName" value="{{ old('customerName') }}">
        <input type="hidden" id="customerEmail" name="customerEmail" value="{{ old('customerEmail') }}">
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
        <input id="customerAddress" class="form-control" name="customerAddress" type="text" value="{{ old('customerAddress') }}" readonly>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
        <input id="customerCity" class="form-control" name="customerCity" type="text" value="{{ old('customerCity') }}" readonly>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.user') }}</legend>
    @error('officeName')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="mb-3">
        <select id="officeId" name="officeId" class="form-select">
            @foreach($customers as $customer)
                @if( old('customerId') == $customer->id )
                    @foreach($customer->offices as $office)
                        <option value="{{ $office->id }}"  {{ old('officeId') == $office->id ? 'selected' : '' }}>
                            {{ $office->name }}
                        </option>
                    @endforeach
                @endif
            @endforeach
        </select>
        <input type="hidden" id="officeName" name="officeName" value="{{ old('officeName') }}">
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeAddress" class="form-control" name="officeAddress" type="text" value="{{ old('officeAddress') }}" readonly>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeCity" class="form-control" name="officeCity" type="text" value="{{ old('officeCity') }}" readonly>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.transport') }}</legend>
        @php
            $oldKms = old('transportKm', '');
            $oldTimes = old('transportTime', '');
        @endphp

        <div id="dateTransport" class="row g-2 mb-2">
            <div class="col-6 col-md-4">
                <input type="number" name="transportKm" class="form-control"
                    placeholder="{{ __('report.transportKm') }}" value="{{ old('transportKm') }}">
                @error("transportKm")
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6 col-md-4">
                <input type="number" name="transportTime" class="form-control"
                    placeholder="{{ __('report.transportTime') }}" value="{{ old('transportTime') }}">
                @error("transportTime")
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.technik') }}</legend>
    <div id="technikId" class="technik-block mb-3">
        @php
            $oldTechnik = old('technikName', []);
            $oldDates = old('date', []);
            $oldStart = old('startTime', []);
            $oldFinish = old('finishTime', []);
            $count = max(count($oldTechnik), 1);
        @endphp

        @for ($i = 0; $i < $count; $i++)
            {{-- row: Technician + Date --}}
            <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <label class="form-label d-md-none">{{ __('report.technikName') }}</label>
                    <select id="selectTechnik0" name="technikId[]" class="form-select technik-select" data-index="0">
                        <option value="">{{ __('report.chooseTechnician') }}</option>
                        @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}"
                                {{ old("technikId.$i") == $worker->id ? 'selected' : '' }}>
                                {{ $worker->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" id="technikName0" name="technikName[]" value="{{ old("technikName.0") }}">
                    @error("technikName.$i")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label d-md-none">{{ __('report.date') }}</label>
                    <input type="date" name="date[]" class="form-control" value="{{ $oldDates[$i] ?? '' }}">
                    @error("date.$i")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Row: Time From / To --}}
            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <label class="form-label d-md-none">{{ __('report.startTime') }}</label>
                    <input name="startTime[]" type="time" class="form-control" value="{{ $oldStart[$i] ?? '' }}">
                    @error("startTime.$i")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label d-md-none">{{ __('report.finishTime') }}</label>
                    <input name="finishTime[]" type="time" class="form-control" value="{{ $oldFinish[$i] ?? '' }}">
                    @error("finishTime.$i")
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
            
            <button type="button" class="btn btn-danger remove-technician mt-2 d-none">🗑️ {{ __('report.removeTechnician') }}</button>
        </div>
        @endfor
    </div>
    <button id="addTechnik" type="button" class="btn btn-outline-primary btn-sm">{{ __('report.addTechnik') }}</button>   
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.description') }}</legend>
    @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea name="description" class="form-control" rows="3" placeholder="{{ __('report.descriptionOfWork') }}">{{ old('description') }}</textarea>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.resultRecommendations') }}</legend>
    @error('descriptionResult')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <textarea name="descriptionResult" class="form-control" rows="5" placeholder="{{ __('report.resultRecommendations') }}">{{ old('descriptionResult') }}</textarea>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.deviceIdentification') }}</legend>
    <div class="row g-2">
        <div class="col-md-6">
            <input name="typeDevice" type="text" class="form-control" placeholder="{{ __('report.type') }}">
        </div>
        <div class="col-md-6">
            <input name="snDevice" type="text" class="form-control" placeholder="{{ __('report.serialNumber') }}">
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.coolant') }}</legend>
    <div class="row g-2">
        <div class="col-md-4">
            <select name="coolant" class="form-select">
                <option value="">{{ __('report.chooseCoolant') }}</option>
                <option>R410A</option>
                <option>R407C</option>
                <option>R32</option>
                <option>R134A</option>
            </select>
        </div>
        <div class="col-md-4">
            <input name="newCoolant" type="number" class="form-control" placeholder="{{ __('report.newCoolant') }}">
        </div>
        <div class="col-md-4">
            <input name="oldCoolant" type="number" class="form-control" placeholder="{{ __('report.oldCoolant') }}">
        </div>
    </div>
</fieldset class="mb-4">

<fieldset class="mb-4">
    <legend>{{ __('report.oil') }}</legend>
    <div class="row g-2">
        <div class="col-md-4">
            <input name="oil" class="form-control" placeholder="{{ __('report.oilType') }}">
        </div>
        <div class="col-md-4">
            <input name="newOil" type="number" class="form-control" placeholder="{{ __('report.newOil') }}">
        </div>
        <div class="col-md-4">
            <input name="oldOil" type="number" class="form-control" placeholder="{{ __('report.oldOil') }}">
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.spareParts') }}</legend>
    @php
        $sparePartNames = old('nameSparePart', [null]);
    @endphp

    @foreach($sparePartNames as $i => $name)
    <div id="spareParts" class="row g-2 mb-2 align-items-center">
        <div class="col-md-4">
            <input name="nameSparePart[]" type="text" class="form-control"
                placeholder="{{ __('report.nameSparePart') }}">
        </div>
        <div class="col-md-3">
            <input name="quantitySparePart[]" type="number" class="form-control"
                placeholder="{{ __('report.quantitySparePart') }}">
        </div>
        <div class="col-md-4">
            <input name="noteSparePart[]" type="text" class="form-control"
                placeholder="{{ __('report.noteSparePart') }}">
        </div>
        <div class="col-md-1 d-flex justify-content-end">
            <!-- Тут кнопка з'явиться тільки у нових -->
        </div>
    </div>
    @endforeach

    <button id="addSpareParts" type="button" class="btn btn-outline-primary btn-sm mt-2">{{ __('report.addSpareParts') }}</button>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.mainTech') }}</legend>
    @error('mainTech')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <select id="mainTech" name="mainTech" class="form-select mb-2">
        <option value="">{{ __('report.chooseTechnician') }}</option>
        @foreach($workers as $worker)
            <option>{{ $worker->name }}</option>
        @endforeach
    </select>
    <div id="techSignPreview" class="mt-2"></div>
    <input type="hidden" name="signTechPath" id="signTechPath">
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.customerSign') }}</legend>
    @error('nameCustomerSign')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <input id="customerSign" name="nameCustomerSign" type="text" class="form-control mb-2" placeholder="{{ __('report.nameCustomerSign') }}">
    <button id="createCanvasCust" type="button" class="btn btn-outline-secondary btn-sm">{{ __('report.signature') }}</button>
    <div id="signCustomerNOpen" class="alert alert-danger d-none">{{ __('report.errors.signCustomerNOpen') }}</div>
    <div id="signCustomerNFill" class="alert alert-danger d-none">{{ __('report.errors.signCustomerNFill') }}</div>
    <canvas id="canvasCustomer" width="600" height="600" class="border rounded d-block mt-2 w-100 d-none"></canvas>
    <input type="hidden" name="signCustomer" id="signCustomer">
    <div class="mt-2">
        <button id="clearCanvasCustomer" class="btn btn-warning btn-sm d-none">{{ __('report.clear') }}</button>
        <button id="saveCanvasCustomer" class="btn btn-success btn-sm d-none">{{ __('report.save') }}</button>
    </div>
</fieldset>

<div id="emailContainer" class="mt-3 d-none">
    <label for="sendEmail" class="form-label">{{ __('report.sendEmail') }}</label>
    <input type="email" name="sendEmail" id="sendEmail" class="form-control" placeholder="example@domain.com">
    <div id="emailEmpty" class="text-danger mt-1 d-none">{{ __('report.errors.emailEmpty') }}</div>
    <div id="emailInvalid" class="text-danger mt-1 d-none">{{ __('report.errors.emailInvalid') }}</div>
</div>

<fieldset>
    <button id="show" type="submit" value="show" class="btn btn-outline-info">{{ __('report.show') }}</button>
    <button id="saveSent" type="submit" value="saveSent" class="btn btn-success">{{ __('report.saveSent') }}</button>
    <button id="save" type="submit" value="save" class="btn btn-secondary">{{ __('report.save') }}</button>
</fieldset>