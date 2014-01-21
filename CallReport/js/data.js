document.getElementById('category').addEventListener('change',SubCatFill);
document.getElementById('calldata').addEventListener('submit',VerifyInput,false);
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
};

function VerifyInput(e){
    var nh = document.getElementById('nursinghome');
    var rph = document.getElementById('rph');
    var category = document.getElementById('category');
    var subcategory = document.getElementById('subcategory');
    var detail = document.getElementById('detail');
    
    if(nh.value==='0'){
        var classes = nh.className;
        nh.className = classes + ' highlight-field';
        alert('Please select a Nursing Home.');
        e.preventDefault();
        return false;
    }else if(rph.value==='0'){
        var classes = rph.className;
        rph.className = classes + ' highlight-field';
        alert('Please select a Pharmacist.');
        e.preventDefault();
        return false;
    }else if(category.value==='0'){
        var classes = category.className;
        category.className = classes + ' highlight-field';
        alert('Please select a Category.');
        e.preventDefault();
        return false;    
    }else if(subcategory.value==='0'){
        var classes = subcategory.className;
        subcategory.className = classes + ' highlight-field';
        alert('Please select a Subcategory.');
        e.preventDefault();
        return false;    
    }else if(detail.value===''){
        var classes = detail.className;
        detail.className = classes + ' highlight-field';
        alert('Please enter Details.');
        e.preventDefault();
        return false;        
    }else{
        return true;
    }
};