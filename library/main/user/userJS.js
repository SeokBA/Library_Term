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