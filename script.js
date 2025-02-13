let messageIndex = 0;
const messages = [
    "Are you sure?", "Really sure?", "Are you positive?", "Agree, please!",
    "Just think about it...", "I will be really sad...", "Very very sad..."
];

const noBtn = document.getElementById("noBtn");
const yesBtn = document.getElementById("yesBtn");
const finalMessage = document.getElementById("finalMessage");
const question = document.getElementById("question");

let baseSize = 24;
let increaseFactor = 1.45; // Tăng YES 1.45 lần mỗi lần

noBtn.addEventListener("click", () => {
    if (messageIndex < messages.length) {
        noBtn.textContent = messages[messageIndex++];

        // Phóng to YES
        baseSize *= increaseFactor;
        yesBtn.style.fontSize = `${baseSize}px`;

        // Căn giữa YES
        yesBtn.style.position = "fixed";
        yesBtn.style.top = "50%";
        yesBtn.style.left = "50%";
        yesBtn.style.transform = "translate(-50%, -50%)";

        // Lấy vị trí YES
        let yesRect = yesBtn.getBoundingClientRect();
        let noX, noY;

        let offset = yesRect.width * 0.6; // Khoảng cách tối thiểu giữa NO và YES
        let direction = Math.floor(Math.random() * 4); // 0: trái, 1: phải, 2: trên, 3: dưới

        if (direction === 0) { // Trái
            noX = yesRect.left - noBtn.offsetWidth - offset;
            noY = yesRect.top + (yesRect.height - noBtn.offsetHeight) / 2;
        } else if (direction === 1) { // Phải
            noX = yesRect.right + offset;
            noY = yesRect.top + (yesRect.height - noBtn.offsetHeight) / 2;
        } else if (direction === 2) { // Trên
            noX = yesRect.left + (yesRect.width - noBtn.offsetWidth) / 2;
            noY = yesRect.top - noBtn.offsetHeight - offset;
        } else { // Dưới
            noX = yesRect.left + (yesRect.width - noBtn.offsetWidth) / 2;
            noY = yesRect.bottom + offset;
        }

        // Kiểm tra nếu NO bị ra ngoài màn hình
        if (noX < 10) noX = yesRect.left + offset;
        if (noX + noBtn.offsetWidth > window.innerWidth) noX = yesRect.right - noBtn.offsetWidth - offset;
        if (noY < 10) noY = yesRect.top + offset;
        if (noY + noBtn.offsetHeight > window.innerHeight) noY = yesRect.bottom - noBtn.offsetHeight - offset;

        // Đặt lại vị trí NO
        noBtn.style.left = `${noX}px`;
        noBtn.style.top = `${noY}px`;
    } else {
        // Lần cuối, YES phủ màn hình
        yesBtn.style.width = "100vw";
        yesBtn.style.height = "100vh";
        yesBtn.style.fontSize = "15vw";
        yesBtn.textContent = "YES";
        yesBtn.style.zIndex = "999";

        // Đảm bảo "Code by" không bị che
        document.getElementById("credit").style.zIndex = "1000";
    }
});

yesBtn.addEventListener("click", () => {
    question.style.display = "none";
    yesBtn.style.display = "none";
    noBtn.style.display = "none";
    finalMessage.style.display = "block";
});
