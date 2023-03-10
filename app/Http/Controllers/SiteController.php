<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Helpers\Geral;
use Illuminate\Support\Arr;

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
                "img" => "capas/icone-1.png",
                "url-single" => config("app.url")."/solucoes/redes-sociais",
                "active" => "",
            ],
            [
                "titulo" => "Artes Offline",
                "descricao" => "Comunicação visual de qualidade, como logomarcas, apresentações em PDF, Catálogos Online e muito mais.",
                "img" => "capas/icone-3.png",
                "url-single" => config("app.url")."/solucoes/artes-offline",
                "active" => "",
            ],            
            [
                "titulo" => "Campanhas no Google ADS",
                "descricao" => "Para o seu site aparecer na primeira página do Google, quando um cliente pesquisar sobre o seu negócio.",
                "img" => "capas/icone-2.png",
                "url-single" => config("app.url")."/solucoes/campanha-no-google-ads",
                "active" => "",
            ],
            [
                "titulo" => "SEO",
                "descricao" => "Estratégias e análises focadas em seu site, para deixar sua empresa na 1º página do Google, e assim conquistar mais clientes.",
                "img" => "capas/icone-4.png",
                "url-single" => config("app.url")."/solucoes/seo",
                "active" => "",
            ],
            [
                "titulo" => "Criação de Sites",
                "descricao" => "Criamos sites profissionais com qualidade excepcional para clientes que necessitam de algo único e inesquecível.",
                "img" => "capas/icone-5.png",
                "url-single" => config("app.url")."/solucoes/criacao-de-sites",
                "active" => "",
            ],
            [
                "titulo" => "Programação WEB",
                "descricao" => "Desenvolvimento e manutenção de sistemas web, desde o desenho, até a implantação final no servidor.",
                "img" => "capas/icone-6.png",
                "url-single" => config("app.url")."/solucoes/programacao-web",
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
            "pergunta" => "Qual linguagem de programação vocês trabalham",
            "resposta" => "Para projetos web, trabalhamos com Laravel versão 9x ou superior, e Vue.JS.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês colocam meu site na 1º página do Google?",
            "resposta" => "Tentamos, posicionar o site hoje na 1º página sim. Por se tratar de um trabalho árduo, nós possuímos as melhores ferramentas e realizamos esse serviço.",
            "active" => "",
        ],
        [
            "pergunta" => "Vocês desenvolvem sistemas web?",
            "resposta" => "Sim, desenvolvemos desde da ideia, até a implantação final do servidor.",
            "active" => "",
        ],        
        [
            "pergunta" => "Tenho uma startup de um aplicativo novo no mercado, vocês fazem o desenvolvimento?",
            "resposta" => "Sim, Criamos aplicativos web responsivos, com alta performance, e engajamento com o Google.",
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
                "nome" => "Deltasoft",
                "img" => "deltasoft.png",
            ],
            [
                "nome" => "Chef Line",
                "img" => "chefline.png",
            ],
            [
                "nome" => "Beeapp",
                "img" => "beeapp.png",
            ],
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
        return Arr::shuffle($clientes);
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
                "nome" => "Ataliba Moises Beeapp",
                "depoimento" => "A J6 conseguiu construir o nosso aplicativo de forma sólida e com atendimento diferenciado. Hoje tenho muito mais tranquilidade no suporte da minha empresa.",
            ],
            [
                "nome" => "Douglas Duarte Deltasoft",
                "depoimento" => "Tive a oportunidade de ser atendido pela J6 para realizar o branding da minha empresa, eles desenvolveram a nossa marca, material offline e nosso site.",
            ],
            [
                "nome" => "Michele Alux Pro Sports",
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
            "depoimentos" => Arr::shuffle($depoimentos),
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
            if($id == "redes-sociais"){
                $solucoes = $this->getSolucoes();
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
                    "capa" => "capas/1.png",
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
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[2]["active"] = "active";
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
                    "capa" => "capas/2.png",
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
                   
            }
            
            else if($id == "seo"){
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[3]["active"] = "active";
                $info = [
                    "titulo" => "SEO",
                    "descricao" => "Você tem o problema de não conseguir colocar seu site da empresa na primeira página do Google? Ou está cansado de não saber como melhorar a performance do seu site, sem ter os recursos necessários para realizar uma análise avançada? Nossa solução é o serviço SEO.<br><br>
                    O Serviço SEO é um pacote que inclui ferramentas e recursos especialmente desenvolvidos para auxiliar sua empresa a alcançar resultados satisfatórios no meio digital. Ele contém análises profundas do website feitas pelo Google Analitycs e determinadas palavras-chave que serão usadas nas campanhas publicitarias. Além disso, oferecemos também conteúdo criativo destinado à criação de blog posts direcionados às principais tendências de mercado e interesses dos visitantes do seu website.<br><br>
                    A solução definitiva para as suas preocupações acerca dessa área vem com nosso serviço SEO: você ganha um maior controle sobre o trabalho realizado no marketing digital da sua empresa; obtém mais visibilidade na web através das principais palavras-chave relevantes; produz conteúdos originais que irão engajar mais clientes potenciais; monitoriza facilmente as performances online através da análise do Google Analitycs; enfim, conquista posicionamento superior nos motores de busca com rapidez e praticidade!
                    ",
                    "capa" => "capas/4.png",
                    "img-exemplo" => [
                        "seo-1.png",
                        "google-2.png",
                    ],
                    "destaques" => [
                        "Aumento das suas vendas",
                        "Aumento das visitas em seu site",
                        "Análise avançadas dos acessos do site",
                        "Criação de conteúdo para o blog",
                        "Criação e manutenção de páginas no site",
                        "Assessoria inicial de melhora do SEO do site",
                        "Relatório de análise de palavras chaves de alto desempenho",
                        "Melhora na pontuação do site",
                    ]
                ];
                   
            }
            
            
            else if($id == "artes-offline"){
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[1]["active"] = "active";
                $info = [
                    "titulo" => "Artes Offline",
                    "descricao" => "<strong>Uma imagem vale mais que mil palavras</strong>, certamente você já escutou essa frase e ela é verdade.
                    <br>
                    O que chama atenção primeiro das pessoas é as imagens, e após isso o texto, sendo assim oferecemos criação de artes digital de qualidade.
                    <br>
                    Criamos artes digitais como:",
                    "capa" => "capas/3.png",
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
                $solucoes = $this->getSolucoes();
                $solucoes[4]["active"] = "active";
                $info = [
                    "titulo" => "Criação de Sites",
                    "descricao" => "Um site personalizado ele é 100% customizado para o cliente, como layout, instalação do projeto no servidor do cliente, e regras de negócio dentro do site que puderem surgir como exemplo:<br>
                    Sistema de cadastro para franquias, LandingPages customizadas, Sistema de agendamento, Integrações com outros sistemas, etc.
                    <br><br>
                    Em um projeto assim, iniciamos sempre com uma reunião de briefing, e seguimos com reuniões de alinhamento do projeto, até a entrega dele 100% conforme todo o combinado.<br><br>
                    Alguns projetos online<br>
                    <a href='https://www.beeapp.com.br'>www.beeapp.com.br</a><br>
                    <a href='https://www.deltasoft.com.br'>www.deltasoft.com.br</a><br>
                    <a href='https://www.mmreefer.com.br'>www.mmreefer.com.br</a><br>
                    <a href='http://www.postosmeta.com.br'>www.postsometa.com.br</a><br>
                    ",
                    "capa" => "capas/5.png",
                    "img-exemplo" => [
                        "site-5.png",
                        "site-6.png",
                        "sitep-4.png",
                        "sitep-5.png",
                        "site-1.png",
                        "site-3.png",                      
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

            }else if($id == "programacao-web"){
                //Ativando menu
                $solucoes = $this->getSolucoes();
                $solucoes[5]["active"] = "active";
                $info = [
                    "titulo" => "Programação Web",
                    "descricao" => "Há mais de 18 anos a nossa equipe vem trabalhando com programação web de altíssimo nível. <br>Estamos sempre engajados em estabelecer uma metodologia que possa seguir nosso cliente durante todo o processo: desde o momento da criação, passando pelo projeto e até chegar à implantação do servidor final. Para oferecermos os melhores serviços para você, empregamos as tecnologias mais modernas como Laravel Framework e Vue.JS. <br><br>Seja para construir um novo projeto do zero ou dar a manutenção necessária a algo já existente, nós estaremos prontos para te aconselhar e colaborar com excelência e comprometimento, pois é assim que tem funcionado por todos esses anos. Com conhecimento profundo dos sistemas de códigos e as ferramentas certas, somado à devida dedicação, garantimos a entrega de resultados incríveis!",
                    "capa" => "capas/6.png",
                    "img-exemplo" => [
                        "programacao-beeapp.png", 
                        "sitep-2.png",                      
                        "sistema-passe.png",                      
                                             
                    ],
                    "destaques" => [
                        "Designer UX",
                        "Laravel Framework",
                        "Vue.JS",
                        "Projetos escalonáveis",
                        "Desde do desenho até o projeto rodando no servidor",
                        "Compromisso e Qualidade",
                        "Paixão por códigos",
                        "Sistemas Responsivos"
                    ]
                ];
            }

            $seo = [
                "titulo" => Seo::title($info["titulo"]." - ".config("j6.cliente")),
                "descricao" => Seo::metadescription($info["descricao"]),
            ];
            
            return view("templates.inovex.solucoes-single", [
                "solucoes" => $solucoes,
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
               "tag" => "artes-offline",
               "titulo" => "Artes Offline",
            ],
            [
               "tag" => "websites",
               "titulo" => "Websites",
            ],
            [
               "tag" => "programacao-web",
               "titulo" => "Programação Web",
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
                "titulo" => "Sistema de cadastro de imóveis e troca de pontos por vendas",
                "img" => "sistema-passe.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Sistema completo de gestão empresarial e onboarding Beeapp",
                "img" => "sistema-beeapp.png",
                "menu" => $menu[3]
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
                "titulo" => "Site para Empresa de container",
                "img" => "site-3.png",
                "menu" => $menu[2]
            ],                                                
            [
                "titulo" => "Site com Blog para Clínica Pediátrica",
                "img" => "site-1.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Site instititucional Beeapp Gestão Organizacional",
                "img" => "site-6.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Site Dinâmico para empresa de Tecnologia Deltasoft",
                "img" => "site-5.png",
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
                "titulo" => "Site Responsivo com Alto índice de SEO Google",
                "img" => "sitep-6.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Arte para e-mail marketing",
                "img" => "artes-digital-9.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Aplicação parede Logomarca",
                "img" => "artes-digital-10.jpg",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Arte para rórulo de bebidas",
                "img" => "artes-digital-11.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Cartão de visitas impresso",
                "img" => "artes-digital-12.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Criação de Logomarca",
                "img" => "artes-digital-13.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Criação e aplicação da Logomarca Deltasoft",
                "img" => "artes-digital-14.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Arte para pasta de orçamentos e documentos",
                "img" => "artes-digital-15.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Cartão de visitas impresso Deltasoft",
                "img" => "artes-digital-16.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Folder produto Alux Pro Sports",
                "img" => "artes-digital-17.png",
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
                "titulo" => "Post para redes sociais",
                "img" => "post-9.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-10.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-11.png",
                "menu" => $menu[0]
            ],                                                                
        ];

        return view("templates.inovex.portfolio", [
            "menu" => $menu,
            "portfolio" => Arr::shuffle($portfolio),
            "solucoes" => $this->getSolucoes(),
        ]);

    }

    public function duvidas()
    {
        return view("templates.inovex.duvidas",[
            "duvidas" => Geral::dividirArray($this->getDuvidas(), true),
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
