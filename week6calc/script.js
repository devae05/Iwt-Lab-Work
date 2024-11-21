const result = document.getElementById("result");

function append(value) {
    result.value += value;
}

function clearDisplay() {
    result.value = "";
}

function deleteChar() {
    result.value = result.value.slice(0, -1);
}

function calculate() {
    try {
        result.value = eval(result.value);
    } catch {
        result.value = "Error";
    }
}
