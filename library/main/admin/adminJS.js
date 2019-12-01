var bookList = document.getElementById("bookList");
var returnbook = document.getElementById("returnBook");
var ManagePage = document.getElementById("ManagePage");

function OnChange(){
    if( event.target.id == "booklist" ){
        bookList.style.display = "block";
        returnbook.style.display = "none";
        ManagePage.style.display ="none";
    }
    else if( event.target.id == "returnbook"){
        bookList.style.display = "none";
        returnbook.style.display = "block";
        ManagePage.style.display ="none";
    }
    else if(event.target.id == "manage"){
        bookList.style.display = "none";
        returnbook.style.display = "none";
        ManagePage.style.display ="block";
    }
}

function clickRank() {document.getElementById("borrowRank").style.display = "block"}
function clickRegister() {document.getElementById("registerModal").style.display = "block";}
function clickWithdraw(){document.getElementById("withdrawUser").style.display = "block"}
function clickBook() {document.getElementById("modifyBook").style.display = "block";}
function clickUser() {
    document.getElementById("modifyUser").style.display = "block";
    var userid = (document.getElementById(event.target).parentElement).parentElement
    document.getElementById("userID").value = userid.childNodes[3].textContent;
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
function closeWithdraw(){document.getElementById(withdrawUser).style.display = "none";}