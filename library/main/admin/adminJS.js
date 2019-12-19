let adminStr = "http://112.166.141.161/library/main/admin/";

let bookListTable = document.getElementById("bookListTable");
let returnBookTable = document.getElementById("returnBookTable");
let userManageTable = document.getElementById("userManageTable");

let addBookModal = document.getElementById("addBookModal");
let modifyBookModal = document.getElementById("modifyBookModal");
let modifyUserModal = document.getElementById("modifyUserModal");
let borrowRankModal = document.getElementById("borrowRankModal");

let modifyISBN = null;
let modifyId = null;

// 회원 정보 수정 => 완료
function clickModifyUser(id) {
    modifyId = id;
    document.getElementById("modifyID").value = null;
    document.getElementById("modifyPW").value = null;
    document.getElementById("modifyName").value = null;
    document.getElementById("modifyEmail").value = null;
    document.getElementById("modifyPhone").value = null;
    document.getElementById("modifyClassification").value = null;
    modifyUserModal.style.display = "block";
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
        if (email.match(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i))
            sqlStr += "&email=" + email;
        else {
            alert("incorrect E-Mail");
            return;
        }
    }
    if (phone !== "") {
        if (phone.match(/^[0-9][0-9]?([0-9])-[0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]$/))
            sqlStr += "&phone=" + phone;
        else {
            alert("incorrect Phone Number");
            return;
        }
    }
    if (classification !== "") {
        if ((classification.match("학부") || classification.match("대학원") || classification.match("교직원")))
            sqlStr += "&classification=" + classification;
        else {
            alert("incorrect Classification");
            return;
        }
    }

    if (sqlStr === "") {
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
                closeModifyUser();
            } else
                alert("Modify Error");
        }
    };
    location.reload()
}

function closeModifyUser() {
    modifyId = null;
    modifyUserModal.style.display = "none";
}

// 책 등록 => 완료
function clickAddBook() {
    addBookModal.style.display = "block";
}

function addBook() {
    let title = document.getElementById("addTitle").value;
    let isbn = document.getElementById("addISBN").value;
    let author = document.getElementById("addAuthor").value;
    let publisher = document.getElementById("addPublisher").value;
    let sqlStr = "";

    if (title !== "") {
        sqlStr += "name=" + title;
    }
    else {
        alert("제목을 입력해주세요.");
        return;
    }

    if (isbn !== "") {
        if (!isNaN(isbn) && isbn.length == 13)
            sqlStr += "&isbn=" + isbn;
        else {
            alert("13자리 숫자를 입력해주세요")
            return;
        }
    }
    else {
        alert("ISBN을 입력해주세요.");
        return;
    }

    if (author !== "") {
        sqlStr += "&author=" + author;
    }
    else {
        alert("저자를 입력해주세요.");
        return;
    }

    if (publisher !== "") {
        sqlStr += "&publisher=" + publisher;
    }
    else {
        alert("출판사를 입력해주세요.");
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "addBook.php?" + sqlStr, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (chk === "1") {
                alert("complete");
                closeAddBook();
            } else {
                alert(chk);
                alert("Add Book Error");
            }
        }
    };
    location.reload()
}

function closeAddBook() {
    addBookModal.style.display = "none";
}


// 책 정보 수정 => 완료
function clickModifyBook(isbn) {
    modifyBookModal.style.display = "block";
    modifyISBN = isbn;
}

function modifyBook() {
    let title = document.getElementById("modifyTitle").value;
    let isbn = document.getElementById("modifyISBN").value;
    let author = document.getElementById("modifyAuthor").value;
    let publisher = document.getElementById("modifyPublisher").value;
    let sqlStr = "";

    if (title !== "") {
        sqlStr += "&name=" + title;
    }
    if (isbn !== "") {
        if (!isNaN(isbn) && isbn.length == 13)
            sqlStr += "&new_isbn=" + isbn;
        else {
            alert("13자리 숫자를 입력해주세요")
            return;
        }
    }
    if (author !== "") {
        sqlStr += "&author=" + author;
    }
    if (publisher !== "") {
        sqlStr += "&publisher=" + publisher;
    }

    if (sqlStr === "") {
        alert("변경할 내용을 입력해주세요.");
        return;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "updateBook.php?isbn=" + modifyISBN + sqlStr, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (chk === "1") {
                alert("complete");
                closeAddBook();
            } else
                alert("Add Book Error");
        }
    };
    closeModifyBook();
    location.reload()
}

function closeModifyBook() {
    modifyBookModal.style.display = "none";
    modifyISBN = null;
}

// 대출 순위 => 완료
function clickRank() {
    borrowRankModal.style.display = "block"
}

function closeRank() {
    borrowRankModal.style.display = "none";
}

// 회원 탈퇴 => 완료
function withdraw(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "delUser.php?id=" + id, true);
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
    location.reload()
}

// 책 삭제 => 완료
function removeBook(bookid) {
    if(!confirm("삭제하시겠습니까?"))
        return;
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", adminStr + "removeBook.php?book_id=" + bookid, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (this.responseText === "1")
                alert("Remove Complete");
            else
                alert("Remove Error");
        }
    };
    location.reload()
}

// 책 반납 => 완료
function returnBook(bookId) {
    if(!confirm("반납하시겠습니까?"))
        return;
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "returnManage.php?" + "bookId=" + bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let chk = this.responseText;
            if (this.responseText === "1")
                alert("Return Complete");
            else {
                alert("Return Error");
            }
        }
    };
    location.reload();
}

window.onclick = function (event) {
    if (event.target === addBookModal)
        closeAddBook();
    if (event.target === modifyBookModal)
        closeModifyBook();
    if (event.target === modifyUserModal)
        closeModifyUser();
    if (event.target === borrowRankModal)
        closeRank();
};

function changeTable() {
    if (event.target.id === "bookListSideBar") {
        bookListTable.style.display = "block";
        returnBookTable.style.display = "none";
        userManageTable.style.display = "none";
    } else if (event.target.id === "returnBookSideBar") {
        bookListTable.style.display = "none";
        returnBookTable.style.display = "block";
        userManageTable.style.display = "none";
    } else if (event.target.id === "userManageSideBar") {
        bookListTable.style.display = "none";
        returnBookTable.style.display = "none";
        userManageTable.style.display = "block";
    }
}