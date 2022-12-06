/**
 * create by Zeen Wu
 * on Jun 30, 2022
*/
window.addEventListener("load", startup);

function startup(){
    const xhr_createProduct = new XMLHttpRequest();
    xhr_createProduct.open("get", PATH + "/api/category/getcategories.php", true);
    xhr_createProduct.send();

    xhr_createProduct.onload = function() {
        const list = JSON.parse(this.responseText);
        addCateOption(list);
        document.getElementById("cid").addEventListener('change', setCid);
    }

    let query = window.location.search.substring(1);
    let msg = "";
    switch(query) {
        case "1":
            msg = "Product created successfully.";
        break;
        case "2":
            msg = "File is not an image.";
        break;
        case "3":
            msg = "Sorry, file already exists.";
        break;
        case "4":
            msg = "Sorry, your file is too large.";
        break;
        case "5":
            msg = "Sorry, there was an error uploading your file.";
        break;
        default:
          // code block
      };

    if(msg!=""){
        alert(msg);
        msg = "";
        location.replace("createproduct.html");
    }

}

function reset(){
    sessionStorage.setItem("m_pid", null);
    location.reload();
}

function setCid(){
    let elmSelect = document.getElementById("cid");
    let value = elmSelect.options[elmSelect.selectedIndex].value;
    document.getElementById("cid_num").value = value;
}

function addCateOption(list){
    elmSelect = document.getElementById("cid");
    for(let i = 0; i < list.length; i++) {
        let opt = document.createElement('option');
        opt.value = list[i]["cate_id"];
        opt.innerHTML = list[i]["category"];
        elmSelect.appendChild(opt);
    }
}




