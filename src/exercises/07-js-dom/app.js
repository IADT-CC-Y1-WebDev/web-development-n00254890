const myBtn = document.getElementById('my_btn');
const input = document.getElementById('my_input');
const outputDiv = document.getElementById('output');
myBtn.addEventListener('click', addParagraph);

function addParagraph() {
  const text = input.value.trim();
 const p = document.createElement('p');
  p.textContent = text;

  outputDiv.appendChild(p);

}