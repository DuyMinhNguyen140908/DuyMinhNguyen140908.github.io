let messageIndex = 0;
const messages = [
    "Are you sure?", 
    "Really sure?", 
    "Are you positive?", 
    "Pokies please!", 
    "Just think about it...", 
    "If you say no, I will be really sad...", 
    "I will be really sad...", 
    "I will be very very sad..."
];

const noBtn = document.getElementById("noBtn");
const yesBtn = document.getElementById("yesBtn");
const finalMessage = document.getElementById("finalMessage");
const question = document.getElementById("question");

noBtn.addEventListener("click", () => {
    if (messageIndex < messages.length) {
        noBtn.textContent = messages[messageIndex];
        messageIndex++;

        let currentSize = parseFloat(window.getComputedStyle(yesBtn).fontSize);
        yesBtn.style.fontSize = `${currentSize * 1.5}px`;
    } else {
        // Khi Yes đã phóng to che màn hình, nhấn Yes để hiện "Knew you would say yes"
        yesBtn.style.fontSize = "100vw";
        yesBtn.style.height = "100vh";
        yesBtn.style.position = "fixed";
        yesBtn.style.top = "0";
        yesBtn.style.left = "0";
        yesBtn.style.textAlign = "center";
        yesBtn.style.display = "flex";
        yesBtn.style.alignItems = "center";
        yesBtn.style.justifyContent = "center";
        yesBtn.textContent = "Click me!";
    }
});

yesBtn.addEventListener("click", () => {
    question.style.display = "none";
    yesBtn.style.display = "none";
    noBtn.style.display = "none";
    finalMessage.style.display = "block";
});
