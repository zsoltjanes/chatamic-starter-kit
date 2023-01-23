let i = 0;
const replyContainer = document.getElementById("reply");
const alma= replyContainer.dataset.reply;
const speed = 25; // Speed for the reply writer
const textArray = alma.split('\n');
let currentLine = 0;

function writer() {
    if (currentLine < textArray.length) {
        let line = textArray[currentLine];
        if (i < line.length) {
            replyContainer.innerHTML += line.charAt(i);
            i++;
            setTimeout(writer, speed);
        } else {
            i = 0;
            currentLine++;
            replyContainer.innerHTML += '<br>';
            setTimeout(writer, speed);
        }
    }
}

writer();
