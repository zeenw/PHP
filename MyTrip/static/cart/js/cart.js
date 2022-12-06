/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/

function generateProduct(product) {

    let html ='';
    if (product) {
        html = '<div class="card col-4" ><img src="../product/images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><p class="card-text"> Total views: ' 
        + product['views'] + ' <br />price: ' + product['price'] + '</p><div><a class="btn btn-primary" onclick="setMySession(\'pid\', '
        + product['product_id'] +')" href="../product/detail.html">Check Detail</a></div> <hr><div class="input-group mb-3"><span class="input-group-text">Quantity</span><input id="i_quantity'
        + product['cart_id'] +'" class="form-control" type="number" value="'
        + product['quantity'] +'"> <button class="btn btn-outline-success" type="button" onclick="updateQuantity(this.value)" value="'
        + product['cart_id'] + '">Update </button><button class="btn btn-outline-success" id="btn_del" type="button" onclick="deleteCartById(this.value)" value="'
        + product['cart_id'] + '">Delete </button></div></div></div>';
    }                           
    return html;
}


function deleteCartById(id){
    const xhr_deleteCartById = new XMLHttpRequest();
    xhr_deleteCartById.open("get", PATH + "/api/cart/deletecartbyid.php?cart_id="+id, true);
    xhr_deleteCartById.send();
    location.reload();
}

function updateQuantity(id){
    let quantity = document.getElementById("i_quantity"+id).value;
    const xhr_updateQuantity = new XMLHttpRequest();
    xhr_updateQuantity.open("get", PATH + "/api/cart/updatequantity.php?cart_id="+id+"&quantity="+quantity, true);
    xhr_updateQuantity.send();
    location.reload();

}

const xmlhttp2 = new XMLHttpRequest();
let login = JSON.parse(sessionStorage.getItem("login"));
let product = new Product();
product.product.id = login.obj.user_id;
product.getProductByUid(xmlhttp2);
xmlhttp2.onload = function() {
    const prodList = JSON.parse(this.responseText);
    let html = "";
    for(obj of prodList){
      html += generateProduct(obj);
    }
    if(html==""){
        document.getElementById("a_payment1").style.display="none";
        document.getElementById("a_payment2").style.display="none";
    }else{
        document.getElementById("productList").innerHTML = html;
    }
    
}