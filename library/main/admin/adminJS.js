var bookList = document.getElementById("bookList");
var returnbook = document.getElementById("returnBook");
var Manage = document.getElementById("Manage");

function OnChange(){
    if( event.target.id == "booklist" ){
        bookList.style.display = "block";
        returnbook.style.display = "none";
        Manage.style.display ="none";
    }
    else if( event.target.id == "returnbook"){
        bookList.style.display = "none";
        returnbook.style.display = "block";
        Manage.style.display ="none";
    }
    else if(event.target.id == "manage"){
        bookList.style.display = "none";
        returnbook.style.display = "none";
        Manage.style.display ="block";
    }
}

function clickRegister() {document.getElementById("registerModal").style.display = "block";}
function clickModify() {document.getElementById("modifyModal").style.display = "block";}
function closeRegister() {document.getElementById("registerModal").style.display = "none";}
function closeModify() {document.getElementById("modifyModal").style.display = "none";}
function clickRank() {document.getElementById("borrowRank").style.display = "block"}
function closeRank() {document.getElementById("borrowRank").style.display = "none";}