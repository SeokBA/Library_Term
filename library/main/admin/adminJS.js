let bookList = document.getElementById("bookList");
let returnbook = document.getElementById("returnBook");
let Manage = document.getElementById("Manage");

function bookUpdate(name, isbn, author, publisher){
    alert("hello");
    alert(name);
    alert(isbn);
    alert(author);
    alert(publisher);
}

function bookRemove(bookId) {
    alert("hi");
    alert(bookId);
}








function OnChange(){
    if( event.target.id == "bookList" ){
        bookList.style.display = "block";
        returnbook.style.display = "none";
        Manage.style.display ="none";
    }
    else if( event.target.id == "returnBook"){
        bookList.style.display = "none";
        returnbook.style.display = "block";
        Manage.style.display ="none";
    }
    else if(event.target.id == "Manage"){
        bookList.style.display = "none";
        returnbook.style.display = "none";
        Manage.style.display ="block";
    }
}

function clickRegister() {
    document.getElementById("registerModal").style.display = "block";
}

function clickModify() {
    document.getElementById("modifyModal").style.display = "block";
}

function closeRegister() {
    document.getElementById("registerModal").style.display = "none";
}

function closeModify() {
    document.getElementById("modifyModal").style.display = "none";
}