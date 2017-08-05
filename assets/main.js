function submitForm(action) 
{
	$("#error-all-fields,#error-sku-field,#error-price-field,#error-message,#success-message").hide();

	// Get values from inputs
	var name = document.getElementById("name").value;
	var sku = document.getElementById("sku").value;
	var price = document.getElementById("price").value;
	
	// All fields required except if we're going to delete, then sku is enough
	if ((name && sku && price && action) || (action == 'delete' && sku))
	{
		if ($.isNumeric(price) || action == 'delete') // Validate so price is a number (not needed for delete)
		{
			// Post to main.php with ajax and wait for response
			$.ajax({
				type: "POST",
				url: "main.php",
				dataType: 'json',
				data: {
					"name": name,
					"sku": sku,
					"price": price,
					"action": action
				},
				success: function(data) 
				{
					if (data.isError == '1') 
					{
						$("#error-message").show();
						$("#error-message").html('<p>' + data.message + '</p>')

					} 
					else 
					{
						$("#name,#sku,#price").val("");

						$("#success-message").show();
						$("#success-message").html('<p>' + data.message + '</p>');

					}
				}});
		}
		else
		{
			// Price is not a valid number
			$("#error-price-field").toggle();
		}
	} 
	else 
	{
		if (action == 'delete') // SKU required error
		{
			$("#error-sku-field").toggle();
		}
		else // All fields error
		{
			$("#error-all-fields").toggle();
		}
	}  
	return false;
}

function submitAdd() {
	$("#error-sku-field,#error-price-field,#backend-error,#success,#error-empty-fields").hide();

	var name = document.getElementById("name").value;
	var sku = document.getElementById("sku").value;
	var price = document.getElementById("price").value;

	if (name && sku && price) {
		if ($.isNumeric(price)) {
			$.ajax({
				type: "POST",
				url: "controller.php",
				dataType: 'json',
				data: {
					"name": name,
					"sku": sku,
					"price": price,
					"action_type": "add_product"
				},
				cache: false,
				success: function(data)
				{
					if (data.Error)
					{
						$("#backend-error").show();
						$("#backend-error").html('<p>' + data.error_string + '</p>')

					}
					else
					{
						$("#name,#sku,#price").val("");
						$("#success").show();
						$("#success").html('<p>' + data.error_string + '</p>');
					}
				}
			});
		}
		else
		{
			$("#error-price-field").toggle();
		}
	}
	else
	{
		$("#error-empty-fields").toggle();
	}
	return false;

}

function submitDelete() {
	$("#error-sku-field,#error-price-field,#backend-error,#success,#error-empty-fields").hide();

	var sku = document.getElementById("sku").value;

	if (sku) {
		$.ajax({
			type: "POST",
			url: "controller.php",
			dataType: 'json',
			data: {
				"sku": sku,
				"action_type": "delete_product"
			},
			cache: false,
			success: function(data)
			{
				if (data.isError == '1')
				{
					$("#backend-error").show();
					$("#backend-error").html('<p>' + data.message + '</p>')

				}
				else
				{
					$("#name,#sku,#price").val("");
					$("#success").show();
					$("#success").html('<p>' + data.message + '</p>');
				}
			}
		});
	}
	else
	{
		$("#error-sku-field").toggle();
	}
	return false;

}

