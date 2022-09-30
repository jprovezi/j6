<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Helpers\Geral;

class SiteController extends Controller
{

    /**
     * Retorna as soluções da empresa
     *
     * @return array
     */
    public function getSolucoes()
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
        return $solucoes;
    }

public function getDuvidas()
{
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
        [
            "pergunta" => "Se eu precisar de uma solução especifica?",
            "resposta" => "Iremos analisar a demanda, e montar uma proposta em cima da necessidade do cliente.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês são uma agência de marketing?",
            "resposta" => "Sim, somos uma agência de marketing digital, focado em soluções digitais. Todos as nossas soluções são criadas a partir de necessidade reais de negócios.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês criam logomarcas?",
            "resposta" => "Temos vários tipos de criações de artes, incluindo as logomarcas. Outas artes que desenvolvemos são: Cardápios, Flyers, Posts, Banners, e qualquer necessidade de arte digital.",
            "active" => "",
        ],
        [
            "pergunta" => "Quero fazer muitos serviços com a empresa, tenho desconto?",
            "resposta" => "Quando o cliente tem uma demanda muito alta, conseguimos sempre ajudar o cliente e tentar encaixar a melhor negociação necessária.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês trabalham com alguma solução para delivery?",
            "resposta" => "Temos a solução perfeita para delivery no geral, chamada Foguete Delivery.",
            "active" => "",
        ],
        [
            "pergunta" => "O que é Foguete delivery?",
            "resposta" => "Nosso software para pedido de comida, bebida e qualquer tipo de consumível entregável online.",
            "active" => "active",
        ],
        [
            "pergunta" => "O que está incluso no sistema de delivery?",
            "resposta" => "Criamos desde da parte de fotografia, implantação e atualizações do nosso sistema. É a solução completa e definitiva das entregas online.",
            "active" => "",
        ],
        [
            "pergunta" => "Fechei um plano com vocês, e agora?",
            "resposta" => "Seguimos um protocolo de 3 passos para iniciar com nossos clientes, 1º Criamos um grupo no whatsapp, 2º Enviamos um briefing inicial, 2º Agendamos uma reunião de alinhamento",
            "active" => "",
        ],
    ];

    return $duvidas;
}

    /**
     * Retorna a lista dos clientes
     *
     * @return array
     */
    public function getClientes()
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
        return $clientes;
    }

    /**
     * View Index
     *
     * @return void
     */
    public function index()
    {
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
            "clientes" => $this->getClientes(),
            "depoimentos" => $depoimentos,
            "duvidas" => Geral::sortearArray(4,$this->getDuvidas()),
            "solucoes" => $this->getSolucoes(),
        ]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function sobre()
    {
        return view("templates.inovex.sobre",[
            "solucoes" => $this->getSolucoes(),
        ]);
    }

    /**
     * View Soluções
     *
     * @param string $id
     * @return void
     */
    public function solucoes($id = "")
    {

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
                "solucoes" => $this->getSolucoes(),
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
                        "Artes para e-mail marketing",
                        "banners para sites",
                        "cartão com qrcode",
                        "propaganda para whatsapp",
                        "flyers digital",
                        "E muito mais",
                    ]
                ];

                $planos = null;  
            }else if($id == "site-express"){

                //Ativando menu
                $solucoes[3]["active"] = "active";
                $info = [
                    "titulo" => "Site Express",
                    "descricao" => "
                    Já pensou em ter um site profissional para a sua empresa, com desenvolvimento ágil, preço justo e com alta indexação no Google.
                    <br><br>
                    O Site Express, é um produto da J6 Soluções, onde construimos o site inteiro para você, e hospedamos em servidores próprios.
                    <br><br>
                    Como funciona:<br>
                    1º A empresa contrata uma das nossas 3 opções de desenvolvimento;<br>
                    2º Nossa equipe irá desenvolver todo o projeto em cima dos módulos que temos disponíveis;<br>
                    3º Iremos fazer a hospedagem, criar as contas de email e deixar tudo pronto para o cliente;<br>
                    4º O cliente não precisa se preocupar com paineis complexos, e artes mau feitas, deixaremos tudo lindo para você;<br>
                    5º Iremos entregar o seu login e senha, para alterações futuras de produtos, serviços e informações;<br>
                    6º Prestaremos o suporte, todo o tempo que precisar :)<br>
                    ",
                    "capa" => "capa-site-express.png",
                    "img-exemplo" => [
                        "site-1.png",
                        "site-2.png",
                        "site-3.png",
                        "site-4.png",
                    ],
                    "destaques" => [
                        "Alta velocidade na criação do projeto",
                        "Projetos 100% entregues",
                        "Site completo para pequenas, médias e grandes empresas",
                        "E-mails com seu domínio",
                        "Blog",
                        "Alta indexação com o Google",
                        "Painel administrador incluso",
                        "Atualizações constantes",
                    ]
                ];

                $planos = [
                    [   
                        "img" => "icone-site-express.png",
                        "titulo" => "Básico X1",
                        "itens" => ["Indicado para Pequenas Empresas", "1 Conta de email","1 Página","5 GB espaço","Admin"],
                        "valor" => "R$ 19,90*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-site-express.png",
                        "titulo" => "Médio X2",
                        "itens" => ["Indicado para Médias empresas", "10 Contas de email","Páginas ilimitadas","25 GB espaço","Admin","SEO","Blog","+10 módulos"],
                        "valor" => "R$ 49,90*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                    [   
                        "img" => "icone-site-express.png",
                        "titulo" => "Super X3",
                        "itens" => ["Indicado para Grandes empresas", "30 Contas de email","Páginas ilimitadas","50 GB espaço","Admin","SEO","Blog","+15 módulos","Google Analytics"],
                        "valor" => "R$ 69,90*",
                        "url" => config("app.url")."/fale-conosco",
                    ],
                ];                

            }else if($id == "site-personalizado"){
                //Ativando menu
                $solucoes[4]["active"] = "active";
                $info = [
                    "titulo" => "Site Personalizado",
                    "descricao" => "Um site personalizado ele é 100% customizado para o cliente, como layout, instalação do projeto no servidor do cliente, e regras de negócio dentro do site que puderem surgir como exemplo:<br>
                    Sistema de cadastro para franquias, LandingPages customizadas, Sistema de agendamento, Integrações com outros sistemas, etc.
                    <br><br>
                    Em um projeto assim, iniciamos sempre com uma reunião de briefing, e seguimos com reuniões de alinhamento do projeto, até a entrega dele 100% conforme todo o combinado.",
                    "capa" => "capa-site-personalizado.png",
                    "img-exemplo" => [
                        "sitep-1.png",
                        "sitep-2.png",
                        "sitep-3.png",
                        "sitep-4.png",
                        "sitep-5.png",
                        "sitep-6.png",
                    ],
                    "destaques" => [
                        "Layout 100% customizado para o cliente",
                        "Regras de negócio conforme a necessidade",
                        "Reunião de alinhamento",
                        "Reuniões de etapas do projeto",
                        "Alta conversão de SEO",
                        "Configurado no servidor do cliente",
                    ]
                ];

                $planos = null;  
            }

            $seo = [
                "titulo" => Seo::title($info["titulo"]." - ".config("j6.cliente")),
                "descricao" => Seo::metadescription($info["descricao"]),
            ];
            
            return view("templates.inovex.solucoes-single", [
                "solucoes" => $this->getSolucoes(),
                "info" => $info,
                "seo" => $seo,
                "planos" => $planos,
            ]);
        }
    }//Fim soluções

    public function portfolio()
    {
        $menu = [
            [
               "tag" => "redes-sociais",
               "titulo" => "Redes Sociais",
            ],
            [
               "tag" => "artes-digital",
               "titulo" => "Artes Digital",
            ],
            [
               "tag" => "sites",
               "titulo" => "Sites",
            ]
        ];

        $portfolio = [
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-1.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Site personalizado para Postos de Gasolina",
                "img" => "sitep-3.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Flyer Digital panificadora",
                "img" => "artes-digital-1.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Flyer Digital empresa quadras esportivas",
                "img" => "artes-digital-2.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-2.png",
                "menu" => $menu[0]
            ],            
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-3.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Site personalizado para construtora",
                "img" => "sitep-1.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Catálogo de produtos esportivos",
                "img" => "artes-digital-3.png",
                "menu" => $menu[1]
            ],                                    
            [
                "titulo" => "Catálogo de produtos perecíveis",
                "img" => "artes-digital-4.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Site Express Empresa de container",
                "img" => "site-3.png",
                "menu" => $menu[2]
            ],                                                
            [
                "titulo" => "Site Express Clínica Pediátrica",
                "img" => "site-1.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Cartão de visitas digital clicável",
                "img" => "artes-digital-8.png",
                "menu" => $menu[1]
            ],                                                
            [
                "titulo" => "Banners para e-commerce",
                "img" => "artes-digital-7.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Arte para Feed",
                "img" => "post-4.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Apresentação em PDF equipe de vendas",
                "img" => "artes-digital-6.png",
                "menu" => $menu[1]
            ],            
            [
                "titulo" => "Logomarcas",
                "img" => "artes-digital-5.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Site Responsivo personalizado",
                "img" => "sitep-6.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Arte para e-mail marketing",
                "img" => "artes-digital-9.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-5.png",
                "menu" => $menu[0]
            ],                                                      
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-6.png",
                "menu" => $menu[0]
            ],                                                      
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-7.png",
                "menu" => $menu[0]
            ],                                                      
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-8.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Logomarca clínica de estética",
                "img" => "artes-digital-10.jpg",
                "menu" => $menu[1]
            ],                                                                  
        ];

        return view("templates.inovex.portfolio", [
            "menu" => $menu,
            "portfolio" => $portfolio,
            "solucoes" => $this->getSolucoes(),
        ]);

    }

    public function duvidas()
    {
        return view("templates.inovex.duvidas",[
            "duvidas" => Geral::dividirArray($this->getDuvidas()),
            "solucoes" => $this->getSolucoes(),
        ]);
    }

    public function faleConosco()
    {
        return view("templates.inovex.faleconosco",[
            "solucoes" => $this->getSolucoes(),
        ]);
    }

}
