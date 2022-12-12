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
                "titulo" => "Redes Sociais",
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
                "titulo" => "Artes Offline",
                "descricao" => "Comunicação visual de qualidade, como logomarcas, apresentações em PDF, Catálogos Online e muito mais.",
                "img" => "service-i-3.png",
                "url-single" => config("app.url")."/solucoes/artes-digital",
                "active" => "",
            ],
            [
                "titulo" => "Criação de Sites",
                "descricao" => "Sites com qualidade excepcional para clientes que necessitam de algo único e inesquecível.",
                "img" => "service-i-5.png",
                "url-single" => config("app.url")."/solucoes/criacao-de-sites",
                "active" => "",
            ],
        ];
        return $solucoes;
    }

public function getDuvidas()
{
    $duvidas = [
        [
            "pergunta" => "Quanto custa um trabalho com redes sociais?",
            "resposta" => "Todas as nossas soluções são baseadas na necessidade do trabalho de cada cliente.",
            "active" => "active",
        ],
        [
            "pergunta" => "Vocês gerenciam a rede social da nossa empresa?",
            "resposta" => "Sim, realizamos a gestão das redes sociais.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês entregam o projeto do site pronto?",
            "resposta" => "Sim, todos as nossas soluções de sites são entregues 100% prontos para o cliente, junto com o treinamento da ferramenta.",
            "active" => "",
        ],
        [
            "pergunta" => "Se eu precisar de uma solução especifica?",
            "resposta" => "Iremos analisar a demanda, e montar uma proposta em cima da necessidade do cliente.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês são uma agência de marketing?",
            "resposta" => "Sim, somos uma agência digital, nosso foco é o posicionamento das empresas no mundo digital.",
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
       
            return view("templates.inovex.solucoes",[
                "solucoes" => $this->getSolucoes(),
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

            }else if($id == "criacao-de-sites"){
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
                        "site-1.png",
                        "site-2.png",
                        "site-3.png",
                        "site-4.png",                        
                    ],
                    "destaques" => [
                        "Layout 100% customizado para o cliente",
                        "Regras de negócio conforme a necessidade",
                        "Reunião de alinhamento",
                        "Reuniões de etapas do projeto",
                        "Alta conversão de SEO",
                        "Configurado no servidor do cliente",
                        "Templates únicos, exclusivos e profissionais",
                        "Sites Responsivos"
                    ]
                ];

            }

            $seo = [
                "titulo" => Seo::title($info["titulo"]." - ".config("j6.cliente")),
                "descricao" => Seo::metadescription($info["descricao"]),
            ];
            
            return view("templates.inovex.solucoes-single", [
                "solucoes" => $this->getSolucoes(),
                "info" => $info,
                "seo" => $seo,
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
