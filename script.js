function addToCart(product_id,product_name,product_price) {
	let productId = product_id;
	let productName = product_name;
	let productPrice = product_price;
	let product = {
		"product_id" : productId,
		"product_name" : productName,
		"product_price" : productPrice
	}
	$.ajax({
		url: 'server/controller.php?_page=addToCart',
		type: 'POST',
		dataType : 'json',
		data: product,
	
		success: function (response) {
	      alert(response.message)
	      window.location.reload();
	    },
	    error: function (response) {
	      alert(response.message)
	    }
	})
}