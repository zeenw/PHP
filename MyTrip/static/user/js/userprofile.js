/**
 * create by Zeen Wu
 * on July 02, 2022
*/
const xhr_user = new XMLHttpRequest();
let login1 = JSON.parse(sessionStorage.getItem("login"));
let user = new User("","",login1.obj.uemail,"");

user.getUserByEmail(xhr_user);

xhr_user.onload = function(){
    const objUser = (JSON.parse(this.responseText)).obj;

    document.getElementById("user_id").value=objUser.user_id;
    document.getElementById("uemail").value=objUser.uemail;
    document.getElementById("fname").value=objUser.fname;
    document.getElementById("lname").value=objUser.lname;
    document.getElementById("phone").value=objUser.phone;

        
    switch(objUser.member_type) {
        case 1:
            document.getElementById("member_type").value = "Member";
            break;
        case 2:
            document.getElementById("member_type").value = "VIP";
            break;
        case -1:
            document.getElementById("member_type").value = "Manager";
            break;
        default:

        }
    
}


const xmlhttp2 = new XMLHttpRequest();
let login = JSON.parse(sessionStorage.getItem("login"));
let product = new Product();
product.product.id = login.obj.user_id;
product.getCartByUid(xmlhttp2);
xmlhttp2.onload = function() {
    const prodList = JSON.parse(this.responseText);
    let html = "";
    for(product of prodList){
        if (product) {
            html += '<div class="card col-4" ><img src="../product/images/' 
            + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
            + product['product_name'] + '</h5><hr><p class="card-text"><b>Price: ' + product['price'] + '</b><br /><b>Quantity: '
            + product['quantity'] +' </b><br /><b>Total: $'+ product['price'] * product['quantity'] +'</b></p><i>'
            + product['order_date'] +'</i></div></div>';
        }  

    }
    document.getElementById("productList").innerHTML = html;

}

function generateProduct(product) {

    let html ='';
    if (product) {
        html = '<div class="card col-4" ><img src="../product/images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><p class="card-text"> Total views: ' 
        + product['views'] + ' <br />price: ' + product['price'] + '</p><div><a class="btn btn-primary" onclick="setMySession(\'pid\', '
        + product['product_id'] +')" href="../product/detail.html">Check Detail</a></div> <hr><div class="input-group mb-3"><span class="input-group-text">Quantity</span><input id="i_p'
        + product['product_id'] +'" class="form-control" type="number" value="'
        + product['quantity'] +'"> <button class="btn btn-outline-success" type="button" onclick="deleteCartById(this.value)" value="'
        + product['cart_id'] + '">Delete </button></div></div></div>';
    }                           
    return html;
}