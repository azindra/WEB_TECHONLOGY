function getValues() {
    let a = parseFloat(document.getElementById("num1").value);
    let b = parseFloat(document.getElementById("num2").value);
    return [a, b];
}

function showResult(value) {
    document.getElementById("result").innerText = "Result: " + value;
}

function add() {
    let [a, b] = getValues();
    showResult(a + b);
}

function subtract() {
    let [a, b] = getValues();
    showResult(a - b);
}

function multiply() {
    let [a, b] = getValues();
    showResult(a * b);
}

function divide() {
    let [a, b] = getValues();
    if (b === 0) {
        showResult("Cannot divide by 0");
    } else {
        showResult(a / b);
    }
}