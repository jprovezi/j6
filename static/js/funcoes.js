function abrirModalDocumento(urlServidor) {
    //Criando requisição para o server
    $.ajax({
        url: urlServidor,
        cache: false,
        dataType: "json",
        success: function (e) {
            
            //alterando informações do modal
            $("#titulo-modal").html(e.titulo);
            $("#documento-modal").html(e.documento);
            $("#galeria-modal").html(e.galeria);
            $('#href-modal').attr('href', e.editar);

            //Abrindo o modal
            $('#modal-documento').modal('show');

        },
    });
}


function gravarNotificacao(urlServidor, id) {
    //Criando requisição para o server
    $.ajax({
        url: urlServidor + "/" + id,
        type: "GET",
        cache: false,
        dataType: "json",
        success: function (e) {

            //alterando valor da notificacao
            $("#notificacaoNumerica").html(e.totalNotificacoes);

            //alterando status para aberta
            $("#in-" + id).removeClass("bg-info").addClass("bg-grey");
            
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
 * Redireciona o usuário para outra página
 * @param {string} url
 * @returns {void:0}
 */
function redir(url) {
    window.location.href = url;
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
 * Função para requisição Ajax via formulário
 * @param {*} idForm id do form
 * @param {*} urlServidor string da url do server backend
 * @param {*} image false se nao tiver form de imagem
 * @param {*} nomeBotao Nome do botão se for diferente de salvar
 * @param {*} textoWysiwyg true se texto com editor Wysiwyg
 */
function formSubmit(idForm, urlServidor, image = true, nomeBotao = "Salvar", textoWysiwyg = false) {
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
    $(idForm + " input[type='number'], input:text, input:hidden, input:password, select, input:checked, textarea").each(function () {
        data.append($(this).attr('name'), $(this).val());
    });

    //Se tiver editor MCE na página
    if(textoWysiwyg == true){
        data.append('texto', tinyMCE.get('texto').getContent());
    }


    //Desabilita botão
    $("#bt-salvar").attr("disabled", true);
    $("#bt-salvar").css({ 'cursor': 'default' });

    //Muda ícone botão
    $("#bt-salvar").html("Aguarde <i class='mdi mdi-loading mdi-spin'></i>");


    //Criando requisição para o server
    $.ajax({
        url: urlServidor,
        method: "post",
        processData: false,
        contentType: false,
        data: data,
        dataType: "json",
        success: function (e) {

            //Habilita botão
            $("#bt-salvar").attr("disabled", false);
            $("#bt-salvar").css({ 'cursor': 'pointer' });

            //Muda ícone botão
            $("#bt-salvar").html(nomeBotao+" <i class='mdi mdi-check'></i>");

            //Mensagem cliente de Sucesso
            if (e.tipo == "sucesso") {

                //Mensagem para o usuário
                $("#resposta-form").html(
                    "<div class='alert alert-dismissible alert-success fade show'>" +
                    "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
                    e.mensagem +
                    "</div>"
                );

                //Ação da página
                if (e.acaoForm == "reset") {
                    $(idForm)[0].reset();
                } else if (e.acaoForm == "reload") {
                    location.reload();
                } else if (e.acaoForm == "redir") {
                    redir(e.url);
                }

            }

            //Mensagem cliente de Error
            if (e.tipo == "error") {
                //Mensagem cliente
                $("#resposta-form").html(
                    "<div class='alert alert-dismissible alert-danger fade show'>" +
                    "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
                    e.mensagem +
                    "</div>"
                );
            }

        },
        error: function (request, status, error) {
            window.alert(request.responseText);
        }
    });

}

/**
 * Ativa ou desativa um registro na tabela
 * @param {string} urlServidor 
 */
function ativarRegistro(urlServidor) {
    $.ajax({
        url: urlServidor,
        success: function (e) {
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

/**
 * chama o controlador e salva a nova capa selecionada no banco, e recarrega a page
 * @param {string} urlControlador
 * @returns {void}
 */
function excluirTodasFotosGaleria(urlControlador) {
    var escolhaUsuario = confirm("Deseja realmente remover todas as fotos?");
    if (escolhaUsuario) {
        $.ajax({
            url: urlControlador,
            success: function (e) {
                location.reload();
            }
        });
    }
}


/**
 * remove a linha do html quando exclui um ítem da lista
 * @param {string} urlServer
 * @param {string} idRow
 * @returns {void}
 */
function removerRegistro(urlServer, idRow) {

    var confirmar = confirm("Deseja realmente remover esse registro? Essa ação não poderá ser desfeita.");
    if (confirmar) {

        //Enviando dados para o server
        $.ajax({
            url: urlServer,
            cache: false,
            dataType: "json",
            success: function (e) {

                //Remove a linha da tabela
                var tabela = $("#datatable-buttons").DataTable();
                tabela.row(idRow).remove().draw();
                location.reload();

            },
            error: function (e) {
                window.alert(e.mensagem);
            }
        });

    }

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