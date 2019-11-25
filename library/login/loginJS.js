let xhttp = new XMLHttpRequest();

function initLoad() {
    xhttp.open("GET", "http://112.166.141.161/library/initLogin.php?", true);
    xhttp.send();
}

function Login() {
    let id = document.getElementById("idTextBox").value;
    let pw = document.getElementById("pwTextBox").value;
    if (id === "" || pw === "") { // 항목이 비어있을 경우
        alert("아이디 또는 패스워드를 입력해주세요.");
        return;
    }
    xhttp.open("GET", "http://112.166.141.161/library/loadPW.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let dataPW = this.responseText;
            if (pw === dataPW) { // 비밀번호가 매칭이 되었을 경우
                xhttp.open("GET", "http://112.166.141.161/library/moveMain.php?", true);
                xhttp.send();
                location.reload();
            } else // 매칭되지 않았을 경우
                alert(("아이디 또는 패스워드가 틀립니다."));
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

    xhttp.open("GET", "http://112.166.141.161/library/checkID.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (chk === true) {
                xhttp.open("GET", "http://112.166.141.161/library/signUp.php?" +
                    "id=" + id
                    +"pw=" + pw
                    +"name=" + name
                    +"email=" + email
                    +"phone=" + phone
                    +"classification=" + classification, true);
                xhttp.send();
                alert("complete");
                location.reload();
            }
            else
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
    if (event.target === document.getElementById("signUpModal")) {
        cancelSignUp();
    }
};

initLoad();