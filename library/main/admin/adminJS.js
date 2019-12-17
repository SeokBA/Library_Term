let adminStr = "http://112.166.141.161/library/main/admin/";

let bookList = document.getElementById("bookList");
let returnBook = document.getElementById("returnBook");
let userManage = document.getElementById("userManage");
let withdrawalModal = document.getElementById("withdrawalModal");
let modifyModal = document.getElementById("modifyModal");

let modifyId = null;
let delId = null;

function updateBook(name, isbn, author, publisher) {
    // onclick='bookUpdate(\"" . $bookInformation['name'] . "\", \"" . $bookInformation['ISBN'] . "\", \"" . $bookInformation['author'] . "\", \"" . $bookInformation['publisher'] . "\");'
    let xhttp = new XMLHttpRequest();
    var id = "abcdefghijklmn" //temp id
    xhttp.open("GET", adminStr + "updateBook.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let data = this.responseText;
        }
    };
}

function removeBook(bookId) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "removeBook.php?book_id=" + bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1")
                alert("Remove Complete");
            else if (this.responseText === "2")
                alert("반납이 되지않았거나, 예약된 책입니다.");
            else
                alert("Remove Error");
        }
    };
}

// 회원 탈퇴 관련
function clickWithdraw(id) {
    delId = id;
    withdrawalModal.style.display = "block"
}

function withdraw() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "delUser.php?id=" + delId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1")
                alert("Delete Complete");
            else if (this.responseText === "2")
                alert("해당 유저가 반납을 하지 않은 책이 있습니다.");
            else
                alert("Delete Error");
        }
    };
    closeWithdraw();
}

function closeWithdraw() {
    delId = null;
    withdrawalModal.style.display = "none";
}

// 회원 정보 수정 관련
function clickModify(id) {
    modifyId = id;
    document.getElementById("modifyID").value = null;
    document.getElementById("modifyPW").value = null;
    document.getElementById("modifyName").value = null;
    document.getElementById("modifyEmail").value = null;
    document.getElementById("modifyPhone").value = null;
    document.getElementById("modifyClassification").value = null;
    modifyModal.style.display = "block";
}

function modifyAccount() {
    let id = document.getElementById("modifyID").value;
    let pw = document.getElementById("modifyPW").value;
    let name = document.getElementById("modifyName").value;
    let email = document.getElementById("modifyEmail").value;
    let phone = document.getElementById("modifyPhone").value;
    let classification = document.getElementById("modifyClassification").value;
    let sqlStr = "";

    if (id !== "") {
        sqlStr += "&newId=" + id;
    }
    if (pw !== "") {
        sqlStr += "&pw=" + pw;
    }
    if (name !== "") {
        sqlStr += "&name=" + name;
    }
    if (email !== "") {
        if (email.match(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i) == null)
            sqlStr += "&email=" + email;
        else {
            alert("incorrect E-Mail");
            return;
        }
    }
    if (phone !== "") {
        if (phone.match(/^[0-9][0-9]?([0-9])-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]$/) == null)
            sqlStr += "&phone=" + phone;
        else {
            alert("incorrect Phone Number");
            return;
        }
    }
    if (classification !== "") {
        if (!(classification.match("학부") || classification.match("대학원") || classification.match("교직원")))
            sqlStr += "&classification=" + classification;
        else {
            alert("incorrect Classification");
            return;
        }
    }

    if(sqlStr === ""){
        alert("변경할 내용을 입력해주세요.");
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "updateUser.php?id=" + modifyId + sqlStr, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (chk === "1") {
                alert("complete");
                closeModify();
            } else
                alert("Modify Error");
        }
    };
}

function closeModify() {
    modifyId = null;
    modifyModal.style.display = "none";
}


function clickRank() {
    document.getElementById("borrowRank").style.display = "block"
}

function clickRegister() {
    document.getElementById("registerModal").style.display = "block";
}

function clickBook() {
    document.getElementById("modifyBook").style.display = "block";
}


function closeRegister() {
    document.getElementById("registerModal").style.display = "none";
}

function closeBook() {
    document.getElementById("modifyBook").style.display = "none";
}

function closeRank() {
    document.getElementById("borrowRank").style.display = "none";
}


window.onclick = function (event) {
    if (event.target === document.getElementById("accountWithdrawal"))
        closeWithdraw();
    if (event.target === document.getElementById("modifyUser"))
        closeModify();
};

function changeTable() {
    if (event.target.id === "bookListSideBar") {
        bookList.style.display = "block";
        returnBook.style.display = "none";
        userManage.style.display = "none";
    } else if (event.target.id === "returnBookSideBar") {
        bookList.style.display = "none";
        returnBook.style.display = "block";
        userManage.style.display = "none";
    } else if (event.target.id === "userManageSideBar") {
        bookList.style.display = "none";
        returnBook.style.display = "none";
        userManage.style.display = "block";
    }
}

function returnBook_manage(){
    var bookId = document.getElementById('return_bookid');
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "returnManage.php?"+"bookId="+bookId.innerHTML, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
        }
    }

}


