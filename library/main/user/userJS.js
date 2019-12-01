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

function clickModal() {
    document.getElementById("infoModal").style.display = "block";
}

function closeModal() {
    document.getElementById("infoModal").style.display = "none";
}

function returnRequest() {
    var tr = (event.target).parentElement;
    var bookId = tr.childNodes[1].textContent; // 책 번호
    document.getElementById("borrowTable").removeChild(tr);
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