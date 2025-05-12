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
    const ctx = canvas.getContext("2d");

    let drawing = false;

    function getPosition(event) {
        const rect = canvas.getBoundingClientRect();
        let x, y;
    
        if (event.touches && event.touches.length > 0) {
            x = event.touches[0].pageX - rect.left - window.scrollX;
            y = event.touches[0].pageY - rect.top - window.scrollY;
        } else {
            x = event.pageX - rect.left - window.scrollX;
            y = event.pageY - rect.top - window.scrollY;
        }
    
        return { x, y };
    }

    function startDraw(e) {
        drawing = true;
        const pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function draw(e) {
        if (!drawing) return;
        e.preventDefault(); // stop scroll on touch devices
        const pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDraw() {
        drawing = false;
    }

    // Mouse events
    canvas.addEventListener("mousedown", startDraw);
    canvas.addEventListener("mousemove", draw);
    canvas.addEventListener("mouseup", stopDraw);
    canvas.addEventListener("mouseleave", stopDraw);

    // Touch events
    canvas.addEventListener("touchstart", startDraw, { passive: true });
    canvas.addEventListener("touchmove", draw, { passive: false });
    canvas.addEventListener("touchend", stopDraw);
    canvas.addEventListener("touchcancel", stopDraw);

    // Show signature UI
    toggleBtn.addEventListener("click", function (e) {
        e.preventDefault();
        canvas.classList.remove("d-none");
        clearBtn.classList.remove("d-none");
        saveBtn.classList.remove("d-none");
    });

    clearBtn.addEventListener("click", function (e) {
        e.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    return ctx;
}

const ctxTech = initSignatureCanvas('canvasTech', 'clearCanvasTech', 'saveCanvasTech', 'createCanvasTech');
const ctxCust = initSignatureCanvas('canvasCustomer', 'clearCanvasCustomer', 'saveCanvasCustomer', 'createCanvasCust');