/**
 * create by Zeen Wu
 * on Jun 27, 2022
*/

class Product {

    constructor(id, pname, cid) {
        this.product = {"id":"","name":"","cid":0};
        this.product.pid = id;
        this.product.name = pname;
        this.product.cid = cid;
        this.jsonObj = JSON.stringify(this.product);
    }

    getProductByCid(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/product/getproductbycid.php?cid=" + this.product.cid, true);
        xmlhttp.send();
    }

    getProductByPid(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/product/getproductbypid.php?pid=" + this.product.pid, true);
        xmlhttp.send();
    }

    getProductByUid(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/product/getproductbyuid.php?uid=" + this.product.id, true);
        xmlhttp.send();
    }

    getCartByUid(xmlhttp) {
        xmlhttp.open("get", PATH + "/api/cart/getcartbyuid.php?uid=" + this.product.id, true);
        xmlhttp.send();
    }


}
