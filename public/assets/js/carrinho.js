var App_carrinho = (function () {
	var del_item_carrinho = function () {
		$(".btn-del-item").on("click", function () {
			var produto_id = $(this).attr("data-id");

			$.ajax({
				type: "post",
				url: BASE_URL + "carrinho/delete",
				dataType: "json",
				data: {
					produto_id: produto_id,
				},
			}).then(function (response) {
				if (response.erro === 0) {
					$(this).parent().parent().remove();
					window.location.href = BASE_URL + "carrinho";
				} else {
					alert("Erro ao excluir o produto do carrinho");
				}
			});
		});
	};

	var altera_quantidade_carrinho = function () {
		$(".btn-altera-quantidade").on("click", function () {
			var produto_id = $(this).attr("data-id");
			var produto_quantidade = $("#produto_" + produto_id).val();

			//alert(produto_id + ' -- ' + produto_quantidade);

			if (produto_quantidade == "" || produto_quantidade < 1) {
				$("#mensagem").html(
					'<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">Informe uma quantidade maior que zero<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span></button></div>'
				);
			} else {
				$.ajax({
					type: "post",
					url: BASE_URL + "carrinho/update",
					dataType: "json",
					data: {
						produto_id: produto_id,
						produto_quantidade: produto_quantidade,
					},
				}).then(function (response) {
					if (response.erro === 0) {
						window.location.href = BASE_URL + "carrinho";
					} else {
						$("#mensagem").html(
							'<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">' +
								response.mensagem +
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria-hidden="true">&times;</span></button></div>'
						);
					}
				});
			}
		});
	};

	var limpar_carrinho = function () {
		$(".btn-limpar-carrinho").on("click", function () {
			$.ajax({
				type: "post",
				url: BASE_URL + "carrinho/limpar",
				dataType: "json",
				data: {
					limpar: true,
				},
			}).then(function (response) {
				if (response.erro === 0) {
					$("#frete").html(response.retorno_endereco);
				} else {
					//erro de formatação ou de validação
				}
			});
		});
	};

	var calcula_frete = function () {
		$("#btn-calcula-frete-carrinho").on("click", function () {
			var cep = $("#cep").val();

			$.ajax({
				type: "post",
				url: BASE_URL + "carrinho/calcula_frete",
				dataType: "json",
				data: {
					cep: cep,
				},
				beforeSend: function () {
					$("#btn-calcula-frete-carrinho").html(
						'<span class="text-white"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>'
					);
				},
			}).then(function (response) {
				if (response.erro === 0){
				$("#frete").html(response.retorno_endereco);
				get_opcao_frete_carrinho();
				$("#btn-calcula-frete-carrinho").html("Calcular Frete");
				}else{
					$("#frete").html(response.retorno_endereco);
				}

			});
		});
	};

	var get_opcao_frete_carrinho = function(){
		$('[name="opcao_frete_carrinho"]').on('click', function(){
			var opcao_frete_escolhido = $(this).attr('data-valor_frete');
			var total_final_carrinho = $(this).attr('data-valor_final_carrinho');

			$('#opcao_frete_escolhido').html('R$&nbsp;' + opcao_frete_escolhido);
			$('#total_final_carrinho').html('R$&nbsp;' + total_final_carrinho);
		});
	}

	return {
		init: function () {
			del_item_carrinho();
			altera_quantidade_carrinho();
			limpar_carrinho();
			calcula_frete();
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

	App_carrinho.init();
});
