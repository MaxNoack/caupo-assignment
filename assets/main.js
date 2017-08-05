function submitAdd() {
	//Empty messages
	$("#error-sku-field,#error-price-field,#backend-error,#success,#error-empty-fields").hide();

	var name = document.getElementById("name").value;
	var sku = document.getElementById("sku").value;
	var price = document.getElementById("price").value;

	if (name && sku && price) {
		//Validate price and update/create product if ok
		if ($.isNumeric(price)) {
			$.ajax({
				type: "post",
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
					$('#update_button').prop("disabled",false);
					$('#delete_button').prop("disabled",false);
					$('#loader').empty();
					if (data.Error)
					{
						$("#backend-error").show();
						$("#backend-error").html('<p>' + data.info + '</p>')
					}
					else
					{
						$("#name,#sku,#price").val("");
						$("#success").show();
						$("#success").html('<p>' + data.info + '</p>');
					}
				},
				beforeSend: function() {
					$('#update_button').prop("disabled",true);
					$('#delete_button').prop("disabled",true);
					$('#loader').html('<b>Sending request...</b>');
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
	//Empty messages
	$("#error-sku-field,#error-price-field,#backend-error,#success,#error-empty-fields").hide();

	var sku = document.getElementById("sku").value;
	if (sku) {
		$.ajax({
			type: "post",
			url: "controller.php",
			dataType: 'json',
			data: {
				"sku": sku,
				"action_type": "delete_product"
			},
			success: function(data)
			{
				$('#update_button').prop("disabled",false);
				$('#delete_button').prop("disabled",false);
				$('#loader').empty();
				if (data.Error)
				{
					$("#backend-error").show();
					$("#backend-error").html('<p>' + data.info + '</p>')
				}
				else
				{
					$("#name,#sku,#price").val("");
					$("#success").show();
					$("#success").html('<p>' + data.info + '</p>');
				}
			},
			beforeSend: function() {
				$('#update_button').prop("disabled",true);
				$('#delete_button').prop("disabled",true);
				$('#loader').html('<b>Sending request...</b>');
			}
		});
	}
	else
	{
		$("#error-sku-field").toggle();
	}
	return false;
}

