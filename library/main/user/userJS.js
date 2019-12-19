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
        document.getElementById("ISBN").value ="";
        document.getElementById("bookName").value ="";
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
    document.getElementById("modifyId").value = document.getElementById("userName").innerHTML.split(" ")[2];
    document.getElementById("modifyId").readOnly = true;
    document.getElementById("infoModify").style.display = "block";
}

function closeInfo() {
    document.getElementById("modifyId").value = "";
    document.getElementById("modifyPw").value = "";
    document.getElementById("modifyName").value = "";
    document.getElementById("modifyEmail").value = "";
    document.getElementById("phoneModify").value = "";
    document.getElementById("modifyClassification").value = "";
    document.getElementById("infoModify").style.display = "none";
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
    let tr = (event.target).parentElement.parentElement;
    let bookId = tr.childNodes[1].textContent; // 책 번호
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
            let x = document.getElementById('searchTable');
            x.innerHTML = chk;
        }
    }
}

function openReserveModal() { // 클릭시 예약 모달 출력
    let tr = (event.target).parentElement;
    let BookId = tr.childNodes[0].textContent;
    let BookISBN = tr.childNodes[1].textContent;
    let BookName = tr.childNodes[2].textContent;
    let username = document.getElementById("userName");
    document.getElementById("reserveBookName").value = BookName;
    document.getElementById("reserveBookId").value = BookId;
    document.getElementById("reserveBookISBN").value = BookISBN;
    document.getElementById("reserveModal").style.display = "block";
}

function reserveBook() { //
    let bookId = document.getElementById("reserveBookId").value;
    let username = document.getElementById("userName");
    let id = username.innerHTML.split(" ")[2];
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "reservationBook.php?id="+id+"&bookid="+bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            chk = this.responseText;
            if( chk == "dup" ){
                alert("이미 예약하신 책 입니다");
                return;
            }
            document.getElementById("reserveModal").style.display = "none";
            console.log(chk);
            searchBook();
        }
    }
}

function openBorrowModal() { // 클릭시 대출 모달 출력
    let tr = (event.target).parentElement;
    let BookId = tr.childNodes[0].textContent;
    let BookISBN = tr.childNodes[1].textContent;
    let BookName = tr.childNodes[2].textContent;
    document.getElementById("borrowBookName").value = BookName;
    document.getElementById("borrowBookId").value = BookId;
    document.getElementById("borrowBookISBN").value = BookISBN;
    document.getElementById("borrowModal").style.display = "block";
}


function borrowBook(){
    let bookId = document.getElementById("borrowBookId").value;
    let bookISBN = document.getElementById("borrowBookISBN").value;
    let username = document.getElementById("userName");
    let id = username.innerHTML.split(" ")[2];
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
    let tr = (event.target).parentElement;
    let bookId = tr.childNodes[0].textContent;
    let bookISBN = tr.childNodes[1].textContent;

    document.getElementById("cancelReserveName").value = bookId;
    document.getElementById("cancelReserveISBN").value = bookISBN;
    document.getElementById("reserveCancelModal").style.display = "block"
}

function cancleReserve() {
    let bookId = document.getElementById("cancelReserveName").value;
    let bookISBN = document.getElementById("cancelReserveISBN").value;
    let id = username.innerHTML.split(" ")[2];
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET","cancelReservation.php?="+"id="+id+"&bookId="+bookId, true); // 요기 전달할거 넣으면 될거같고
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
            document.getElementById("reserveCancelModal").style.display = "none";// 이거 재갱신을 어떻게 해줄까ㅣ?
        }
    }
}


function requestWithdraw() {
    let id = username.innerHTML.split(" ")[2];
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET","",true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
            location.href="../../login/login.html" // 탈퇴 했으므로 로그인 html 이동
        }
    }
}

function modifyUserInfo() {
    let userId = document.getElementById("modifyId").value;
    let userPw = document.getElementById("modifyPw").value;
    let userName = document.getElementById("modifyName").value;
    let userEmail = document.getElementById("modifyEmail").value;
    let userPhone = document.getElementById("phoneModify").value;
    let classfication = document.getElementById("modifyClassification").value;
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET","updateUser.php?id="+userId+"&pwd="+userPw+"&name="+userName+"&email="+userEmail+"&pnum="+userPhone+"&proper="+classfication, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
            alert(chk);
            closeInfo();
        }
    }
}


