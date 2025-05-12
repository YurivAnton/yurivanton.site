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

    function getPosition(event, canvas) {
        const rect = canvas.getBoundingClientRect();
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (event.touches && event.touches[0]) {
            return {
                x: event.touches[0].clientX - rect.left + scrollLeft,
                y: event.touches[0].clientY - rect.top + scrollTop
            };
        } else {
            return {
                x: event.clientX - rect.left + scrollLeft,
                y: event.clientY - rect.top + scrollTop
            };
        }
    }

    function startDrawing(event) {
        drawing = true;
        const pos = getPosition(event, canvas);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function draw(event) {
        if (!drawing) return;
        event.preventDefault();
        const pos = getPosition(event, canvas);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDrawing() {
        drawing = false;
    }

    // Event listeners for drawing
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseleave', stopDrawing);
    canvas.addEventListener('touchstart', startDrawing);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    // Show signature UI
    toggleBtn.addEventListener('click', function (event) {
        event.preventDefault();
        canvas.classList.remove('d-none');
        clearBtn.classList.remove('d-none');
        saveBtn.classList.remove('d-none');
    });

    // Clear signature
    clearBtn.addEventListener('click', function (event) {
        event.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    return ctx;
}

const ctxTech = initSignatureCanvas('canvasTech', 'clearCanvasTech', 'saveCanvasTech', 'createCanvasTech');
const ctxCust = initSignatureCanvas('canvasCustomer', 'clearCanvasCustomer', 'saveCanvasCustomer', 'createCanvasCust');
