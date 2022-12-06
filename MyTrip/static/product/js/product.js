/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/

function generateProduct(product) {

    let html ='';
    if (product) {
        html = '<div class="card col-4" ><img src="images/' 
        + product['pic_name'] +'" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title"> ' 
        + product['product_name'] + '</h5><p class="card-text"> Total views: ' 
        + product['views'] + ' <br />price: ' + product['price'] + '</p><div id="div_product'
        + product['product_id'] +'"><a class="btn btn-primary" onclick="setMySession(\'pid\', '
        + product['product_id'] +')" href="detail.html">Check Detail</a></div></div></div>';
    }                           
    return html;
}

const xmlhttp2 = new XMLHttpRequest();
let product = new Product();
product.product.cid = sessionStorage.getItem("cid");
product.getProductByCid(xmlhttp2);
xmlhttp2.onload = function() {
    const prodList = JSON.parse(this.responseText);
    let html = "";
    for(obj of prodList){
      html += generateProduct(obj);
    }
    document.getElementById("productList").innerHTML = html;
    
}