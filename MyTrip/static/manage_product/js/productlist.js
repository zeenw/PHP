/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/

const xmlhttp2 = new XMLHttpRequest();
xmlhttp2.open("get", PATH + "/api/product/getproducts.php", true);
xmlhttp2.send();


xmlhttp2.onload = function() {
    const prodList = JSON.parse(this.responseText);
    let html = "";
    for(obj of prodList){
      html += generateProduct(obj);
    }
    document.getElementById("productList").innerHTML = html;

}

function generateProduct(product) {

    let html ='';
    if (product) {
        html = '<div class="card col-4" ><img src="../product/images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><p class="card-text"> Total views: ' 
        + product['views'] + ' <br />price: ' + product['price'] + '</p><div id="div_product'
        + product['product_id'] +'"><a class="btn btn-primary" onclick="sessionStorage.setItem(\'m_pid\', '
        + product['product_id'] +')" href="updateproduct.html">Edit Details</a></div></div></div>';
    }                           
    return html;

    
}