<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;

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

                //Planos menores
                $planos = [
                    [   
                        "img" => "icone-posts.png",
                        "titulo" => "Plano X1",
                        "itens" => ["Identidade Visual","Cronograma Mensal","1 Post por semana","4 Posts mensal","Copywriting"],
                        "valor" => "R$ 240,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-posts.png",
                        "titulo" => "Plano X2",
                        "itens" => ["Identidade Visual","Cronograma Mensal","2 Post por semana","8 Posts mensal","Copywriting"],
                        "valor" => "R$ 408,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-posts.png",
                        "titulo" => "Plano X3",
                        "itens" => ["Identidade Visual","Cronograma Mensal","3 Post por semana","12 Posts mensal","Copywriting", "Agendamenteo do Post"],
                        "valor" => "R$ 576,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-posts.png",
                        "titulo" => "Plano X4",
                        "itens" => ["Identidade Visual","Cronograma Mensal","4 Post por semana","16 Posts mensal","Copywriting","Agendamento do Post"],
                        "valor" => "R$ 720,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-posts.png",
                        "titulo" => "Plano X4",
                        "itens" => ["Identidade Visual","Cronograma Mensal","4 Post por semana","16 Posts mensal","Copywriting", "Agendamento do Post", "ADS"],
                        "valor" => "R$ 840,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                ];                     

            }else if($id == "campanha-no-google-ads"){

                //Ativando menu
                $solucoes[1]["active"] = "active";
                $info = [
                    "titulo" => "Campanha no Google Ads",
                    "descricao" => "
                    Se você está precisando <strong>gerar mais contatos</strong> para o seu time de vendas, vender mais e aumentar o número de clientes, as campanhas no Google ADS são perfeitas para conseguir esse feito.<br>
                    Por exemplo, se você é dono de uma pizzaria, quando seus clientes pesquisarem pizzaria no Google, nossas campanhas farão esses clientes encontrarem o seu negócio, e entrarem em contato com a sua empresa.
                    <br><br>
                    Criamos campanhas profissionais no Google ADS, e conseguimos trazer os melhores resultados quando o assunto é marketing de performance.
                    <br><br>
                    Possuímos planos para pequenas, médias e grandes empresas. Não importa o tamanho do seu negócio, anunciar na internet sempre vai ser uma ótima forma de obter bons resultados.
                    ",
                    "capa" => "capa-campanha-no-google-ads.png",
                    "img-exemplo" => [
                        "google-1.png",
                        "google-2.png",
                    ],
                    "destaques" => [
                        "Aumento das suas vendas",
                        "Campanhas de alto desempenho",
                        "Mais acessos ao seu site",
                        "Mais reconhecimento da sua marca",
                        "Campanha direcionada por região",
                        "Sua empresa no Google",
                    ]
                ];

                $planos = [
                    [   
                        "img" => "icone-google.png",
                        "titulo" => "Plano X1",
                        "itens" => ["Indicado para Pequenas Empresas", "1 campanha","12 Manutenções","1 Relatório Mensal","Valor de ADS não incluso*"],
                        "valor" => "R$ 250,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-google.png",
                        "titulo" => "Plano X2",
                        "itens" => ["Indicado para Médias Empresas", "3 campanhas","12 Manutenções","1 Relatório Mensal","Valor de ADS não incluso*"],
                        "valor" => "R$ 500,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-google.png",
                        "titulo" => "Plano X3",
                        "itens" => ["Indicado para Grandes Empresas", "5+ campanhas","12 Manutenções","1 Relatório Mensal","Reunião de alinhamento mensal","Valor de ADS não incluso*"],
                        "valor" => "R$ 900,00*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                ];                    
            }else if($id == "artes-digital"){

                //Ativando menu
                $solucoes[2]["active"] = "active";
                $info = [
                    "titulo" => "Artes Digital",
                    "descricao" => "<strong>Uma imagem vale mais que mil palavras</strong>, certamente você já escutou essa frase e ela é verdade.
                    <br>
                    O que chama atenção primeiro das pessoas é as imagens, e após isso o texto, sendo assim oferecemos criação de artes digital de qualidade.
                    <br>
                    Criamos artes digitais como:",
                    "capa" => "capa-artes-digital.png",
                    "img-exemplo" => [
                        "artes-digital-1.png",
                        "artes-digital-2.png",
                        "artes-digital-3.png",
                        "artes-digital-4.png",
                        "artes-digital-5.png",
                        "artes-digital-6.png",
                        "artes-digital-7.png",
                        "artes-digital-8.png",
                    ],
                    "destaques" => [
                        "catálogo em PDF para equipe comercial",
                        "cardápios",
                        "logomarcas",
                        "cartão de visita digital",
                        "banners para sites",
                        "cartão com qrcode",
                        "propaganda para whatsapp",
                        "flyers digital",
                        "E muito mais",
                    ]
                ];

                $planos = null;  
            }

            $seo = [
                "titulo" => Seo::title($info["titulo"]." - ".config("j6.cliente")),
                "descricao" => Seo::metadescription($info["descricao"]),
            ];
            
            return view("templates.inovex.solucoes-single", [
                "solucoes" => $solucoes,
                "info" => $info,
                "seo" => $seo,
                "planos" => $planos,
            ]);
        }
    }
}
