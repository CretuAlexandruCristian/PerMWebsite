document.getElementById('searchProduct').addEventListener("keypress",function (e){
  if(e.key === 'Enter') {
      window.location = "productlist.php?search=" + document.getElementById('searchProduct').value;
  }
});