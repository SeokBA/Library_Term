let bookList = document.getElementById("bookList");
let returnBook = document.getElementById("returnBook");
let userManage = document.getElementById("userManage");

function bookUpdate(name, isbn, author, publisher) {
    // onclick='bookUpdate(\"" . $bookInformation['name'] . "\", \"" . $bookInformation['ISBN'] . "\", \"" . $bookInformation['author'] . "\", \"" . $bookInformation['publisher'] . "\");'
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", loginStr + "updateBook.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let data = this.responseText;
        }
    };
}

function bookRemove(bookId) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", loginStr + "removeBook.php?book_idd=" + bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1")
                alert("Remove Complete");
            else
                alert("Remove Error");
        }
    };
}

function modifyAccount() {
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

    else if(pw === ""){
        alert("Enter your Password");
        return;
    }

    else if(name === ""){
        alert("Enter your Name");
        return;
    }

    else if(email === "" || email.match(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i) == null){
        alert("Incorrect your E-mail");
        return;
    }

    else if(phone === "" || phone.match(/^[0-9][0-9]?([0-9])-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]$/) == null){
        alert("Incorrect your Phone Number");
        return;
    }

    else if(classification === "" || !(classification.match("학부") || classification.match("대학원") || classification.match("교직원"))){
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






function OnChange(){
    if( event.target.id === "bookListSideBar" ){
        bookList.style.display = "block";
        returnBook.style.display = "none";
        userManage.style.display ="none";
    }
    else if( event.target.id === "returnBookSideBar"){
        bookList.style.display = "none";
        returnBook.style.display = "block";
        userManage.style.display ="none";
    }
    else if(event.target.id === "userManageSideBar"){
        bookList.style.display = "none";
        returnBook.style.display = "none";
        userManage.style.display ="block";
    }
}

function clickRank() {document.getElementById("borrowRank").style.display = "block"}
function clickRegister() {document.getElementById("registerModal").style.display = "block";}
function clickWithdraw(){document.getElementById("withdrawUser").style.display = "block"}
function clickBook() {document.getElementById("modifyBook").style.display = "block";}
function clickUser() {
    document.getElementById("modifyUser").style.display = "block";
    let userid = (document.getElementById(event.target).parentElement).parentElement;
    document.getElementById("userID").value = userid.childNodes[3].textContent;
    document.getElementById("userID").readOnly = true;
}
function closeRegister() {document.getElementById("registerModal").style.display = "none";}
function closeBook() {document.getElementById("modifyBook").style.display = "none";}
function closeUser() {
    document.getElementById("modifyUser").style.display = "none";
    document.getElementById("userID").value = "";
    document.getElementById("userID").readOnly = false;
}
function closeRank() {document.getElementById("borrowRank").style.display = "none";}
function closeWithdraw(){document.getElementById(withdrawUser).style.display = "none";}