function getpic(id) {

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

     document.getElementById("big_img").src = this.responseText;
    
         	
    }
  };
  xhttp.open("GET", "showpic.php?photo_id="+id, true);
  xhttp.send();
}