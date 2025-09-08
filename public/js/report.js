"use strict";

const customerId = document.getElementById('customerId');
const officeId = document.getElementById('officeId');
const customerName = document.getElementById('customerName');
const officeName = document.getElementById('officeName');

customerId.addEventListener('change', function () {
    const customerAddress = document.getElementById('customerAddress');
    const customerCity = document.getElementById('customerCity');
    const officeAddress = document.getElementById('officeAddress');
    const officeCity = document.getElementById('officeCity');

    customers.forEach(customer => {
        if (this.value == customer.id) {
            customerName.value = customer.name;
            customerAddress.value = customer.address;
            customerCity.value = customer.city;

            officeId.innerHTML = '';
            customer.offices.forEach((office, index) => {
                
                let option = document.createElement('option');
                option.value = office.id;
                option.innerText = office.name;
                officeId.append(option);

                if (index === 0) {
                    officeName.value = office.name;
                    officeAddress.value = office.address;
                    officeCity.value = office.city;
                }
            });
        }
    });
});

officeId.addEventListener('change', function () {
    const officeAddress = document.getElementById('officeAddress');
    const officeCity = document.getElementById('officeCity');

    for (let customer of customers) {
        for (let office of customer.offices) {
            if (this.value == office.id) {
                officeName.value = office.name;
                officeAddress.value = office.address;
                officeCity.value = office.city;
            }
        }
    }
});

const addTechnik = document.getElementById('addTechnik');
let technikIndex = document.querySelectorAll('.technik-block').length - 1;
const selectTichnik = document.getElementById('selectTechnik');

function attachSelectListener(select) {
    select.addEventListener('change', function () {
        const index = this.dataset.index;
        const selectedName = this.options[this.selectedIndex].text;
        const hiddenInput = document.getElementById('technikName' + index);
        if (hiddenInput) {
            hiddenInput.value = selectedName;
        }
    });

    // We trigger manually for the first element if a value has already been selected
    const selectedName = select.options[select.selectedIndex].text;
    const hiddenInput = document.getElementById('technikName' + select.dataset.index);
    if (hiddenInput && select.value !== '') {
        hiddenInput.value = selectedName;
    }
}

// Add a handler to the first select
attachSelectListener(document.getElementById('selectTechnik0'));

addTechnik.addEventListener('click', function (event) {
    event.preventDefault();
    const clone = document.getElementById('technikId').cloneNode(true);
    technikIndex++;

    for(let elem of clone.querySelectorAll('input, select')){
        elem.value = '';

        if(elem.id.includes('selectTechnik')){
            elem.id = 'selectTechnik' + technikIndex;
            elem.setAttribute('data-index', technikIndex);
        }

        if(elem.id.includes('technikName')){
            elem.id = 'technikName' + technikIndex;
        }
    };
    // Show the delete button
    clone.querySelector('.remove-technician').classList.remove('d-none');

    // Insert the new element before the button
    this.insertAdjacentElement('beforebegin', clone);

    // Add an event listener to the new select
    const newSelect = clone.querySelector('[id^="selectTechnik"]');
    attachSelectListener(newSelect);

    // Add an event listener to the delete button
    clone.querySelector('.remove-technician').addEventListener('click', function () {
        clone.remove();
    });
});

const addSpareParts = document.getElementById('addSpareParts');

addSpareParts.addEventListener('click', function (event) {
    event.preventDefault();

    const original = document.getElementById('spareParts');
    const clone = original.cloneNode(true);

    // Очищаємо поля
    clone.querySelectorAll('input').forEach(input => input.value = '');

    // Створюємо кнопку видалення
    const deleteBtn = document.createElement('button');
    deleteBtn.type = 'button';
    deleteBtn.className = 'btn btn-danger btn-sm';
    deleteBtn.textContent = '×';
    deleteBtn.addEventListener('click', function () {
        clone.remove();
    });

    // Знаходимо останню колонку і додаємо кнопку
    const lastCol = clone.querySelector('.col-md-1');
    lastCol.innerHTML = ''; // очищуємо (на випадок дублювання)
    lastCol.appendChild(deleteBtn);

    // Додаємо перед кнопкою "Додати"
    addSpareParts.insertAdjacentElement('beforeBegin', clone);
});

function initSignatureCanvas(canvasId, clearBtnId, saveBtnId, toggleBtnId) {
    const canvas = document.getElementById(canvasId);
    const clearBtn = document.getElementById(clearBtnId);
    const saveBtn = document.getElementById(saveBtnId);
    const toggleBtn = document.getElementById(toggleBtnId);
    const ctx = canvas.getContext('2d');
    let drawing = false;

    // Canvas scaling for crisp coordinates
    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;

        canvas.width = width * ratio;
        canvas.height = height * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
    }

    resizeCanvas(); // on initialization

    // Returns correct touch/mouse coordinates
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

    // Events
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
        resizeCanvas(); // Update the size when the canvas is shown
    });

    clearBtn.addEventListener('click', function (event) {
        event.preventDefault();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    });

    return ctx;
}

const ctxCust = initSignatureCanvas('canvasCustomer', 'clearCanvasCustomer', 'saveCanvasCustomer', 'createCanvasCust');
const mainTech = document.getElementById('mainTech');

mainTech.addEventListener('change', function(){
    const selectedName = this[this.selectedIndex].text;
    const fileName = selectedName + '_' + this.selectedIndex + '.png';
    const imgPath = '/storage/signatures/' + fileName;
    const signTechPath = document.getElementById('signTechPath');

    signTechPath.value = imgPath;

    const preview = document.getElementById('techSignPreview');
    preview.innerHTML = ''; // Clear the old

    const img = document.createElement('img');
    img.src = imgPath;
    img.style.maxWidth = '200px';
    img.alt = 'Podpis technika';

    // Let's check if the file exists
    fetch(imgPath, { method: 'HEAD' }).then(response => {
        if (response.ok) {
            preview.appendChild(img);
        } else {
            preview.innerHTML = '<p class="text-muted">Podpis neexistuje</p>';
        }
    });
});

const formReport = document.getElementById('formReport');
const save = document.getElementById('save');

save.addEventListener('click', function(event){
    event.preventDefault();

    const canvasCustomer = document.getElementById('canvasCustomer');
    const errorDiv = document.getElementById('signCustomerError');

    // Check if the canvas was opened
    const canvasWasOpened = !canvasCustomer.classList.contains('d-none');

    // If the user hasn't even opened the signature
    if (!canvasWasOpened) {
        errorDiv.textContent = 'Prosím, podpíšte sa (kliknite na tlačidlo "Podpis").';
        errorDiv.classList.remove('d-none');
        return;
    }

    // If (the user) opened it but didn’t draw
    if (isCanvasBlank(canvasCustomer)) {
        errorDiv.textContent = 'Podpis je prázdny. Prosím, podpíšte sa.';
        errorDiv.classList.remove('d-none');
        return;
    }

    // Successfully — save the image and hide the error
    errorDiv.classList.add('d-none');
    errorDiv.textContent = '';

    const signCustomerData = canvasCustomer.toDataURL("image/png");

    document.getElementById('signCustomer').value = signCustomerData;

    formReport.action = '/saveReport';
    formReport.submit();
});

function isCanvasBlank(canvas) {
    const blank = document.createElement('canvas');
    blank.width = canvas.width;
    blank.height = canvas.height;
    return canvas.toDataURL() === blank.toDataURL();
}

const show = document.getElementById('show');

show.addEventListener('click', function(event){
    event.preventDefault();

    const canvasCustomer = document.getElementById('canvasCustomer');
    const signCustomerData = canvasCustomer.toDataURL("image/png");

    document.getElementById('signCustomer').value = signCustomerData;

    formReport.action = '/generate-pdf';
    formReport.target = '_blank';
    formReport.submit();
});

const saveSent = document.getElementById('saveSent');
const customerEmail = document.getElementById('customerEmail');

saveSent.addEventListener('click', function(event){
    event.preventDefault();

    const canvasCustomer = document.getElementById('canvasCustomer');
    const errorDivNOpen = document.getElementById('signCustomerNOpen');
    const errorDivNFill = document.getElementById('signCustomerNFill');
    const emailField = document.getElementById('sendEmail');
    const emailContainer = document.getElementById('emailContainer');
    const emailEmpty = document.getElementById('emailEmpty');
    const emailInvalid = document.getElementById('emailInvalid');

    const canvasWasOpened = !canvasCustomer.classList.contains('d-none');

    if (!canvasWasOpened) {
        errorDivNOpen.classList.remove('d-none');
        errorDivNFill.classList.add('d-none');
        return;
    }

    if (isCanvasBlank(canvasCustomer)) {
        errorDivNFill.classList.remove('d-none');
        errorDivNOpen.classList.add('d-none');
        return;
    }

    errorDivNOpen.classList.add('d-none');
    errorDivNFill.classList.add('d-none');
    document.getElementById('signCustomer').value = canvasCustomer.toDataURL("image/png");

    if(!customerEmail.value){
        if(!emailField || emailField.value.trim() === ''){
            event.preventDefault();
            emailContainer.classList.remove('d-none');
            emailEmpty.classList.remove('d-none');
            emailInvalid.classList.add('d-none');
            // emailError.textContent = 'Prosím, zadajte e-mail pre odoslanie protokolu.';
            return;
        }

        const email = emailField.value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailRegex.test(email)) {
            event.preventDefault();
            customerEmail.value = 1;
            emailInvalid.classList.remove('d-none');
            emailEmpty.classList.add('d-none');
            // emailError.textContent = 'Neplatný e-mail.';
            return;
        }

        emailEmpty.classList.add('d-none');
        emailInvalid.classList.add('d-none');
    }
    // Установити action на потрібний маршрут
    formReport.action = '/save-send-report';
    formReport.method = 'POST';
    formReport.submit();
});