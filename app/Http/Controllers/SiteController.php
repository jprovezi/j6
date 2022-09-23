<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

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

        //Perguntas e Respostas
        $duvidas = [
            [
                "pergunta" => "Quanto custa um pacote de postagens para redes sociais?",
                "resposta" => "Temos planos à partir de R$240,00 mensal.",
                "active" => "active",
            ],
            [
                "pergunta" => "Vocês gerenciam a rede social da nossa empresa?",
                "resposta" => "Sim, temos planos para a gestão das redes sociais completo.",
                "active" => "",
            ],
            [
                "pergunta" => "Vocês entregam o projeto do site pronto?",
                "resposta" => "Sim, todos as nossas soluções de sites são entregues 100% prontos para o cliente, junto com o treinamento da ferramenta.",
                "active" => "",
            ],
            [
                "pergunta" => "O que é SiteExress?",
                "resposta" => "SiteExpress, é uma ferramenta que desenvolvemos para as empresas terem sites extremamentes profissionais, a um custo acessível de mercado",
                "active" => "",
            ],
            
        ];

        //Lista de serviços
        $solucoes = [
            [
                "titulo" => "Posts Para Redes Sociais",
                "descricao" => "Criamos postagens profissionais para as redes sociais da sua empresa. Deixe seu feed com uma melhor apresentação.",
                "img" => "service-i-1.png",
                "url-single" => "solucoes/posts-para-redes-sociais",
            ],
            [
                "titulo" => "Campanhas no Google ADS",
                "descricao" => "Para o seu site aparecer na primeira página do Google, quando um cliente pesquisar sobre o seu negócio.",
                "img" => "service-i-2.png",
                "url-single" => "solucoes/campanha-no-google-ads",
            ],
            [
                "titulo" => "Artes Digital",
                "descricao" => "Comunicação visual de qualidade, como logomarcas, apresentações em PDF, Catálogos Online e muito mais.",
                "img" => "service-i-3.png",
                "url-single" => "solucoes/artes-digital",
            ],
            [
                "titulo" => "Site Express",
                "descricao" => "Sites profissionais com ótimo custo benefício, nossa solução express poderá atender a sua empresa.",
                "img" => "service-i-4.png",
                "url-single" => "solucoes/site-express",
            ],
            [
                "titulo" => "Site Personalizado",
                "descricao" => "Sites com qualidade excepcional para clientes que necessitam de algo único e inesquecível.",
                "img" => "service-i-5.png",
                "url-single" => "solucoes/site-personalizado",
            ],
        ];
        
        return view("templates.inovex.home", [
            "clientes" => $clientes,
            "depoimentos" => $depoimentos,
            "duvidas" => $duvidas,
            "solucoes" => $solucoes,
        ]);
    }

    public function sobre()
    {
        return view("templates.inovex.sobre");
    }

    public function solucoes($id = "")
    {

        //Lista de serviços
        $solucoes = [
            [
                "titulo" => "Posts Para Redes Sociais",
                "descricao" => "Criamos postagens profissionais para as redes sociais da sua empresa. Deixe seu feed com uma melhor apresentação.",
                "img" => "service-i-1.png",
                "url-single" => config("app.url")."/solucoes/posts-para-redes-sociais",
                "active" => "",
            ],
            [
                "titulo" => "Campanhas no Google ADS",
                "descricao" => "Para o seu site aparecer na primeira página do Google, quando um cliente pesquisar sobre o seu negócio.",
                "img" => "service-i-2.png",
                "url-single" => config("app.url")."/solucoes/campanha-no-google-ads",
                "active" => "",
            ],
            [
                "titulo" => "Artes Digital",
                "descricao" => "Comunicação visual de qualidade, como logomarcas, apresentações em PDF, Catálogos Online e muito mais.",
                "img" => "service-i-3.png",
                "url-single" => config("app.url")."/solucoes/artes-digital",
                "active" => "",
            ],
            [
                "titulo" => "Site Express",
                "descricao" => "Sites profissionais com ótimo custo benefício, nossa solução express poderá atender a sua empresa.",
                "img" => "service-i-4.png",
                "url-single" => config("app.url")."/solucoes/site-express",
                "active" => "",
            ],
            [
                "titulo" => "Site Personalizado",
                "descricao" => "Sites com qualidade excepcional para clientes que necessitam de algo único e inesquecível.",
                "img" => "service-i-5.png",
                "url-single" => config("app.url")."/solucoes/site-personalizado",
                "active" => "",
            ],
        ];

        if( empty($id) ){

            //Planos menores
            $planosMenores = [
                [   
                    "img" => "service-i-1.png",
                    "titulo" => "Post para redes sociais X1",
                    "itens" => ["Identidade Visual","Cronograma Mensal","1 Post por semana","4 Posts mensal","Copywriting"],
                    "valor" => "R$ 240,00*",
                    "url" => config("app.url")."/solucoes/posts-para-redes-sociais",
                ],
                [   
                    "img" => "service-i-2.png",
                    "titulo" => "Campanha no Google ADS X1",
                    "itens" => ["Análise de concorrentes","1 campanha","12 Manutenções","1 Relatório Mensal","Valor de ADS não incluso*"],
                    "valor" => "R$ 250,00*",
                    "url" => config("app.url")."/solucoes/campanha-no-google-ads",
                ],
                [   
                    "img" => "service-i-3.png",
                    "titulo" => "Artes Digital",
                    "itens" => ["Banners para sites","Cartões de visitas virtuais","Logomarcas","Catálogo de produtos em PDF","Cardápio para restaurantes"],
                    "valor" => "R$ 80,00*",
                    "url" => config("app.url")."/solucoes/artes-digital",
                ],
            ];            


            return view("templates.inovex.solucoes",[
                "solucoes" => $solucoes,
                "planosMenores" => $planosMenores,
            ]);

        }else{

            //Verificando id passado
            if($id == "posts-para-redes-sociais"){
                //Ativando menu
                $solucoes[0]["active"] = "active";
                $info = [
                    "titulo" => "Posts para redes sociais",
                    "descricao" => "Criamos postagens profissionais para redes sociais da sua empresa, desde da criação da arte até o texto do mesmo (copywriting).<br><br>
                    Tudo se inicia com o cliente escolhendo um plano, 
                    após isso vamos iniciar com o briefing, criamos o cronograma das postagens, claro sempre seguindo a melhor estratégia de mkt digital. <br>Após setado o cronograma iniciamos as postagens 
                    das redes sociais.<br><br>
                    A recorrência de postagens profissionais, faz o feed ficar mais bonito, entendível e potencializa a marca e o marketing da sua empresa. Hoje a j6 Soluções Digitais, tem planos para atender 
                    desde pequenos negócios a grandes empresas.",
                    "capa" => "capa-posts-redes-sociais.png",
                    "img-exemplo" => [
                        "post-1.png",
                        "post-2.png",
                        "post-3.png",
                        "post-4.png",
                    ],
                    "destaques" => [
                        "Postagens Semanal",
                        "Artes Profissionais",
                        "Textos chamativos das postagens",
                        "Criação do cronograma",
                        "Estratégia de Mkt Digital",
                    ]
                ];
            }
            

            return view("templates.inovex.solucoes-single", [
                "solucoes" => $solucoes,
                "info" => $info,
            ]);
        }
    }
}
