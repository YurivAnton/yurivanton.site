<script>
    const customers = @json($customers);
</script>

<fieldset class="mb-4">
    <legend>OBJEDNÁVATEĽ</legend>
    <div class="mb-3">
        <select id="customerName" name="customerName" class="form-select">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="customerAddress" class="form-control" name="customerAddress" type="text" value="{{ $customers[0]->address }}" disabled>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="customerCity" class="form-control" name="customerCity" type="text" value="{{ $customers[0]->city }}" disabled>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>UŽÍVATEĽ</legend>
    <div class="mb-3">
        <select id="officeName" name="officeName" class="form-select">
            @foreach($customers[0]->offices as $office)
                <option value="{{ $office->id }}">{{ $office->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeAddress" class="form-control" name="officeAddress" type="text" value="{{ $customers[0]->offices[0]->address }}" disabled>
        </div>
    </div>
    <div class="row g-2 mb-2">
        <div class="col-12">
            <input id="officeCity" class="form-control" name="officeCity" type="text" value="{{ $customers[0]->offices[0]->city }}" disabled>
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>Dátum / Doprava</legend>
    <div>
        <div id="dateTransport" class="row g-2 mb-2">
            <div class="col-12 col-md-4">
                <input id="date" class="form-control" name="date[]" type="date">
            </div>
            <div class="col-6 col-md-4">
                <input id="transportKm" class="form-control" name="transportKm[]" type="number" placeholder="Doprava km" required>
            </div>
            <div class="col-6 col-md-4">
                <input id="transportTime" class="form-control" name="transportTime[]" type="number" placeholder="Doprava Hodiny">
            </div>
        </div>
        <button id="addWorkDay" class="btn btn-outline-primary btn-sm">add work day</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>TECHNIK</legend>
    <div>
        <div id="technik" class="row g-2 mb-2">
            <div class="col-12 col-md-4">
                <select class="form-select">
                    @foreach($workers as $worker)
                        <option>{{ $worker->name }}</option>
                    @endforeach
                </select>
                <!-- <input id="technicianName" class="form-control" name="technicianName[]" type="text" placeholder="Meno TECHNIKA"> -->
            </div>
            <div class="col-6 col-md-4">
                <input id="startTime" class="form-control" name="startTime[]" type="time">
            </div>
            <div class="col-6 col-md-4">
                <input id="finishTime" class="form-control" name="finishTime[]" type="time">
            </div>
        </div>
        <button id="addTechnik" class="btn btn-outline-primary btn-sm">add technik</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>Popis zásahu</legend>
    <textarea name="description" class="form-control" rows="3" placeholder="Popis zásahu"></textarea>
</fieldset>

<fieldset class="mb-4">
    <legend>Výsledok / Odporúčania</legend>
    <textarea name="descriptionResult" class="form-control" rows="5" placeholder="Výsledok / Odporúčania"></textarea>
</fieldset>

<fieldset class="mb-4">
    <legend>Identifikácia zariadenia</legend>
    <div class="row g-2">
        <div class="col-md-6">
            <input name="typDevice" type="text" class="form-control" placeholder="Typ">
        </div>
        <div class="col-md-6">
            <input name="snDevice" type="text" class="form-control" placeholder="Číslo serie">
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>CHLADIVO</legend>
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
            <input name="newCoolant" type="number" class="form-control" placeholder="Doplnené (kg)" value="0">
        </div>
        <div class="col-md-4">
            <input name="oldCoolant" type="number" class="form-control" placeholder="Odobraté (kg)" value="0">
        </div>
    </div>
</fieldset class="mb-4">

<fieldset class="mb-4">
    <legend>OLEJ</legend>
    <div class="row g-2">
        <div class="col-md-4">
            <input name="oil" class="form-control" placeholder="Typ oleja">
        </div>
        <div class="col-md-4">
            <input name="newOil" type="number" class="form-control" placeholder="Doplnené (kg)" value="0">
        </div>
        <div class="col-md-4">
            <input name="oldOil" type="number" class="form-control" placeholder="Odobraté (kg)" value="0">
        </div>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>NÁHRADNÉ DIELY</legend>
    <div id="spareParts" class="row g-2 mb-2">
        <div class="col-md-4">
            <input name="nameSparePart[]" type="text" class="form-control" placeholder="Názov dielu">
        </div>
        <div class="col-md-4">
            <input name="quantitySparePart[]" type="number" class="form-control" placeholder="Množstvo">
        </div>
        <div class="col-md-4">
            <input name="noteSparePart[]" type="text" class="form-control" placeholder="Poznámka">
        </div>
    </div>
    <button id="addSpareParts" type="button" class="btn btn-outline-primary btn-sm mt-2">Pridať dielo</button>
</fieldset>

<fieldset class="mb-4">
    <legend>Podpis technika</legend>
    <select id="mainTech" name="mainTech" class="form-select mb-2">
        @foreach($workers as $worker)
            <option>{{ $worker->name }}</option>
        @endforeach
    </select>
    <button id="createCanvasTech" type="button" class="btn btn-outline-secondary btn-sm">Podpís</button>
    <canvas id="canvasTech" width="600" height="250" class="border rounded d-block mt-2 w-100 d-none"></canvas>
    <div class="mt-2">
        <button id="clearCanvasTech" class="btn btn-warning btn-sm d-none">Vymazať</button>
        <button id="saveCanvasTech" class="btn btn-success btn-sm d-none">Uložiť</button>
    </div>
</fieldset>

<fieldset class="mb-4">
    <legend>Podpis zákazníka</legend>
    <input id="customerSign" name="nameCustomerSign" type="text" class="form-control mb-2" placeholder="Meno zákazníka">
    <button id="createCanvasCust" type="button" class="btn btn-outline-secondary btn-sm">Podpís</button>
    <canvas id="canvasCustomer" width="600" height="250" class="border rounded d-block mt-2 w-100 d-none"></canvas>
    <div class="mt-2">
        <button id="clearCanvasCustomer" class="btn btn-warning btn-sm d-none">Vymazať</button>
        <button id="saveCanvasCustomer" class="btn btn-success btn-sm d-none">Uložiť</button>
    </div>
</fieldset>

<fieldset>
    <button id="show" type="submit" value="show" class="btn btn-outline-info">Zobraziť</button>
    <button id="saveSent" type="submit" value="saveSent" class="btn btn-success">Uložiť a odoslať</button>
    <button id="save" type="submit" value="save" class="btn btn-secondary">Uložiť</button>
</fieldset>