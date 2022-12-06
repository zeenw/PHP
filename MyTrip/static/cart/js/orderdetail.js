/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/

function generateProduct(product) {
    let total = 0;
    let html ='';
    if (product) {
        html = '<div class="card col-4" ><img src="../product/images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><hr><p class="card-text"><b>Price: ' + product['price'] + '</b><br /><b>Quantity: '
        + product['quantity'] +' </b><br /><b>Total: $'+ product['price'] * product['quantity'] +'</b></p></div></div>';
    }         
                 
    return html;
}

function calculate(){

}

function deleteCartById(id){
    const xhr_deleteCartById = new XMLHttpRequest();
    xhr_deleteCartById.open("get", PATH + "/api/cart/deletecartbyid.php?cart_id="+id, true);
    xhr_deleteCartById.send();
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
    let total = 0;

    for(product of prodList){

        if (product) {
            html += '<div class="card col-4" ><img src="../product/images/' 
            + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
            + product['product_name'] + '</h5><hr><p class="card-text"><b>Price: ' + product['price'] + '</b><br /><b>Quantity: '
            + product['quantity'] +' </b><br /><b>Total: $'+ product['price'] * product['quantity'] +'</b></p></div></div>';
        }  
        total += product['price'] * product['quantity'];
    }

    html+="<div><br /><br /><br /><p><b>Subtotal: $" + total + "</b></p><hr></div>";
    document.getElementById("productList").innerHTML = html;
    document.getElementById("uid").value = login.obj.user_id;

}