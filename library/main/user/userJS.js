var Borrowlist = document.getElementById("borrowList");
var Searchbook = document.getElementById("searchBook");
var Reservebook = document.getElementById("reserveBook");

function OnChange(){
    if( event.target.id == "borrow" ){
        Borrowlist.style.display = "block";
        Searchbook.style.display = "none";
        Reservebook.style.display ="none";
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

function returnRequest() {
    var tr = (event.target).parentElement;
    var bookId = tr.childNodes[1].textContent; // 책 번호
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "returnBook.php?"+"bookId="+bookId, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            let chk = this.responseText;
            if(chk === "1"){
                alert("complete")
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

function temp(){
	alert("hi");
}

