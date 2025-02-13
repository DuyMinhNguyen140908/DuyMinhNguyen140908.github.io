let messageIndex = 0;
const messages = [
    "Are you sure?", "Really sure?", "Are you positive?", "Agree, please!", 
    "Just think about it...", "I will be really sad...", "Very very sad..."
];

const noBtn = document.getElementById("noBtn");
const yesBtn = document.getElementById("yesBtn");
const finalMessage = document.getElementById("finalMessage");
const question = document.getElementById("question");
const gifImage = document.getElementById("gifImage");

let baseSize = 24;
let increaseFactor = 1.4;

noBtn.addEventListener("click", () => {
    if (messageIndex < messages.length) {
        noBtn.textContent = messages[messageIndex++];
        baseSize *= increaseFactor;
        yesBtn.style.fontSize = `${baseSize}px`;

        yesBtn.style.position = "fixed";
        yesBtn.style.top = "50%";
        yesBtn.style.left = "50%";
        yesBtn.style.transform = "translate(-50%, -50%)";

        let yesRect = yesBtn.getBoundingClientRect();
        let noX, noY;
        let offset = yesRect.width * 0.4;

        let direction = Math.floor(Math.random() * 4);
        if (direction === 0) {
            noX = yesRect.left - noBtn.offsetWidth - offset;
            noY = yesRect.top + (yesRect.height - noBtn.offsetHeight) / 2;
        } else if (direction === 1) {
            noX = yesRect.right + offset;
            noY = yesRect.top + (yesRect.height - noBtn.offsetHeight) / 2;
        } else if (direction === 2) {
            noX = yesRect.left + (yesRect.width - noBtn.offsetWidth) / 2;
            noY = yesRect.top - noBtn.offsetHeight - offset;
        } else {
            noX = yesRect.left + (yesRect.width - noBtn.offsetWidth) / 2;
            noY = yesRect.bottom + offset;
        }

        let screenW = window.innerWidth;
        let screenH = window.innerHeight;
        let minDist = 30;

        if (noX < minDist) noX = yesRect.right + minDist;
        if (noX + noBtn.offsetWidth > screenW - minDist) noX = yesRect.left - noBtn.offsetWidth - minDist;
        if (noY < minDist) noY = yesRect.bottom + minDist;
        if (noY + noBtn.offsetHeight > screenH - minDist) noY = yesRect.top - noBtn.offsetHeight - minDist;

        noBtn.style.left = `${noX}px`;
        noBtn.style.top = `${noY}px`;
    } else {
        yesBtn.style.width = "100vw";
        yesBtn.style.height = "100vh";
        yesBtn.style.fontSize = "15vw";
        yesBtn.textContent = "YES";
        yesBtn.style.zIndex = "999";

        noBtn.style.display = "none";
        document.getElementById("credit").style.zIndex = "1000";
    }
});

yesBtn.addEventListener("click", () => {
    question.style.display = "none";
    yesBtn.style.display = "none";
    noBtn.style.display = "none";
    finalMessage.style.display = "block";

    // Đổi GIF và tăng kích 
