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
function clickAdmin() {document.getElementById("modifyAdmin").style.display = "block";}
function clickUser() {
    document.getElementById("modifyUser").style.display = "block";
    let userid = (event.target.parentElement).parentElement;
    document.getElementById("userID").value = userid.childNodes[0].textContent;
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
function closeWithdraw(){document.getElementById("withdrawUser").style.display = "none";}
function closeAdmin() {document.getElementById("modifyAdmin").style.display = "none";}

function modifyUser() {} // 유저 테이블 유저 관리자 정보 수정
function modifyAdmin() {} // 관리자 테이블 관리자들 정보 수정
function modifySelf() {} // 자기 자신 정보 수정
function bookReturn() {} // 책 반납
function bookRegist() {} // 책 등록
function withdrawUser() {} // 유저 탈퇴