<script>
    const customers = @json($customers);
</script>

<fieldset class="mb-4">
    <legend>{{ __('report.orderer') }}</legend>
    <div class="mb-3">
        <select id="customerName" name="customerName" class="form-select">
            <option></option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
        <input id="customerAddress" class="form-control" name="customerAddress" type="text" value="" disabled>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
        <input id="customerCity" class="form-control" name="customerCity" type="text" value="" disabled>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.user') }}</legend>
    <div class="mb-3">
        <select id="officeName" name="officeName" class="form-select">
        <option></option>
        </select>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeAddress" class="form-control" name="officeAddress" type="text" value="" disabled>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeCity" class="form-control" name="officeCity" type="text" value="" disabled>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.dateTransport') }}</legend>
    <div>
        <div id="dateTransport" class="row g-2 mb-2">
            <div class="col-12 col-md-4">
                <input id="date" class="form-control" name="date[]" type="date">
            </div>
            <div class="col-6 col-md-4">
                <input id="transportKm" class="form-control" name="transportKm[]" type="number" placeholder="{{ __('report.transportKm') }}" required>
            </div>
            <div class="col-6 col-md-4">
                <input id="transportTime" class="form-control" name="transportTime[]" type="number" placeholder="{{ __('report.transportTime') }}">
            </div>
        </div>
        <button id="addWorkDay" class="btn btn-outline-primary btn-sm">{{ __('report.addWorkDay') }}</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.technik') }}</legend>
    <div>
        <div id="technik" class="row g-2 mb-2">
            <div class="col-12 col-md-4">
                <select name="technikName[]" class="form-select">
                    @foreach($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 col-md-4">
                <input id="startTime" class="form-control" name="startTime[]" type="time">
            </div>
            <div class="col-6 col-md-4">
                <input id="finishTime" class="form-control" name="finishTime[]" type="time">
            </div>
        </div>
        <button id="addTechnik" class="btn btn-outline-primary btn-sm">{{ __('report.addTechnik') }}</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.description') }}</legend>
    <textarea name="description" class="form-control" rows="3" placeholder="{{ __('report.descriptionOfWork') }}"></textarea>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.resultRecommendations') }}</legend>
    <textarea name="descriptionResult" class="form-control" rows="5" placeholder="{{ __('report.resultRecommendations') }}"></textarea>
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
    <div id="spareParts" class="row g-2 mb-2">
        <div class="col-md-4">
            <input name="nameSparePart[]" type="text" class="form-control" placeholder="{{ __('report.nameSparePart') }}">
        </div>
        <div class="col-md-4">
            <input name="quantitySparePart[]" type="number" class="form-control" placeholder="{{ __('report.quantitySparePart') }}">
        </div>
        <div class="col-md-4">
            <input name="noteSparePart[]" type="text" class="form-control" placeholder="{{ __('report.noteSparePart') }}">
        </div>
    </div>
    <button id="addSpareParts" type="button" class="btn btn-outline-primary btn-sm mt-2">{{ __('report.addSpareParts') }}</button>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.mainTech') }}</legend>
    <select id="mainTech" name="mainTech" class="form-select mb-2">
        @foreach($workers as $worker)
            <option>{{ $worker->name }}</option>
        @endforeach
    </select>
    <button id="createCanvasTech" type="button" class="btn btn-outline-secondary btn-sm">{{ __('report.signature') }}</button>
    <canvas id="canvasTech" width="600" height="600" class="border rounded d-block mt-2 w-100 d-none"></canvas>
    <input type="hidden" name="signTech" id="signTech">
    <div class="mt-2">
        <button id="clearCanvasTech" class="btn btn-warning btn-sm d-none">{{ __('report.clear') }}</button>
        <button id="saveCanvasTech" class="btn btn-success btn-sm d-none">{{ __('report.save') }}</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>{{ __('report.customerSign') }}</legend>
    <input id="customerSign" name="nameCustomerSign" type="text" class="form-control mb-2" placeholder="{{ __('report.nameCustomerSign') }}">
    <button id="createCanvasCust" type="button" class="btn btn-outline-secondary btn-sm">{{ __('report.signature') }}</button>
    <canvas id="canvasCustomer" width="600" height="600" class="border rounded d-block mt-2 w-100 d-none"></canvas>
    <input type="hidden" name="signCustomer" id="signCustomer">
    <div class="mt-2">
        <button id="clearCanvasCustomer" class="btn btn-warning btn-sm d-none">{{ __('report.clear') }}</button>
        <button id="saveCanvasCustomer" class="btn btn-success btn-sm d-none">{{ __('report.save') }}</button>
    </div>
</fieldset>

<fieldset>
    <button id="show" type="submit" value="show" class="btn btn-outline-info">{{ __('report.show') }}</button>
    <button id="saveSent" type="submit" value="saveSent" class="btn btn-success">{{ __('report.saveSent') }}</button>
    <button id="save" type="submit" value="save" class="btn btn-secondary">{{ __('report.save') }}</button>
</fieldset>