let xhttp = new XMLHttpRequest();
let loginStr = "http://112.166.141.161/library/login/";

function initLoad() {
    xhttp.open("GET", loginStr + "initLogin.php?", true);
    xhttp.send();
}

function signIn() {
    let id = document.getElementById("idTextBox").value;
    let pw = document.getElementById("pwTextBox").value;
    if (id === "" || pw === "") { // 항목이 비어있을 경우
        alert("Enter your username or password");
        return;
    }
    xhttp.open("GET", loginStr + "loadPW.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let dataPW = this.responseText;
            if (pw === dataPW) { // 비밀번호가 매칭이 되었을 경우
                xhttp.open("GET", loginStr + "moveMain.php?", true);
                xhttp.send();
                location.reload();
            } else // 매칭되지 않았을 경우
                alert(("Incorrect username or password"));
        }
    };
}

function signUp() {
    let id = document.getElementById("idSignUpBox");
    let pw = document.getElementById("pwSignUpBox");
    let name = document.getElementById("nameSignUpBox");
    let email = document.getElementById("emailSignUpBox");
    let phone = document.getElementById("phoneSignUpBox");
    let classification = document.getElementById("classificationSignUpBox");

    xhttp.open("GET", loginStr + "checkID.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            alert(chk);
            if (chk === true) {
                xhttp.open("GET", loginStr + "signUp.php?" +
                    "id=" + id
                    + "pw=" + pw
                    + "name=" + name
                    + "email=" + email
                    + "phone=" + phone
                    + "classification=" + classification, true);
                xhttp.send();
                alert("complete");
                location.reload();
                cancelSignUp();
            } else
                alert("중복된 아이디입니다.");
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

function cancelSignUp() {
    document.getElementById("signUpModal").style.display = "none";
}

window.onclick = function (event) {
    if (event.target === document.getElementById("signUpModal"))
        cancelSignUp();
};

initLoad();