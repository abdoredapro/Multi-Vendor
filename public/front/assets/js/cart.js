let myparent = document.querySelector('.cart-single-list');

if(myparent != null) {

    let cart_item = document.querySelector('.item-quantity');

    cart_item.onchange = function () {

        let cart = cart_item.getAttribute('data-id');
        let url = `/cart/${cart}`;

        let request = new XMLHttpRequest();
        request.onreadystatechange = function () {
        }
        request.open('PUT',url);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.setRequestHeader("X-CSRF-TOKEN", csrf_token);
        request.send(`quantity=${cart_item.value}`);
    
    }



    let removeItem = document.querySelector('.remove-item');


    removeItem.onclick = function () {
    
        let removeId = removeItem.getAttribute('data-id');
        let reqUrl = `/cart/${removeId}`;
    
        let request = new XMLHttpRequest();
    
        request.onreadystatechange = function () {
            if(request.status == 200 && request.readyState == 4) {
                let product = document.getElementById(`${removeId}`);
                product.remove();
            }
        }
        request.open('DELETE',reqUrl);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.setRequestHeader("X-CSRF-TOKEN", csrf_token);
        request.send();
    
    }



}

    












