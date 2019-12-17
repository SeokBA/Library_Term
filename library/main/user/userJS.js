var Borrowlist = document.getElementById("borrowList");
var Searchbook = document.getElementById("searchBook");
var Reservebook = document.getElementById("reserveBook");

function OnChange(){
    if( event.target.id == "borrow" ){
        Borrowlist.style.display = "block";
        Searchbook.style.display = "none";
        Reservebook.style.display ="none";
        location.reload();
    }
    else if( event.target.id == "search"){
        Borrowlist.style.display = "none";
        Searchbook.style.display = "block";
        Reservebook.style.display ="none";
    }
    else if(event.target.id == "reserve"){
        Borrowlist.style.display = "none";
        Searchbook.style.display = "none";
        Reservebook.style.display ="block";
    }
}

function clickInfo() {
    document.getElementById("infomodify").style.display = "block";
    var idtext = document.getElementById("userName").textContent.split(":")[1];
    document.getElementById("modifyid").value = idtext.trim();
    document.getElementById("modifyid").readOnly = true;
}

function closeInfo() {
    document.getElementById("infomodify").style.display = "none";
}

function clickWithdraw(){
    document.getElementById("withdrawalModal").style.display = "block";
}

function closeWithdraw(){
    document.getElementById("withdrawalModal").style.display = "none";
}

function closeBorrow() {
    document.getElementById("borrowModal").style.display = "none";
}

function closeReserve() {
    document.getElementById("reserveModal").style.display = "none";
}

function returnRequest() {
    var tr = (event.target).parentElement.parentElement;
    var bookId = tr.childNodes[1].textContent; // 책 번호
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "returnBook.php?"+"bookId="+bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
            console.log(chk);
            if(chk === "1"){
                location.reload();
            }
        }
    }
}

function searchBook() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "searchBook.php?"+"ISBN="+document.getElementById("ISBN").value+"&bookname="+document.getElementById("bookName").value , true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
	if(this.readyState === 4 && this.status === 200){
		chk = this.responseText;
		var x = document.getElementById('searchTable');		
		x.innerHTML = chk;
		}
    }
}

function openReserveModal() { // 클릭시 예약 모달 출력
    var tr = (event.target).parentElement;
    var BookId = tr.childNodes[0].textContent;
    var BookISBN = tr.childNodes[1].textContent;
    var BookName = tr.childNodes[2].textContent;
    var username = document.getElementById("userName");
    document.getElementById("reserveBookName").value = BookName;
    document.getElementById("reserveBookId").value = BookId;
    document.getElementById("reserveBookISBN").value = BookISBN;
    document.getElementById("reserveModal").style.display = "block";
}

function reserveBook() { //
    var bookId = document.getElementById("reserveBookId").value;
    var username = document.getElementById("userName");
    var id = username.innerHTML.split(" ")[2];
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "reservationBook.php?id="+id+"&bookid="+bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;
            document.getElementById("reserveModal").style.display = "none";
            searchBook();
        }
    }
}

function openBorrowModal() { // 클릭시 대출 모달 출력
    var tr = (event.target).parentElement;
    var BookId = tr.childNodes[0].textContent;
    var BookISBN = tr.childNodes[1].textContent;
    var BookName = tr.childNodes[2].textContent;
    document.getElementById("borrowBookName").value = BookName;
    document.getElementById("borrowBookId").value = BookId;
    document.getElementById("borrowBookISBN").value = BookISBN;
    document.getElementById("borrowModal").style.display = "block";
}


function borrowBook(){
    var bookId = document.getElementById("borrowBookId").value;
    var bookISBN = document.getElementById("borrowBookISBN").value;
    var username = document.getElementById("userName");
    var id = username.innerHTML.split(" ")[2];
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "borrowBook.php?id="+id+"&bookid="+bookId , true); // 요기 전달할거 넣으면 될거같고
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;
            document.getElementById("borrowModal").style.display = "none";
            searchBook(); // 예약도 똑같이
        }
    }
}
