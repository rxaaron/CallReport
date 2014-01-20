document.getElementById('category').addEventListener('change',SubCatFill);

function SubCatFill(){
    var xmlhttp;
    xmlhttp=new XMLHttpRequest();
    xmlhttp.open('POST','scripts/subcatlist.php',false);
    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    var cat = document.getElementById('category').value;
    var subcat = document.getElementById('subcategory');
    if(cat==='0'){
        subcat.disabled=true;
        subcat.innerHTML='<option value="0">Select Category First</option>';
    }else{
        xmlhttp.send('category='+cat);
        subcat.innerHTML=xmlhttp.responseText;
        subcat.disabled=false;
        return false;
    }
}