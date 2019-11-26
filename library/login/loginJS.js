let loginStr = "http://112.166.141.161/library/login/";

function signIn() {
    let id = document.getElementById("idTextBox").value;
    let pw = document.getElementById("pwTextBox").value;
    if (id === "" || pw === "") { // 항목이 비어있을 경우
        alert("Enter your username or password");
        return;
    }
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", loginStr+"chkPW.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let dataPW = this.responseText;
            if (pw === dataPW) { // 비밀번호가 매칭이 되었을 경우
                location.href="/library/main/todoList.html";
            } else // 매칭되지 않았을 경우
                alert("Incorrect username or password");
        }
    };
}

function initSignUp() {
    document.getElementById("idSignUpBox").value = "";
    document.getElementById("pwSignUpBox").value = "";
    document.getElementById("nameSignUpBox").value = "";
    document.getElementById("emailSignUpBox").value = "";
    document.getElementById("phoneSignUpBox").value = "";
    document.getElementById("classificationSignUpBox").value = "";
    document.getElementById("signUpModal").style.display = "block";
}

function signUp() {
    let id = document.getElementById("idSignUpBox").value;
    let pw = document.getElementById("pwSignUpBox").value;
    let name = document.getElementById("nameSignUpBox").value;
    let email = document.getElementById("emailSignUpBox").value;
    let phone = document.getElementById("phoneSignUpBox").value;
    let classification = document.getElementById("classificationSignUpBox").value;

    if(id === ""){
        alert("Enter your ID");
        return;
    }

    if(pw === ""){
        alert("Enter your Password");
        return;
    }

    if(name === ""){
        alert("Enter your Name");
        return;
    }

    if(email === "" || email.match(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i) == null){
        alert("Incorrect your E-mail");
        return;
    }

    if(phone === "" || phone.match(/^[0-9][0-9]?([0-9])-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]$/) == null){
        alert("Incorrect your Phone Number");
        return;
    }

    if(classification === "" || !(classification.match("학부") || classification.match("대학원") || classification.match("교직원"))){
        alert("Incorrect your Classification");
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", loginStr + "signUp.php?" +
        "id=" + id
        + "&pw=" + pw
        + "&name=" + name
        + "&email=" + email
        + "&phone=" + phone
        + "&classification=" + classification, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (chk === "1") {
                alert("complete");
                closeSignUp();
            } else
                alert("Duplication ID");
        }
    };
}

function closeSignUp() {
    document.getElementById("signUpModal").style.display = "none";
}

window.onclick = function (event) {
    if (event.target === document.getElementById("signUpModal"))
        closeSignUp();
};