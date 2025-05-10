"use strict";

// ====== Клієнт та офіси ======
const customerNames = document.getElementById('customerName');
const officeName = document.getElementById('officeName');
const customerAddress = document.getElementById('customerAddress');
const customerCity = document.getElementById('customerCity');
const officeAddress = document.getElementById('officeAddress');
const officeCity = document.getElementById('officeCity');

customerNames.addEventListener('change', function () {
    const selectedCustomer = customers.find(c => c.id == this.value);
    if (!selectedCustomer) return;

    customerAddress.value = selectedCustomer.address;
    customerCity.value = selectedCustomer.city;

    officeName.innerHTML = '';
    selectedCustomer.offices.forEach(office => {
        const option = document.createElement('option');
        option.value = office.id;
        option.innerText = office.name;
        officeName.append(option);
    });

    const firstOffice = selectedCustomer.offices[0];
    if (firstOffice) {
        officeAddress.value = firstOffice.address;
        officeCity.value = firstOffice.city;
    }
});

officeName.addEventListener('change', function () {
    const selectedOffice = customers
        .flatMap(c => c.offices)
        .find(o => o.id == this.value);

    if (selectedOffice) {
        officeAddress.value = selectedOffice.address;
        officeCity.value = selectedOffice.city;
    }
});

// ====== Клонування блоків ======
function cloneAndInsert(beforeEl, targetId) {
    const original = document.getElementById(targetId);
    const clone = original.cloneNode(true);

    // Очистити введення
    clone.querySelectorAll('input, select, textarea').forEach(el => el.value = '');
    beforeEl.insertAdjacentElement('beforeBegin', clone);

    // Прокрутити до нового елемента
    clone.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

document.getElementById('addWorkDay').addEventListener('click', e => {
    e.preventDefault();
    cloneAndInsert(e.target, 'dateTransport');
});

document.getElementById('addTechnik').addEventListener('click', e => {
    e.preventDefault();
    cloneAndInsert(e.target, 'technik');
});

document.getElementById('addSpareParts').addEventListener('click', e => {
    e.preventDefault();
    cloneAndInsert(e.target, 'spareParts');
});

// ====== Підписи (Canvas) ======
function initSignatureCanvas(canvasId, clearBtnId, saveBtnId, toggleBtnId) {
    const canvas = document.getElementById(canvasId);
    const clearBtn = document.getElementById(clearBtnId);
    const saveBtn = document.getElementById(saveBtnId);
    const toggleBtn = document.getElementById(toggleBtnId);
    const ctx = canvas.getContext('2d');
    let drawing = false;

    function getPosition(event) {
        const rect = canvas.getBoundingClientRect();
        const point = event.touches ? event.touches[0] : event;
        return {
            x: point.clientX - rect.left,
            y: point.clientY - rect.top
        };
    }

    function startDrawing(event) {
        drawing = true;
        const pos = getPosition(event);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function draw(event) {
        if (!drawing) return;
        event.preventDefault();
        const pos = getPosition(event);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
    }

    // Події малювання
    ['mousedown', 'mousemove', 'mouseup', 'mouseleave'].forEach(evt => {
        canvas.addEventListener(evt, event => {
            if (evt === 'mousedown') startDrawing(event);
            else if (evt === 'mousemove') draw(event);
            else stopDrawing();
        });
    });

    ['touchstart', 'touchmove', 'touchend', 'touchcancel'].forEach(evt => {
        canvas.addEventListener(evt, event => {
            if (evt === 'touchstart') startDrawing(event);
            else if (evt === 'touchmove') draw(event);
            else stopDrawing();
        }, { passive: false });
    });

    // Показати елементи
    toggleBtn.addEventListener('click', function (event) {
        event.preventDefault();
        [canvas, clearBtn, saveBtn].forEach(el => el.classList.remove('d-none'));
        canvas.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    // Очистити
    clearBtn.addEventListener('click', function (event) {
        event.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    return ctx;
}

// Ініціалізація підписів
const ctxTech = initSignatureCanvas('canvasTech', 'clearCanvasTech', 'saveCanvasTech', 'createCanvasTech');
const ctxCust = initSignatureCanvas('canvasCustomer', 'clearCanvasCustomer', 'saveCanvasCustomer', 'createCanvasCust');
