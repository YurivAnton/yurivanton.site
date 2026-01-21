// ===== ЕЛЕМЕНТИ =====
const tdList = [...document.querySelectorAll("#tasks td")];
const answerInput = document.getElementById("answer");
const checkButton = document.getElementById("check");

const message = document.getElementById("message");
const messageText = message.querySelector(".message-text");

// ===== СТАН =====
let used = new Set();
let currentIndex = null;
let currentTd = null;

let startTime = null;
let messageType = null;       // "error" | "finish"
let mistakes = 0;
let isFixingError = false;    // режим виправлення помилки

// ===== ТІЛЬКИ ЦИФРИ =====
answerInput.addEventListener("input", () => {
    answerInput.value = answerInput.value.replace(/\D/g, "");
});

// ===== ЗАВАНТАЖИТИ НОВЕ ЗАВДАННЯ =====
function loadNewTask() {
    if (used.size === tdList.length) {
        const endTime = Date.now();
        const diff = Math.floor((endTime - startTime) / 1000);

        const min = String(Math.floor(diff / 60)).padStart(2, "0");
        const sec = String(diff % 60).padStart(2, "0");

        messageType = "finish";
        messageText.innerText =
            `Ти впоралась за ${min}:${sec}!\n` +
            `Помилок: ${mistakes}`;

        message.style.display = "block";
        return;
    }

    let index;
    do {
        index = Math.floor(Math.random() * tdList.length);
    } while (used.has(index));

    currentIndex = index;
    currentTd = tdList[index];

    const [a, b] = currentTd.innerText.split("*");

    document.getElementById("a").value = a;
    document.getElementById("b").value = b;

    answerInput.value = "";
    answerInput.focus();
}

// ===== ПЕРЕВІРКА =====
function checkAnswer() {
    if (startTime === null) {
        startTime = Date.now();
    }

    if (!currentTd) return;

    const a = +document.getElementById("a").value;
    const b = +document.getElementById("b").value;
    const userAnswer = +answerInput.value;
    const correct = a * b;

    currentTd.classList.remove("correct", "wrong");

    // ПОМИЛКА (ТІЛЬКИ ПЕРШИЙ РАЗ)
    if (userAnswer !== correct) {

        if (!isFixingError) {
            mistakes++;
            isFixingError = true;
        }

        currentTd.classList.add("wrong");

        messageType = "error";
        messageText.innerText = `${a} × ${b} = ${correct}`;
        message.style.display = "block";

        answerInput.value = "";
        answerInput.focus();
        return;
    }

    // ПРАВИЛЬНО
    currentTd.classList.add("correct");
    used.add(currentIndex);

    message.style.display = "none";
    messageType = null;

    isFixingError = false;

    setTimeout(loadNewTask, 300);
}

// ===== КНОПКА =====
checkButton.addEventListener("click", checkAnswer);

// ===== ENTER (ТІЛЬКИ В ІНПУТІ) =====
answerInput.addEventListener("keydown", (e) => {
    if (e.key !== "Enter") return;

    e.preventDefault();

    if (message.style.display === "block" && messageType === "finish") {
        resetGame();
        return;
    }

    checkAnswer();
});

// ===== СКИДАННЯ ГРИ =====
function resetGame() {
    used.clear();
    mistakes = 0;
    startTime = null;
    currentTd = null;
    currentIndex = null;
    isFixingError = false;

    tdList.forEach(td => {
        td.classList.remove("correct", "wrong");
    });

    message.style.display = "none";
    messageType = null;

    loadNewTask();
}

// ===== СТАРТ =====
loadNewTask();
