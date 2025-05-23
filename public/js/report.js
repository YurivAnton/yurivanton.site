"use strict";

const customerNames = document.getElementById('customerName');
const officeName = document.getElementById('officeName');

customerNames.addEventListener('change', function () {
    const customerAddress = document.getElementById('customerAddress');
    const customerCity = document.getElementById('customerCity');
    const officeAddress = document.getElementById('officeAddress');
    const officeCity = document.getElementById('officeCity');

    customers.forEach(customer => {
        if (this.value == customer.id) {
            customerAddress.value = customer.address;
            customerCity.value = customer.city;

            officeName.innerHTML = '';
            customer.offices.forEach((office, index) => {
                let option = document.createElement('option');
                option.value = office.id;
                option.innerText = office.name;
                officeName.append(option);

                if (index === 0) {
                    officeAddress.value = office.address;
                    officeCity.value = office.city;
                }
            });
        }
    });
});

officeName.addEventListener('change', function () {
    const officeAddress = document.getElementById('officeAddress');
    const officeCity = document.getElementById('officeCity');

    for (let customer of customers) {
        for (let office of customer.offices) {
            if (this.value == office.id) {
                officeAddress.value = office.address;
                officeCity.value = office.city;
            }
        }
    }
});

const addWorkDay = document.getElementById('addWorkDay');
addWorkDay.addEventListener('click', function (event) {
    event.preventDefault();
    const clone = document.getElementById('dateTransport').cloneNode(true);
    clone.querySelectorAll('input').forEach(input => input.value = '');
    addWorkDay.insertAdjacentElement('beforeBegin', clone);
});

const addTechnik = document.getElementById('addTechnik');
addTechnik.addEventListener('click', function (event) {
    event.preventDefault();
    const clone = document.getElementById('technik').cloneNode(true);
    clone.querySelectorAll('input').forEach(input => input.value = '');
    addTechnik.insertAdjacentElement('beforeBegin', clone);
});

const addSpareParts = document.getElementById('addSpareParts');
addSpareParts.addEventListener('click', function (event) {
    event.preventDefault();
    const clone = document.getElementById('spareParts').cloneNode(true);
    clone.querySelectorAll('input').forEach(input => input.value = '');
    addSpareParts.insertAdjacentElement('beforeBegin', clone);
});

function initSignatureCanvas(canvasId, clearBtnId, saveBtnId, toggleBtnId) {
    const canvas = document.getElementById(canvasId);
    const clearBtn = document.getElementById(clearBtnId);
    const saveBtn = document.getElementById(saveBtnId);
    const toggleBtn = document.getElementById(toggleBtnId);
    const ctx = canvas.getContext('2d');
    let drawing = false;

    // Масштабування canvas для чітких координат
    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;

        canvas.width = width * ratio;
        canvas.height = height * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
    }

    resizeCanvas(); // при ініціалізації

    // Повертає правильні координати дотику/миші
    function getPosition(event) {
        const rect = canvas.getBoundingClientRect();

        let x, y;
        if (event.touches && event.touches.length > 0) {
            x = event.touches[0].clientX - rect.left;
            y = event.touches[0].clientY - rect.top;
        } else {
            x = event.clientX - rect.left;
            y = event.clientY - rect.top;
        }

        return { x, y };
    }

    function startDrawing(event) {
        event.preventDefault();
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

    // Події
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseleave', stopDrawing);
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    toggleBtn.addEventListener('click', function (event) {
        event.preventDefault();
        canvas.classList.remove('d-none');
        clearBtn.classList.remove('d-none');
        saveBtn.classList.remove('d-none');
        resizeCanvas(); // оновити розмір, коли показали canvas
    });

    clearBtn.addEventListener('click', function (event) {
        event.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    return ctx;
}

const ctxTech = initSignatureCanvas('canvasTech', 'clearCanvasTech', 'saveCanvasTech', 'createCanvasTech');
const ctxCust = initSignatureCanvas('canvasCustomer', 'clearCanvasCustomer', 'saveCanvasCustomer', 'createCanvasCust');

const formReport = document.getElementById('formReport');
const save = document.getElementById('save');

save.addEventListener('click', function(event){
    const formData = new FormData(formReport);
    formData.set('signTech', canvasTech.toDataURL("image/png"));
    formData.set('signCustomer', canvasCustomer.toDataURL("image/png"));

    document.getElementById('signTech').value = canvasTech.toDataURL("image/png");
    document.getElementById('signCustomer').value = canvasCustomer.toDataURL("image/png");

    formReport.action = '/saveReport';
    formReport.submit();
});