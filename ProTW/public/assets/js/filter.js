function myFunction(n) {
    // Declare variables e de la n sigur
    var input, filter, table, tr, td, i;
    if( n === 1 ) filter = "ACCIDENT";
    if( n === 2 ) filter = "OUT OF RANGE";
    if( n === 3 ) filter = "INTERACTION";
    if( n === 4 ) filter = "";
    if( n === 5 ) filter = "BACK IN RANGE";
    table = document.getElementById("notificationsTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}