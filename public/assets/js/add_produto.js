var App = (function () {
	var calcula_frete = function () {
		$("#btn-calcula-frete").on("click", function () {
			var produto_id = $(this).attr("data-id");
			var cep = $("#cep").val();

			$.ajax({
				type: "post",
				url: BASE_URL + "ajax/index",
				dataType: "json",
				data: {
					cep: cep,
					produto_id: produto_id,
				},
				beforeSend: function () {
					$("#btn-calcula-frete").html(
						'<span class="text-white"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>'
					);
				},
			}).then(function (response) {
				$("#frete").html(response.retorno_endereco);
				$("#btn-calcula-frete").html("Calcular");
			});
		});
	};

	var add_item_cart = function () {
		$(".btn-add-produto").on("click", function () {
			var produto_id = $(this).attr('data-id');
			var produto_quantidade = $('#produto-quantidade').val();

			$.ajax({
				type: "post",
				url: BASE_URL + "carrinho/insert",
				dataType: "json",
				data: {
					produto_id: produto_id,
					produto_quantidade: produto_quantidade,
				},
				beforeSend: function () {
					$(".btn-add-produto").html(
						'<span class="text-white"><i class="fa fa-spinner fa-spin"></i>&nbsp; Adicionando...</span>'
					);
				},
			}).then(function (response) {
				
				$('#top-cart').load(' #top-cart > *');
				$('#list-itens').load(' #list-itens > *');

				$(".btn-add-produto").html("Adicionar");
				$('#mensagem').html('<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">' + response.mensagem + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span></button></div>');
			});

		});
	};

	return {
		init: function () {
			calcula_frete();
			add_item_cart();
		},
	};
})(); //inicializa ao carregar

jQuery(document).ready(function () {
	$(window).keydown(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	App.init();
});
