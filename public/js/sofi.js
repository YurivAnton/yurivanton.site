// Збираємо всі td із таблиці
const tdList = [...document.querySelectorAll('#tasks td')];
let used = new Set();
let currentTd = null;

// Функція вибору нового завдання
function loadNewTask() {
    if (used.size === tdList.length) {
        alert("Усі завдання виконано!");
        return;
    }

    let index;
    do {
        index = Math.floor(Math.random() * tdList.length);
    } while (used.has(index));

    used.add(index);
    currentTd = tdList[index];

    const example = currentTd.innerText.split("*");
    document.getElementById("a").value = example[0];
    document.getElementById("b").value = example[1];

    // Очищаємо поле відповіді і ставимо фокус
    const answerInput = document.getElementById("answer");
    answerInput.value = "";
    answerInput.focus();
}

// Натискання кнопки "Перевірити"
document.getElementById("check").addEventListener("click", () => {
    if (!currentTd) return;

    const a = parseInt(document.getElementById("a").value);
    const b = parseInt(document.getElementById("b").value);
    const userAnswer = parseInt(document.getElementById("answer").value);
    const correctAnswer = a * b;

    // Знімаємо попередні класи
    currentTd.classList.remove("correct", "wrong");

    // Додаємо правильний або неправильний клас
    if (userAnswer === correctAnswer) {
        currentTd.classList.add("correct");
    } else {
        currentTd.classList.add("wrong");
    }

    // Після короткої паузи завантажуємо нове завдання
    setTimeout(loadNewTask, 500);
});

// Автофокус через Enter
document.getElementById("answer").addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        document.getElementById("check").click();
    }
});

// Старт тренажера
loadNewTask();
