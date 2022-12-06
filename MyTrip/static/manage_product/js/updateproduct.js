/**
 * create by Zeen Wu
 * on Jun 30, 2022
*/
window.addEventListener("load", startup);

function startup(){
    const xhr_updateProduct = new XMLHttpRequest();
    xhr_updateProduct.open("get", PATH + "/api/category/getcategories.php", true);
    xhr_updateProduct.send();

    xhr_updateProduct.onload = function() {
        const list = JSON.parse(this.responseText);
        addCateOption(list);
        document.getElementById("cid").addEventListener('change', setCid);
        if(sessionStorage.getItem('m_pid') != null){
            let m_pid = sessionStorage.getItem('m_pid');
            document.getElementById("product_id").value = m_pid;
            const xhr_getProduct = new XMLHttpRequest();
            xhr_getProduct.open("get", PATH + "/api/product/getproductbypid.php?pid=" + m_pid, true);
            xhr_getProduct.send();
            
            xhr_getProduct.onload = function(){
                let product = JSON.parse(this.responseText);
                document.getElementById("product_name").value=product.product_name;
                document.getElementById("price").value=product.price;
                document.getElementById("description").value=product.description;
            }
        }
    }

    let query = window.location.search.substring(1);
    let msg = "";
    switch(query) {
        case "1":
            msg = "Product update successfully.";
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
        location.replace("updateproduct.html");
    }

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




