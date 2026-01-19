const tdList = [...document.querySelectorAll('#tasks td')];
let used = new Set();
let currentIndex = null;
let currentTd = null;

const message = document.getElementById("message");
const messageText = message.querySelector(".message-text");
const okButton = message.querySelector(".message-ok");
const answerInput = document.getElementById("answer");
const checkButton = document.getElementById("check");

// --------------------
// Завантажити завдання
// --------------------
function loadNewTask() {
    if (used.size === tdList.length) {
        alert("Усі завдання виконано!");
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

// --------------------
// Перевірка відповіді
// --------------------
function checkAnswer() {
    if (!currentTd) return;

    const a = parseInt(document.getElementById("a").value);
    const b = parseInt(document.getElementById("b").value);
    const userAnswer = parseInt(answerInput.value);
    const correctAnswer = a * b;

    currentTd.classList.remove("correct", "wrong");

    // Правильно
    if (userAnswer === correctAnswer) {
        currentTd.classList.add("correct");
        message.style.display = "none";

        used.add(currentIndex);
        setTimeout(loadNewTask, 400);
        return;
    }

    // Неправильно
    currentTd.classList.add("wrong");
    messageText.innerText = `${a} × ${b} = ${correctAnswer}`;
    message.style.display = "block";
}

// --------------------
// Кнопка "Перевірити"
// --------------------
checkButton.addEventListener("click", checkAnswer);

// --------------------
// Enter в інпуті
// --------------------
answerInput.addEventListener("keydown", (e) => {
    if (e.key !== "Enter") return;

    e.preventDefault();

    // якщо повідомлення показане — Enter = OK
    if (message.style.display === "block") {
        checkAnswer();
        return;
    }

    // інакше — звичайна перевірка
    checkAnswer();
});

// Старт
loadNewTask();