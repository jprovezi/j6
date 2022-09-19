<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {

        $clientes = [
            [
                "nome" => "Alux Pro Sports",
                "img" => "alux.png",
            ],
            [
                "nome" => "MMReefer",
                "img" => "mmreefer.png",
            ],
            [
                "nome" => "Andiara Advogada",
                "img" => "andiara-advogada.png",
            ],
            [
                "nome" => "Postos Meta",
                "img" => "postos-meta.png",
            ],
            [
                "nome" => "Unikinder Clínica Pediatrica",
                "img" => "unikinder.png",
            ],
            [
                "nome" => "Capital Container",
                "img" => "capital-container.png",
            ],
            [
                "nome" => "King Mix",
                "img" => "king-mix.png",
            ],
            [
                "nome" => "Clínica de Análise LabTess",
                "img" => "labtess.png",
            ],
            [
                "nome" => "Imobiliária Mauro Imóveis",
                "img" => "mauro-imoveis.png",
            ],
            [
                "nome" => "Schwanke Casa",
                "img" => "schwanke-casa.png",
            ]
        ];
        
        //Lista de depoimentos
        $depoimentos = [
            [
                "nome" => "Jean Capital Container",
                "depoimento" => "Tive a oportunidade de ser atendido pelo profissional da J6 no passado, realmente sempre se dedicaram a
                um trabalho de qualidade e compromisso.",
            ],
            [
                "nome" => "Michele Alux",
                "depoimento" => "A J6 foi a empresa que depois de muito tempo, me apresentou serviços de extrema qualidade a um ótimo custo benefício. Obrigado a todos!",
            ],
            [
                "nome" => "Miriam Batisti Estética",
                "depoimento" => "Criamos a nossa logo com eles, e fechamos um pacote de postagens para redes sociais. Desde da reunião inicial sempre foram muito profissionais em tudo.",
            ],
            [
                "nome" => "Tiago Atr Refrigeração",
                "depoimento" => "Nosso primeiro site foi feito pela J6, ficou incrível bonito, em breve iremos realizar mais trabalhos juntos. Obrigado a todos os envolvidos.",
            ],
            [
                "nome" => "Sérgio MMReefer",
                "depoimento" => "Eles criaram o nosso website, e nossas campanhas no google. Com o trabalho da J6 nosso faturamento dobrou no último semestre.",
            ],
        ];        

        return view("templates.inovex.home", [
            "clientes" => $clientes,
            "depoimentos" => $depoimentos,
        ]);
    }
}
