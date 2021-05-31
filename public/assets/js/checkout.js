var App_checkout = (function () {

var session_id; 

	var set_session_payment = function(){

		$.ajax({
			url: BASE_URL + 'pagar/pag_seguro_session_id',
			dataType: 'json',
			success: function(response){
				if (response.erro == 0){
					 session_id = response.session_id;

					alert("sessoion_id inicial = " + session_id);

					if (session_id){
						PagSeguroDirectPayment.session_id = session_id;
					}else{
						window.location.href = BASE_URL + 'checkout';
					}
				}else {
					console.log(response.mensagem);
				}
			},
			error: function(){
				alert('Não foi possível realizar a integração com o PagSeguro');
			}
		});
	}

	var calcula_frete = function () {
		$("#btn-busca-cep").on("click", function () {
			var cliente_cep = $("#cliente_cep").val();

			$.ajax({
				type: "post",
				url: BASE_URL + "checkout/calcula_frete",
				dataType: "json",
				data: {
					cliente_cep: cliente_cep,
				},
				beforeSend: function () {
					
					$("#btn-busca-cep").html(
						'<span class="text-white"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>'
					);
				},
			}).then(function (response) {
				if (response.erro === 0) {
					$('.endereco').removeClass('d-none');
					$("#retorno-frete").html(response.retorno_endereco);
					$("#btn-busca-cep").html("Calcular Frete");

					$('[name="cliente_endereco"]').val(response.endereco);
					$('[name="cliente_bairro"]').val(response.bairro);
					$('[name="cliente_cidade"]').val(response.cidade);					

					$("#erro_frete").html('');
					get_opcao_frete_carrinho();
				} else {
					$("#btn-busca-cep").html("Calcular Frete");
					$("#erro_frete").html(response.retorno_endereco);
					$("#retorno-frete").html('');
					$('.endereco').addClass('d-none');
				}
			});
		});
	};

	var get_opcao_frete_carrinho = function () {
		$('[name="opcao_frete_carrinho"]').on("click", function () {
			var opcao_frete_escolhido = $(this).attr("data-valor_frete");
			var total_final_carrinho = $(this).attr("data-valor_final_carrinho");

			$("#opcao_frete_escolhido").html("R$&nbsp;" + opcao_frete_escolhido);
			$("#total_final_carrinho").html("R$&nbsp;" + total_final_carrinho);
		});
	};

	var pagar_boleto = function (){
		
		$('#btn-pagar-boleto').on('click', function(){

			$('[name="hash_pagamento"]').val(PagSeguroDirectPayment.getSenderHash());

			var form = $('.do-payment');

			$.ajax({
				type: 'post',
				url: BASE_URL + 'pagar/boleto',
				dataType: 'json',
				data: form.serialize(),
				beforeSend: function () {
					$("#opcao_boleto").html('<span class="text-info"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>');
					$('#cliente_nome').html('');
					$('#cliente_sobrenome').html('');
					$('#cliente_cpf').html('');
					$('#erro_frete').html('');
					$('#cliente_data_nascimento').html('');
					$('#cliente_email').html('');
					$('#cliente_telefone_movel').html('');
					$('#opcao_frete_carrinho').html('');
					$('#cliente_endereco').html('');
					$('#cliente_numero_endereco').html('');
					$('#cliente_bairro').html('');
					$('#cliente_cidade').html('');
					$('#cliente_estado').html('');
					$('#cliente_senha').html('');
					$('#confirmacao').html('');
				},


				success: function(response){
					if (response.erro == 0){

						window.location = BASE_URL + 'sucesso';
						$("#opcao_boleto").html('');
						
					}else {


						$("#opcao_boleto").html('');

						$('#cliente_nome').html(response.cliente_nome);
						$('#cliente_sobrenome').html(response.cliente_sobrenome);
						$('#cliente_cpf').html(response.cliente_cpf);
						$('#erro_frete').html(response.cliente_cep);
						$('#cliente_data_nascimento').html(response.cliente_data_nascimento);
						$('#cliente_email').html(response.cliente_email);
						$('#cliente_telefone_movel').html(response.cliente_telefone_movel);
						$('#opcao_frete_carrinho').html(response.opcao_frete_carrinho);
						$('#cliente_endereco').html(response.cliente_endereco);
						$('#cliente_numero_endereco').html(response.cliente_numero_endereco);
						$('#cliente_bairro').html(response.cliente_bairro);
						$('#cliente_cidade').html(response.cliente_cidade);
						$('#cliente_estado').html(response.cliente_estado);
						$('#cliente_senha').html(response.cliente_senha);
						$('#confirmacao').html(response.confirmacao);

					}
				},
				error: function(){
					alert('Não foi possível realizar a processar o pagamento');
				}
			});
		});
	}



	var pagar_debito_conta = function (){
		
		$('#btn-debito-conta').on('click', function(){

			$('[name="hash_pagamento"]').val(PagSeguroDirectPayment.getSenderHash());

			var form = $('.do-payment');

			$.ajax({
				type: 'post',
				url: BASE_URL + 'pagar/debito_conta',
				dataType: 'json',
				data: form.serialize(),
				beforeSend: function () {
					$("#opcao_btn_debito_conta").html('<span class="text-info"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>');
					$('#cliente_nome').html('');
					$('#cliente_sobrenome').html('');
					$('#cliente_cpf').html('');
					$('#erro_frete').html('');
					$('#cliente_data_nascimento').html('');
					$('#cliente_email').html('');
					$('#cliente_telefone_movel').html('');
					$('#opcao_frete_carrinho').html('');
					$('#cliente_endereco').html('');
					$('#cliente_numero_endereco').html('');
					$('#cliente_bairro').html('');
					$('#cliente_cidade').html('');
					$('#cliente_estado').html('');
					$('#cliente_senha').html('');
					$('#confirmacao').html('');
				},


				success: function(response){
					if (response.erro == 0){

						window.location = BASE_URL + 'sucesso';
						$("#opcao_btn_debito_conta").html('');
						
					}else {


						$("#opcao_btn_debito_conta").html('');

						$('#cliente_nome').html(response.cliente_nome);
						$('#cliente_sobrenome').html(response.cliente_sobrenome);
						$('#cliente_cpf').html(response.cliente_cpf);
						$('#erro_frete').html(response.cliente_cep);
						$('#cliente_data_nascimento').html(response.cliente_data_nascimento);
						$('#cliente_email').html(response.cliente_email);
						$('#cliente_telefone_movel').html(response.cliente_telefone_movel);
						$('#opcao_frete_carrinho').html(response.opcao_frete_carrinho);
						$('#cliente_endereco').html(response.cliente_endereco);
						$('#cliente_numero_endereco').html(response.cliente_numero_endereco);
						$('#cliente_bairro').html(response.cliente_bairro);
						$('#cliente_cidade').html(response.cliente_cidade);
						$('#cliente_estado').html(response.cliente_estado);
						$('#cliente_senha').html(response.cliente_senha);
						$('#confirmacao').html(response.confirmacao);
						$('#opcao_banco').html(response.opcao_banco);
					}
				},
				error: function(){
					alert('Não foi possível realizar a processar o pagamento');
				}
			});
		});

	};
	

	var pagar_cartao_credito = function (){
		
		$('#btn-pagar-cartao').on('click', function(){

			gerar_token_pagamento();

			$('[name="hash_pagamento"]').val(PagSeguroDirectPayment.getSenderHash());

			var form = $('.do-payment');

			$.ajax({
				type: 'post',
				url: BASE_URL + 'pagar/cartao_credito',
				dataType: 'json',
				data: form.serialize(),
				beforeSend: function () {
					$("#opcao_pagar_cartao").html('<span class="text-info"><i class="fa fa-spinner fa-spin"></i>&nbsp; Processando...</span>');
					$('#cliente_nome').html('');
					$('#cliente_sobrenome').html('');
					$('#cliente_cpf').html('');
					$('#erro_frete').html('');
					$('#cliente_data_nascimento').html('');
					$('#cliente_email').html('');
					$('#cliente_telefone_movel').html('');
					$('#opcao_frete_carrinho').html('');
					$('#cliente_endereco').html('');
					$('#cliente_numero_endereco').html('');
					$('#cliente_bairro').html('');
					$('#cliente_cidade').html('');
					$('#cliente_estado').html('');
					$('#cliente_senha').html('');
					$('#confirmacao').html('');
				},


				success: function(response){

					if (response.erro == 0){

						window.location = BASE_URL + 'sucesso';
						
					}else {

						if (!response.token_pagamento){
							$("#opcao_pagar_cartao").html('<span class="text-danger">Verifique os dados do cartão, e tente novamente</span>');
							gerar_token_pagamento();
						}

						$('#cliente_nome').html(response.cliente_nome);
						$('#cliente_sobrenome').html(response.cliente_sobrenome);
						$('#cliente_cpf').html(response.cliente_cpf);
						$('#erro_frete').html(response.cliente_cep);
						$('#cliente_data_nascimento').html(response.cliente_data_nascimento);
						$('#cliente_email').html(response.cliente_email);
						$('#cliente_telefone_movel').html(response.cliente_telefone_movel);
						$('#opcao_frete_carrinho').html(response.opcao_frete_carrinho);
						$('#cliente_endereco').html(response.cliente_endereco);
						$('#cliente_numero_endereco').html(response.cliente_numero_endereco);
						$('#cliente_bairro').html(response.cliente_bairro);
						$('#cliente_cidade').html(response.cliente_cidade);
						$('#cliente_estado').html(response.cliente_estado);
						$('#cliente_senha').html(response.cliente_senha);
						$('#confirmacao').html(response.confirmacao);
					}
				},
				error: function(){
					alert('Não foi possível realizar a processar o pagamento');
				}
			});
		});

		function gerar_token_pagamento(){
			
			var card_number = $('[name="numero_cartao"]').val();
			if(!card_number){
				$("#numero_cartao").html("Campo obrigatório");
				return false;
			}

			var card_titular = $('[name="cliente_nome_titular"]').val();
			if(!card_titular){
				$("#cliente_nome_titular").html("Campo obrigatório");
				return false;
			}

			var card_expire = $('[name="validade_cartao"]').val();
			if(!card_expire){
				$("#validade_cartao").html("Campo obrigatório");
				return false;
			}else{
				card_expire = card_expire.split('/');

				var mes_expire = card_expire[0];
				var ano_expire = card_expire[1];
			}

			var card_cvv = $('[name="codigo_seguranca"]').val();
			if(!card_cvv){
				$("#codigo_seguranca").html("Campo obrigatório");
				return false;
			}

			var bandeira = "";

			
			card_number = card_number.replace(" ", "");

			var bin = card_number.substr(0,6)

			alert("Cartão: " + card_number);
			alert("Bin: " + bin);

			alert("Session_id = " + session_id);
			 
			
			PagSeguroDirectPayment.getBrand({
			    session_id: session_id,
				cardBin: card_number.replace(" ", ""),

				success: function(response){
					bandeira = response.brand['name'];


					alert("Bandeira: " + response.brand);

					if (bandeira){

						PagSeguroDirectPayment.createCardToken({
							cardNumber: card_number,
							brand: bandeira,
							cvv: card_cvv,
							expirationMonth: mes_expire,
							expirationYear: ano_expire,

							success: function (response){

								alert('Card_Token: ' + response.card.token)

								var token_pagamento = response.card.token;

								if (token_pagamento){
									$("#token_pagamento").val(token_pagamento);
								}else{
									alert('Não foi gerado o token de pagamento para o cartão');
								}
							},
							error: function(response){
								alert('Não foi gerado o token de pagamento para o cartão' + response.message);
							}
						});

					}else{
						alert('Não foi possível gerar a bandeira do cartão' + response.statusMessage)
					}
				},
				error: function (response){
					alert("Deu erro: " + response.message)
				}
			});



		}

	}



	var forma_pagamento = function () {
		$(".forma_pagamento").on("change", function () {
			var opcao = $(this).val();

			switch (opcao) {
				case "1":
					$(".cartao").removeClass("d-none");
					$(".opcao-debito-conta").addClass("d-none");
					$(".opcao-boleto").addClass("d-none");
					$(".cartao input").prop("disabled", false);
					$(".opcao-debito-conta select").prop("disabled", true);
					break;

				case "2":
					$(".cartao").addClass("d-none");
					$(".opcao-boleto").removeClass("d-none");
					$(".opcao-debito-conta").addClass("d-none");
					$(".cartao input").prop("disabled", true);
					$(".opcao-debito-conta select").prop("disabled", true);
					break;

				case "3":
					$(".cartao").addClass("d-none");
					$(".opcao-boleto").addClass("d-none");
					$(".opcao-debito-conta").removeClass("d-none");
					$(".cartao input").prop("disabled", true);
					$(".opcao-debito-conta select").prop("disabled", false);
					break;
				default:
					break;
			}
		});
	};

	return {
		init: function () {
			set_session_payment();
			calcula_frete();
			forma_pagamento();
			pagar_boleto();
			pagar_debito_conta();
			pagar_cartao_credito();
			gerar_token_pagamento();
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

	App_checkout.init();
});
