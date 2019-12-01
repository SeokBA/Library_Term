let bookList = document.getElementById("bookList");
let returnbook = document.getElementById("returnBook");
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
    alert(event.target.id);
    if( event.target.id === "booklist" ){
        bookList.style.display = "block";
        returnbook.style.display = "none";
        userManage.style.display ="none";
    }
    else if( event.target.id === "returnbook"){
        bookList.style.display = "none";
        returnbook.style.display = "block";
        userManage.style.display ="none";
    }
    else if(event.target.id === "manage"){
        bookList.style.display = "none";
        returnbook.style.display = "none";
        userManage.style.display ="block";
    }
}

function clickRegister() {document.getElementById("registerModal").style.display = "block";}
function clickModify() {document.getElementById("modifyModal").style.display = "block";}
function closeRegister() {document.getElementById("registerModal").style.display = "none";}
function closeModify() {document.getElementById("modifyModal").style.display = "none";}
function clickRank() {document.getElementById("borrowRank").style.display = "block"}
function closeRank() {document.getElementById("borrowRank").style.display = "none";}