const tdList = [...document.querySelectorAll('#tasks td')];
let used = new Set();
let currentIndex = null;
let currentTd = null;

// Завантажити нове завдання
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

    const answerInput = document.getElementById("answer");
    answerInput.value = "";
    answerInput.focus();
}

// Перевірка відповіді
document.getElementById("check").addEventListener("click", () => {
    if (currentTd === null) return;

    const a = parseInt(document.getElementById("a").value);
    const b = parseInt(document.getElementById("b").value);
    const userAnswer = parseInt(document.getElementById("answer").value);
    const correctAnswer = a * b;

    currentTd.classList.remove("correct", "wrong");

    if (userAnswer === correctAnswer) {
        currentTd.classList.add("correct");
    } else {
        currentTd.classList.add("wrong");
    }

    used.add(currentIndex);

    setTimeout(loadNewTask, 400);
});

// Enter = перевірити
document.getElementById("answer").addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        document.getElementById("check").click();
    }
});

// Старт
loadNewTask();
