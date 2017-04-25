function show(elementID) {
    var elem = document.getElementById(elementID);
    if (!elem) {
        alert("no such element");
        return;
    }
    var pages = document.getElementsByClassName('page');
    for(var i = 0; i < pages.length; i++) {
        pages[i].style.display = 'none';
    }
    elem.style.display = 'block';
}