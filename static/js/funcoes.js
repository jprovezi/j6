function formLogin(urlServidor, idForm) {

    //Criando requisição para o server
    $.ajax({
        url: urlServidor,
        method: "post",
        data: $(idForm).serialize(),
        dataType: "json",
        success: function (e) {

            //Tipo Aviso
            if(e.tipo == "sucess"){
                $(".alert").removeClass('alert-warning').removeClass("alert-danger");
                $(".alert").addClass('alert-info').addClass("show");
                $(".alert-link").html(e.mensagem);
            }
            
            if(e.tipo == "warning"){
                $(".alert").removeClass('alert-info').removeClass("alert-danger");
                $(".alert").addClass('alert-warning').addClass("show");
                $(".alert-link").html(e.mensagem);
            }

            if(e.tipo == "danger"){
                $(".alert").removeClass('alert-info').removeClass("alert-warning");
                $(".alert").addClass('alert-danger').addClass("show");
                $(".alert-link").html(e.mensagem);
            }

            //Ação
            if(e.url != ""){
                window.location.href = e.url;
            }

        },
        error: function (e) {
            $(".alert").removeClass('alert-info').removeClass("alert-warning");
            $(".alert").addClass('alert-danger').addClass("show");
            $(".alert-link").html("Erro no servidor, entre em contato com o suporte");
        }
    });

}

function gravarNotificacao(urlServidor,id){
    //Criando requisição para o server
    $.ajax({
        url: urlServidor+"/"+id,
        type: "GET",
        cache: false,
        dataType: "json",
        success: function (e) {

            //alterando valor da notificacao
            $("#notificacaoNumerica").html(e.totalNotificacoes);

            //Removendo sinal vermelho se nao ouver not
            if(e.totalNotificacoes <= 0){
                $(".badge").removeClass("badge-danger");
            }

            //alterando status para aberta
            $("#in-"+id).removeClass("bg-info").addClass("bg-grey");
        },
    });
}



/**
 * Redireciona a url com o evento do ENTER
 * @param {string} url
 * @param {string} id
 * @returns {void}
 */
function redirEnter(url, id) {
    $(id).on('keydown', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            window.location.href = url;
        }
    });
}

/**
 * remove a linha do html quando exclui um ítem da lista
 * @param {string} urlServer
 * @param {string} idRow
 * @returns {void}
 */
function removerRegistro(urlServer, idRow) {
    //Enviando dados para o server
    $.ajax({
        url: urlServer,
        cache: false,
        dataType: "json",
        success: function (e) {

            //remove linha do html
            $(idRow).remove();

            //Decrementa total registro do dom
            totalRegistro = $(".totalRegistros").html();
            totalRegistro = totalRegistro - 1;
            $(".totalRegistros").html(totalRegistro);

        },
        error: function (e) {
            window.alert(e.mensagem);
        }
    });
}

/**
 * Requisição ajax com opção de enviar arquivos do tipo image
 * @param {string} idForm
 * @param {string} urlServidor
 * @param {bool} image = true
 * @returns {html}
 */
function formSubmit(idForm, urlServidor, image = true) {
    //Criando obj formDatas
    var data = new FormData();

    //Se tiver imagens no form, ele envia p server
    if (image) {
        //Recebendo dados das imagens selecionadas
        var file_data = $('input[name="foto"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("imagens[]", file_data[i]);
        }
        var foto2 = $('input[name="foto2"]');
        if (foto2.length) {
            foto2 = foto2[0].files;
            for (var i = 0; i < foto2.length; i++) {
                data.append("imagens2[]", foto2[i]);
            }
        }
    }

    //Recebendo dados do form
    $(idForm + " input[type='number'], input:text, input:password, select, input:checked, textarea").each(function () {
        data.append($(this).attr('name'), $(this).val());
    });


    //Criando requisição para o server
    $.ajax({
        url: urlServidor,
        method: "post",
        processData: false,
        contentType: false,
        data: data,
        dataType: "json",
        success: function (e) {

            
            //Mensagem cliente de Sucesso
            if (e.tipo == "sucesso") {

            }

            //Mensagem cliente de Error
            if (e.tipo == "error") {    

            }

        },
        error: function (e) {
            window.alert('Algo aconteceu, entre em contato com o suporte');
        }
    });

}

/**
 * chama o controlador e salva a nova capa selecionada no banco, e recarrega a page
 * @param {string} urlControlador
 * @returns {void}
 */
function salvarCapaGaleria(urlServidor) {
    $.ajax({
        url: urlServidor,
        success: function (e) {
            location.reload();
        }
    });
}

/**
 * chama o controlador e salva a nova capa selecionada no banco, e recarrega a page
 * @param {string} urlControlador
 * @returns {void}
 */
function excluirCapaGaleria(urlControlador) {
    $.ajax({
        url: urlControlador,
        success: function (e) {
            location.reload();
        }
    });
}

function setarCheckbox(selector) {
    if ($("#" + selector).is(":checked")) {
        $("." + selector).prop("checked", true);
    } else {
        $("." + selector).prop("checked", false);
    }
}


function string_to_slug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}


function cadastrarLead(idForm) {

    //Recebendo dados do formulário
    var dados = $(idForm).serialize();

    //Enviando dados para o server
    $.ajax({
        url: SITE_URL + "/index/cadastrar-lead",
        type: "POST",
        data: dados,
        cache: false,
        dataType: "json",
        success: function (data) {
            //msg de sucesso para cliente
            if (data.tipo == "sucesso") {
                $("#mensagemLeads").html(data.mensagem);
            }
            if (data.tipo == "error") {
                $("#mensagemLeads").html(data.mensagem);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}