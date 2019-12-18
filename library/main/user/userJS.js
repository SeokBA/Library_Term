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
        document.getElementById("ISBN").value = "";
        document.getElementById("bookName").value = ""; // 창 들어갈시 이전에 있던 기록들 초기화
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
    document.getElementById("modifyid").value = username.innerHTML.split(" ")[2];
    document.getElementById("modifyid").readOnly = true;
    document.getElementById("infoModify").style.display = "block";
}

function closeInfo() {
    document.getElementById("infomodify").style.display = "none";
}

function clickWithdraw(){
    document.getElementById("withdrawalModal").style.display = "block";
}

function closeWithdraw(){
    document.getElementById("modifyId").value = "";
    document.getElementById("modifyPw").value = "";
    document.getElementById("modifyName").value = "";
    document.getElementById("modifyEmail").value = "";
    document.getElementById("phoneModify").value = "";
    document.getElementById("modifyClassification").value = "";
    // 적혀있는 내용들 초기화
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
    var bookId = tr.childNodes[0].textContent;
    var bookISBN = tr.childNodes[1].textContent;
    var bookName = tr.childNodes[2].textContent;
    var username = document.getElementById("userName");
    document.getElementById("reserveBookName").value = bookName;
    document.getElementById("reserveBookId").value = bookId;
    document.getElementById("reserveBookISBN").value = bookISBN;
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
    var bookId = tr.childNodes[0].textContent;
    var bookISBN = tr.childNodes[1].textContent;
    var bookName = tr.childNodes[2].textContent;
    document.getElementById("borrowBookName").value = bookName;
    document.getElementById("borrowBookId").value = bookId;
    document.getElementById("borrowBookISBN").value = bookISBN;
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

function openCancelReserve() {
    var tr = (event.target).parentElement;
    var bookId = tr.childNodes[0].textContent;
    var bookISBN = tr.childNodes[1].textContent;

    document.getElementById("cancelReserveName").value = bookId;
    document.getElementById("cancelReserveISBN").value = bookISBN;
    document.getElementById("reserveCancelModal").style.display = "block"
}

function cancleReserve() {
    var bookId = document.getElementById("cancelReserveName").value;
    var bookISBN = document.getElementById("cancelReserveISBN").value;
    var id = username.innerHTML.split(" ")[2];
    xhttp.open("GET","", true); // 요기 전달할거 넣으면 될거같고
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;
            document.getElementById("reserveCancelModal").style.display = "none";
            // 이거 재갱신을 어떻게 해줄까ㅣ?
        }
    }
}


function requestWithdraw() {
    var id = username.innerHTML.split(" ")[2];
    xhttp.open("GET","",true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;
            location.href="../../login/login.html"
            // 탈퇴 했으므로 로그인 html 이동
        }
    }
}

function modifyUserInfo() {
    var userId = document.getElementById("modifyId").value;
    var userPw = document.getElementById("modifyPw").value;
    var userName = document.getElementById("modifyName").value;
    var userEmail = document.getElementById("modifyEmail").value;
    var userPhone = document.getElementById("phoneModify").value;
    var classfication = document.getElementById("modifyClassification").value;
    xhttp.open("GET","", true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;

        }
    }
}



