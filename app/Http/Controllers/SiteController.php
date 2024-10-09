<?php

namespace App\Http\Controllers;

use App\Helpers\Seo;
use App\Helpers\Geral;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class SiteController extends Controller
{
    /**
     * Retorna as soluções da empresa
     *
     * @return array
     */
    public function getSolucoes(): array
    {
        //Lista de serviços
        return [
            [
                "titulo" => "Programação WEB",
                "descricao" => "Desenvolvimento e manutenção de sistemas web, desde o desenho, até a implantação final no servidor.",
                "img" => "capas/icone-6.png",
                "url-single" => config("app.url")."/solucoes/programacao-web",
                "active" => "",
            ],            
            [
                "titulo" => "Sistemas Prontos",
                "descricao" => "Sistemas para a sua empresa a pronta entrega, todos com 30 dias grátis para usar e testar a sua maneira.",
                "img" => "capas/icone-4.png",
                "url-single" => config("app.url")."/solucoes/sistemas-prontos",
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
                "titulo" => "Google ADS",
                "descricao" => "Para o seu site aparecer na primeira página do Google, quando um cliente pesquisar sobre o seu negócio.",
                "img" => "capas/icone-2.png",
                "url-single" => config("app.url")."/solucoes/campanhas-no-google-ads",
                "active" => "",
            ],                                    
            [
                "titulo" => "Redes Sociais",
                "descricao" => "Criamos postagens profissionais para as redes sociais da sua empresa. Deixe seu feed com uma melhor apresentação.",
                "img" => "capas/icone-1.png",
                "url-single" => config("app.url")."/solucoes/gestao-de-redes-sociais",
                "active" => "",
            ],
            [
                "titulo" => "Artes Offline",
                "descricao" => "Comunicação visual de qualidade, como logomarcas, apresentações em PDF, Catálogos Online e muito mais.",
                "img" => "capas/icone-3.png",
                "url-single" => config("app.url")."/solucoes/artes-offline",
                "active" => "",
            ],
        ];
    }

    public function getDuvidas(): array
    {
        return [
            [
                "pergunta" => "Quanto custa a gestão de redes sociais?",
                "resposta" => "Trabalhamos com pacote de postagens, que vai de 1 publicação semanal até 5 publicações semanais.",
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
                "resposta" => "Somos uma empresa que trabalha com soluções de serviços digitais, oferecendo alguns serviços de agência.",
                "active" => "",
            ],
            [
                "pergunta" => "Vocês criam logomarcas?",
                "resposta" => "Sim criamos logomarcas, identidade visual completa, e toda parte gráfica offline",
                "active" => "",
            ],
            [
                "pergunta" => "Qual linguagem de programação vocês trabalham",
                "resposta" => "Trabalhamos hoje com Laravel, PHP, Javascript, Tailwind e várias linguagens atuais do mercado.",
                "active" => "",
            ],
            [
                "pergunta" => "Vocês colocam meu site na 1º página do Google?",
                "resposta" => "Trabalhamos com campanhas no Google ADS, onde são campanhas pagas para o Google, e sua página pode sim ficar no topo das pesquisas.",
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
            [
                "pergunta" => "O que a J6 Soluções Digitais faz?",
                "resposta" => "A J6 Soluções Digitais oferece serviços de programação web, criação de sites, desenvolvimento de sistemas prontos, gestão de campanhas no Google ADS, administração de redes sociais e criação de artes para mídia offline.",
                "active" => "",
            ],
            [
                "pergunta" => "A J6 Soluções Digitais cria sites personalizados?",
                "resposta" => "Sim, criamos sites totalmente personalizados de acordo com as necessidades da sua empresa, garantindo um design profissional e funcionalidade otimizada.",
                "active" => "",
            ],
            [
                "pergunta" => "A J6 Soluções Digitais faz gestão de campanhas de Google ADS?",
                "resposta" => "Sim, gerenciamos campanhas de Google ADS para maximizar a visibilidade da sua empresa online, atraindo mais clientes e aumentando as conversões.",
                "active" => "",
            ],
            [
                "pergunta" => "Quais são os sistemas prontos que a J6 oferece?",
                "resposta" => "A J6 oferece sistemas prontos para gestão empresarial, CRM, e-commerce, e outros tipos de software, todos adaptáveis às necessidades específicas do seu negócio.",
                "active" => "",
            ],
            [
                "pergunta" => "A J6 Soluções Digitais também trabalha com marketing nas redes sociais?",
                "resposta" => "Sim, oferecemos gestão completa de redes sociais, desde a criação de conteúdo até o gerenciamento das campanhas para aumentar o engajamento e a presença online.",
                "active" => "",
            ],
            [
                "pergunta" => "A J6 Soluções Digitais faz criação de artes offline?",
                "resposta" => "Sim, além das soluções digitais, também criamos materiais gráficos para mídia offline, como cartões de visita, flyers, banners e outros itens de identidade visual.",
                "active" => "",
            ],
            [
                "pergunta" => "Como posso contratar os serviços da J6 Soluções Digitais?",
                "resposta" => "Você pode entrar em contato conosco através do nosso site ou redes sociais para solicitar um orçamento e conhecer mais sobre nossos serviços personalizados.",
                "active" => "",
            ],
            [
                "pergunta" => "Quanto custa fazer um site profissional com vocês?",
                "resposta" => "Nossos valores iniciam em R$700,00 para uma landingpage. Sites mais complexo e com mais informações o valor é sob demanda.",
                "active" => "",
            ],
            [
                "pergunta" => "Vocês vendem curso online?",
                "resposta" => "Não, nossa empresa entrega soluções digitais para empresas e negócios que desejam se destacar na web.",
                "active" => "",
            ],
        ];
    }

    /**
     * Retorna a lista dos clientes
     *
     * @return array
     */
    public function getClientes(): array
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
                "nome" => "Capital Container",
                "img" => "capital-container.png",
            ],
        ];
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
                "nome" => "Capital Container",
                "img" => "capital-container.png",
            ],
            [
                "nome" => "Atom Tech Energia Solar",
                "img" => "atom.png",
            ],
            [
                "nome" => "Baga Suspensões",
                "img" => "baga.png",
            ],
            [
                "nome" => "Gratidão Empreendimentos",
                "img" => "gratidao.png",
            ],
            [
                "nome" => "H3 imports",
                "img" => "h3.png",
            ],
            [
                "nome" => "Holfer Supermercados",
                "img" => "holfer.png",
            ],
            [
                "nome" => "Irauê Mini Mercados",
                "img" => "iraue.png",
            ],
            [
                "nome" => "LTB Gestão e Representação",
                "img" => "ltb.png",
            ],
            [
                "nome" => "LTB Gestão e Representação",
                "img" => "ltb.png",
            ],
            [
                "nome" => "Nutrien Comida Saudável",
                "img" => "nutrien.png",
            ],
            [
                "nome" => "Stamm Empilhadeiras",
                "img" => "stamm.png",
            ],
            [
                "nome" => "Vors autopeças",
                "img" => "vors.png",
            ],
        ];
        return Arr::shuffle($clientes);
    }


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
                "nome" => "Gil L2G Representação",
                "depoimento" => "Nosso catálogo dos produtos foram todos feitos pela J6, entrega rápida e trabalho bem elaborado, recomendamos a empresa J6 Soluções Digitais.",
            ],
            [
                "nome" => "Caique Vors",
                "depoimento" => "Fizemos nosso website com a J6, entregaram além do esperado, sempre respeitando os prazos combinado com a empresa. Parabéns a equipe!",
            ],
        ];

        return view("templates.inovex.home", [
            "clientes" => $this->getClientes(),
            "depoimentos" => Arr::shuffle($depoimentos),
            "duvidas" => Geral::sortearArray(4,$this->getDuvidas()),
            "solucoes" => $this->getSolucoes(),
        ]);
    }


    public function sobre()
    {
        return view("templates.inovex.sobre",[
            "solucoes" => $this->getSolucoes(),
        ]);
    }


    public function solucoes($id = "")
    {
        $info = "";
        $solucoes = "";

        if( empty($id) ){

            return view("templates.inovex.solucoes",[
                "solucoes" => $this->getSolucoes(),
            ]);

        }else{

            //Verificando id passado
            if($id == "gestao-de-redes-sociais"){
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[4]["active"] = "active";
                $ativarSistema = false;
                $info = [
                    "titulo" => "Gestão de redes sociais",
                    "descricao" => "Criamos postagens profissionais para redes sociais da sua empresa, desde da criação da arte até o texto do mesmo (copywriting).<br><br>
                    Tudo se inicia com o cliente escolhendo um plano,
                    após isso vamos iniciar com o briefing, criamos o cronograma das postagens, claro sempre seguindo a melhor estratégia de mkt digital. <br>Após setado o cronograma iniciamos as postagens
                    das redes sociais.<br><br>
                    A recorrência de postagens profissionais, faz o feed ficar mais bonito, entendível e potencializa a marca e o marketing da sua empresa. Hoje a j6 Soluções Digitais, tem planos para atender
                    desde pequenos negócios a grandes empresas.",
                    "capa" => "capas/1.png",
                    "img-exemplo" => [
                        "post-9.png",
                        "post-2.png",
                        "post-4.png",
                        "post-11.png",
                    ],
                    "destaques" => [
                        "Postagens Semanal",
                        "Artes Profissionais",
                        "Textos chamativos das postagens",
                        "Criação do cronograma",
                        "Estratégia de Mkt Digital",
                        "Planos com carrossel, vídeos e stories",
                        "Criação da Id. visual dos posts, de acordo com a marca do cliente",
                    ]
                ];
                $planos = [
                    [
                        "titulo" => "1 Post por semana",
                        "img" => "capas/icone-1.png",
                        "valor" => "R$299,00",
                        "observacao" => "Valor mensal",
                        "url" => "https://pag.ae/7-ZVDfe2R",
                        "destaques" => [
                            "Sem carrossel",
                            "Sem vídeo",
                            "Sem adaptações para stories",
                            "Criação da arte do post",
                            "Criação da legenda (copy)",
                            "Criação do cronograma mensal",
                            "Criação da Id. Visual",
                            "Facebook + Instagram",
                        ],
                    ],                    
                    [
                        "titulo" => "2 Posts por semana",
                        "img" => "capas/icone-1.png",
                        "valor" => "R$478,00",
                        "observacao" => "Valor mensal",
                        "url" => "https://pag.ae/7-ZVDuWuv",
                        "destaques" => [
                            "1 carrossel mensal",
                            "1 vídeo mensal (60s)",
                            "1 adaptação para stories",
                            "Criação da arte do post",
                            "Criação da legenda (copy)",
                            "Criação do cronograma mensal",
                            "Criação da Id. Visual",
                            "Facebook + Instagram",
                        ],
                    ],                    
                    [
                        "titulo" => "3 Posts por semana",
                        "img" => "capas/icone-1.png",
                        "valor" => "R$717,00",
                        "observacao" => "Valor mensal",
                        "url" => "https://pag.ae/7-ZVDLyNP",
                        "destaques" => [
                            "2 carrosseis mensal",
                            "2 vídeos mensal (60s)",
                            "2 adaptações para stories",
                            "Criação da arte do post",
                            "Criação da legenda (copy)",
                            "Criação do cronograma mensal",
                            "Criação da Id. Visual",
                            "Facebook + Instagram + Linkedin",
                        ],
                    ],                    
                    [
                        "titulo" => "4 Posts por semana",
                        "img" => "capas/icone-1.png",
                        "valor" => "R$956,00",
                        "observacao" => "Valor mensal",
                        "url" => "https://pag.ae/7-ZVDZ1sK",
                        "destaques" => [
                            "3 carrosseis mensal",
                            "3 vídeos mensal (60s)",
                            "3 adaptações para stories",
                            "Criação da arte do post",
                            "Criação da legenda (copy)",
                            "Criação do cronograma mensal",
                            "Criação da Id. Visual",
                            "Facebook + Instagram + Linkedin + Google meu negócio",
                        ],
                    ],                    
                    [
                        "titulo" => "5 Posts por semana",
                        "img" => "capas/icone-1.png",
                        "valor" => "R$1.196,00",
                        "observacao" => "Valor mensal",
                        "url" => "https://pag.ae/7-ZVEeYhP",
                        "destaques" => [
                            "4 carrosseis mensal",
                            "4 vídeos mensal (60s)",
                            "4 adaptações para stories",
                            "Criação da arte do post",
                            "Criação da legenda (copy)",
                            "Criação do cronograma mensal",
                            "Criação da Id. Visual",
                            "Facebook + Instagram + Linkedin + Google meu negócio",
                        ],
                    ],                    
                ];

                


            }else if($id == "campanhas-no-google-ads"){
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[3]["active"] = "active";
                $ativarSistema = false;
                $info = [
                    "titulo" => "Campanha no Google Ads",
                    "descricao" => "
                    Se você está precisando <strong>gerar mais contatos</strong> para o seu time de vendas, vender mais e aumentar o número de clientes, as campanhas no Google ADS são perfeitas para conseguir esse feito.<br><br>
                    Criamos campanhas profissionais, e conseguimos trazer os melhores resultados quando o assunto é marketing de performance.
                    <br>
                    Possuímos planos para pequenas, médias e grandes empresas. Alcance agora mesmo o pública alvo do seu negócio e venda mais.
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
                        "Mais leads para seu time de venda",
                        "Seu site na 1º página de busca do Google",
                    ]
                ];

                $planos = [
                    [
                        "titulo" => "1 Campanha Google ADS",
                        "img" => "capas/icone-2.png",
                        "valor" => "R$499,00",
                        "observacao" => "Pagamento único",
                        "url" => "https://pag.ae/7--5PDw4t",
                        "destaques" => [
                            "Análise e criação da campanha",
                            "Melhores palavras chaves",
                            "Aumento das vendas",
                            "Segmentação por região",
                            "Sua empresa na 1º página do Google",
                            "Mais acessos no seu site ou landingpage",
                            "Saldo do Google é pago a parte",
                            "Manutenção da campanha caso queira, terá um custo de R$120,00 por campanha ativa",
                        ],
                    ],                    
                    [
                        "titulo" => "2 Campanhas Google ADS",
                        "img" => "capas/icone-2.png",
                        "valor" => "R$799,00",
                        "observacao" => "Pagamento único",
                        "url" => "https://pag.ae/7--5QKzw2",
                        "destaques" => [
                            "Análise e criação da campanha",
                            "Melhores palavras chaves",
                            "Aumento das vendas",
                            "Segmentação por região",
                            "Sua empresa na 1º página do Google",
                            "Mais acessos no seu site ou landingpage",
                            "Saldo do Google é pago a parte",
                            "Manutenção da campanha caso queira, terá um custo de R$120,00 por campanha ativa",
                        ],
                    ],                    
                    [
                        "titulo" => "3 Campanhas Google ADS",
                        "img" => "capas/icone-2.png",
                        "valor" => "R$999,00",
                        "observacao" => "Pagamento único",
                        "url" => "https://pag.ae/7--5RbYG8",
                        "destaques" => [
                            "Análise e criação da campanha",
                            "Melhores palavras chaves",
                            "Aumento das vendas",
                            "Segmentação por região",
                            "Sua empresa na 1º página do Google",
                            "Mais acessos no seu site ou landingpage",
                            "Saldo do Google é pago a parte",
                            "Manutenção da campanha caso queira, terá um custo de R$120,00 por campanha ativa",
                        ],
                    ],                    
                ];

            }

            else if($id == "artes-offline"){
                $solucoes = $this->getSolucoes();
                //Ativando menu
                $solucoes[5]["active"] = "active";
                $ativarSistema = false;
                $info = [
                    "titulo" => "Artes Offline",
                    "descricao" => "<strong>Uma imagem vale mais que mil palavras</strong>, certamente você já escutou essa frase e ela é verdade.
                    <br>
                    O que chama atenção primeiro das pessoas é as imagens, e após isso o texto, sendo assim oferecemos criação de artes digital de qualidade.
                    <br>
                    Criamos artes digitais como:",
                    "capa" => "capas/3.png",
                    "img-exemplo" => [
                        "artes-digital-18.png",
                        "artes-digital-2.png",
                        "artes-digital-3.png",
                        "artes-digital-4.png",
                        "artes-digital-10.png",
                        "artes-digital-6.png",
                        "artes-digital-7.png",
                        "artes-digital-8.png",
                    ],
                    "destaques" => [
                        "catálogo em PDF para equipe comercial",
                        "cardápios",
                        "logomarcas",
                        "Id. Visual completa",
                        "Outdoors",
                        "cartão de visita digital",
                        "Artes para e-mail marketing",
                        "banners para sites",
                        "cartão com qrcode",
                        "propaganda para whatsapp",
                        "flyers digital",
                        "E muito mais",
                    ]
                ];
                $planos = [
                    [
                        "titulo" => "Logomarca",
                        "img" => "capas/icone-3.png",
                        "valor" => "R$390,00",
                        "observacao" => "Pagamento único",
                        "url" => "https://pag.ae/7--dH7aS7",
                        "destaques" => [
                            "Entrega da logo em vetor",
                            "Aplicações da logo na horizontal e vertical",
                            "Entrega da logo no negativo",
                            "Manual da marca",
                        ],
                    ],                    
                    [
                        "titulo" => "Identidade Visual",
                        "img" => "capas/icone-3.png",
                        "valor" => "R$890,00",
                        "observacao" => "Pagamento único",
                        "url" => "https://pag.ae/7--dHpKzs",
                        "destaques" => [
                            "Entrega da logo em vetor",
                            "Aplicações da logo na horizontal e vertical",
                            "Entrega da logo no negativo",
                            "Apresentação da empresa",
                            "Cartão de visita digital",
                            "Aplicações da logo",
                            "Papel timbrado",
                            "Reunião de modificação da apresentação",
                        ],
                    ],                    
                    [
                        "titulo" => "Outras artes",
                        "img" => "capas/icone-3.png",
                        "valor" => "",
                        "observacao" => "",
                        "url" => "",
                        "destaques" => [
                            "Folders, Flyer > R$ 120,00 por página",
                            "Cartão de visitas > R$ 120,00 arte digital",
                            "Outdoors > R$ 500,00 arte digital",
                            "Catálogo > R$ 80,00 arte digital",
                        ],
                    ],                    
                ];

            }else if($id == "criacao-de-sites"){
                //Ativando menu
                $solucoes = $this->getSolucoes();
                $solucoes[2]["active"] = "active";
                $ativarSistema = false;
                $info = [
                    "titulo" => "Criação de Sites",
                    "descricao" => "Oferecemos uma ampla gama de serviços, desde landing pages altamente convertíveis, até sites institucionais completos que refletem a identidade e os valores do seu negócio.<br>
                                    <br>Todos os nossos sites são responsivos, garantindo uma navegação perfeita em qualquer dispositivo, seja desktop, tablet ou smartphone. Além disso, desenvolvemos com foco em alta indexação no Google, aplicando as melhores práticas de SEO para que seu site tenha excelente visibilidade nos motores de busca, atraindo mais visitantes e potenciais clientes..
                    <br><br>
                    Em nossos projetos iniciamos sempre com uma reunião de briefing, entregamos o projeto 100% pronto conforme todo o combinado, e aplicamos as correções caso tenha.<br><br>
                    Alguns projetos online<br>
                    <a href='https://www.beeapp.com.br'>www.beeapp.com.br</a><br>
                    <a href='https://www.deltasoft.com.br'>www.deltasoft.com.br</a><br>
                    <a href='https://www.lucamaluca.com.br'>www.lucamaluca.com.br</a><br>
                    <a href='https://www.vorsautoparts.com'>www.vorsautoparts.com</a><br>
                    <a href='https://www.andiaraferreira.adv.br'>www.andiaraferreira.adv.br</a><br>
                    <a href='https://www.l2grepresentacao.com.br'>www.l2grepresentacao.com.br</a><br>
                    <a href='https://www.l3topografia.com.br'>www.l3topografia.com.br</a><br>
                    <a href='https://www.atomtech.tec.br'>www.atomtech.tec.br</a><br>
                    ",
                    "capa" => "capas/4.png",
                    "img-exemplo" => [
                        "site-5.png",
                        "site-6.png",
                        "site-7.png",
                        "site-9.png",
                    ],
                    "destaques" => [
                        "Layout 100% customizado para o cliente",
                        "Regras de negócio conforme a necessidade",
                        "Reunião de alinhamento",
                        "Reunião de entrega para correções",
                        "Alta conversão de SEO",
                        "Site em servidor próprio ou pela escolha do cliente",
                        "Templates únicos, exclusivos e profissionais",
                        "Sites Responsivos",
                        "Sites bonitos e atraentes",
                        "Landingpages de alta conversão",
                    ]
                ];
            $planos = [
                [
                    "titulo" => "Landingpages",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$800,00",
                    "observacao" => "à partir de",
                    "url" => "https://pag.ae/7--5xGv17",
                    "destaques" => [
                        "Página única de alto impacto",
                        "Cadastros das imagens, vídeos e textos",
                        "Cadastros dos Banners",
                        "Cadastros das palavras chaves para SEO",
                        "Cadastro de depoimentos",
                        "Cadastro das vantagens",
                        "Configuração do domínio, servidor e entrega",
                    ],
                ],  
                [
                    "titulo" => "Sites Institucionais",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$1.200,00",
                    "observacao" => "à partir de",
                    "url" => "https://pag.ae/7--4Ao7M8",
                    "destaques" => [
                        "Criação da Home",
                        "Criação dos Banners",
                        "Página Sobre nós",
                        "Paginas de produtos / serviços",
                        "Cadastro dos clientes",
                        "Área de blog",
                        "Criação da área de contato e botão do whatsapp",
                        "Criação da área de dúvidas da empresa",
                        "Sistemas CMS incluso",
                        "Links para redes sociais",
                        "12 meses de hospedagem bronze incluso",
                    ],
                ],  
                [
                    "titulo" => "E-commerce",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$2.500,00",
                    "observacao" => "à partir de",
                    "url" => "https://pag.ae/7--4A134t",
                    "destaques" => [
                        "Compra e configuração do domínio",
                        "Criação de acessos de usuário na plataforma",
                        "Configurações dos dados da empresa, pagamento e envio",
                        "Criação dos banners de destaque da loja",
                        "Cadastro das categorias",
                        "Cadastro dos produtos da loja",
                        "Construção nas melhores práticas de SEO",
                        "Treinamento incluso da plataforma",
                        "Mensalidade do e-commerce será pago ao nosso parceiro",
                    ],
                ],  
                [
                    "titulo" => "Hospedagem Bronze",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$19,90",
                    "observacao" => "valor mensal",
                    "url" => "https://pag.ae/7--4yahsP",
                    "destaques" => [
                        "1 à 5 e-emails",
                        "Servidor de alta velocidade SSD",
                        "24x7 horas funcionando",
                        "Suporte humano incluso",
                        "Domínio não incluso",
                    ],
                ],  
                [
                    "titulo" => "Hospedagem Prata",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$29,90",
                    "observacao" => "valor mensal",
                    "url" => "https://pag.ae/7--4yo5pt",
                    "destaques" => [
                        "5 à 10 e-emails",
                        "Servidor de alta velocidade SSD",
                        "24x7 horas funcionando",
                        "Suporte humano incluso",
                        "Domínio não incluso",
                    ],
                ],  
                [
                    "titulo" => "Hospedagem Ouro",
                    "img" => "capas/icone-5.png",
                    "valor" => "R$39,90",
                    "observacao" => "valor mensal",
                    "url" => "https://pag.ae/7--4yo5pt",
                    "destaques" => [
                        "10 à 30 e-emails",
                        "Servidor de alta velocidade SSD",
                        "24x7 horas funcionando",
                        "Suporte humano incluso",
                        "Domínio não incluso",
                    ],
                ],  
            ];

            }else if($id == "programacao-web"){
                //Ativando menu
                $solucoes = $this->getSolucoes();
                $solucoes[0]["active"] = "active";
                $ativarSistema = false;
                $info = [
                    "titulo" => "Programação Web",
                    "descricao" => "Trabalhamos com metodologias ágeis para entregar projetos de forma rápida e eficiente, sempre com foco na segurança, usabilidade e escalabilidade. Além disso, oferecemos suporte contínuo e atualizações, para que seu sistema esteja sempre em sintonia com as demandas do mercado e da tecnologia.",
                    "capa" => "capas/5.png",
                    "img-exemplo" => [
                        "sistema-beeapp.png",
                        "sistema-beeapp-responsivo.png",

                    ],
                    "destaques" => [
                        "Indicado para novos projetos",
                        "Designer UX",
                        "Laravel Framework",
                        "PHP",
                        "Vue.JS",
                        "Projetos escalonáveis",
                        "Desde do desenho até o projeto rodando no servidor",
                        "Compromisso e Qualidade",
                        "Paixão por códigos",
                        "Sistemas Responsivos",
                        "Sistemas Rápidos e seguros",
                        "Software Web, acesse em qualquer computador",
                    ]
                ];
                $planos = [
                    [
                        "titulo" => "Pacote 10 horas",
                        "img" => "capas/icone-6.png",
                        "valor" => "R$120,00",
                        "observacao" => "Por hora",
                        "url" => "https://pag.ae/7-ZVkAzb8",
                        "destaques" => [
                            "Programação Front-end",
                            "Programação Back-end",
                            "1 Reunião mensal",
                            "Instalação do sistema",
                            "Treinamento enquanto houver contrato",
                        ],
                    ],
                    [
                        "titulo" => "Pacote 40 horas",
                        "img" => "capas/icone-6.png",
                        "valor" => "R$100,00",
                        "observacao" => "Por hora",
                        "url" => "https://pag.ae/7-ZVmkjg8",
                        "destaques" => [
                            "Programação Front-end",
                            "Programação Back-end",
                            "2 Reuniões mensal",
                            "Instalação do sistema",
                            "Treinamento enquanto houver contrato",
                        ],
                    ],
                    [
                        "titulo" => "Pacote 80 horas",
                        "img" => "capas/icone-6.png",
                        "valor" => "R$80,00",
                        "observacao" => "Por hora",
                        "url" => "https://pag.ae/7-ZVn59r7",
                        "destaques" => [
                            "Programação Front-end",
                            "Programação Back-end",
                            "3 Reuniões mensal",
                            "Instalação do sistema",
                            "Treinamento enquanto houver contrato",
                        ],
                    ],
                ];


            } else if($id == "sistemas-prontos"){
              //Ativando menu
                $solucoes = $this->getSolucoes();
                $solucoes[1]["active"] = "active";
                $ativarSistema = true;
                $info = [
                    "titulo" => "Sistemas Prontos",
                    "descricao" => "Na J6 Soluções Digitais, recomendamos sistemas prontos para uso, com opções gratuitas ou versões de teste. Trabalhamos com parceiros confiáveis e abaixo listamos algumas soluções que foram testadas e aprovadas pela nossa equipe.",
                    "capa" => "capas/6.png",
                    "img-exemplo" => [],
                    "destaques" => [
                        "Sistemas aprovados e testados",
                        "Sistemas grátis",
                        "Sistemas com período de teste grátis",
                    ]
                ];
                $planos = [];
            }

            $seo = [
                "titulo" => Seo::title($info["titulo"]." - ".config('j6.nomeEmpresa')),
                "descricao" => Seo::metadescription($info["descricao"]),
            ];

            return view("templates.inovex.solucoes-single", [
                "solucoes" => $solucoes,
                "info" => $info,
                "seo" => $seo,
                "planos" => $planos,
                "ativarSistemas" => $ativarSistema,
            ]);
        }
    }//Fim soluções

    public function portfolio()
    {
        $menu = [
            [
                "tag" => "programacao-web",
                "titulo" => "Programação Web",
            ],
            [
                "tag" => "criacao-de-sites",
                "titulo" => "Criação de sites",
            ],                        
            [
                "tag" => "redes-sociais",
                "titulo" => "Redes Sociais",
            ],
            [
                "tag" => "artes-offline",
                "titulo" => "Artes Offline",
            ],

        ];

        $portfolio = [
            [
                "titulo" => "Flyer para padaria",
                "img" => "artes-digital-1.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Flyer para empresa de esportes",
                "img" => "artes-digital-2.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Catálogo digital e impresso para empresa Alux",
                "img" => "artes-digital-3.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Catálogo digital e impresso para empresa Kink Mix",
                "img" => "artes-digital-4.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Criação de Logomarcas",
                "img" => "artes-digital-5.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Criação de Logomarca Irauê Mini Mercado",
                "img" => "artes-digital-6.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Banners para e-commerce da empresa Alux",
                "img" => "artes-digital-7.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Folder 3 lados transportadora Gratidão",
                "img" => "artes-digital-8.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Panfleto de ofertas",
                "img" => "artes-digital-9.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Panfleto de ofertas",
                "img" => "artes-digital-10.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Rótulo para bebida",
                "img" => "artes-digital-11.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Cartão de visitas alto padrão",
                "img" => "artes-digital-12.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Criação de logomarca em dourado",
                "img" => "artes-digital-13.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Criação de logomarca em 3D",
                "img" => "artes-digital-14.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Arte para pastinha de documentos",
                "img" => "artes-digital-15.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Arte para cartão de visitas",
                "img" => "artes-digital-16.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Folder 2 dobras",
                "img" => "artes-digital-17.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Arte para embalagem de comida",
                "img" => "artes-digital-18.png",
                "menu" => $menu[3]
            ],
            [
                "titulo" => "Post para instagram",
                "img" => "post-1.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post para instagram escritório de advocacia",
                "img" => "post-2.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post para instagram clínica de estética",
                "img" => "post-3.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post para instagram empresa de energia solar",
                "img" => "post-4.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post para facebook Alux",
                "img" => "post-5.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post para redes sociais",
                "img" => "post-6.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post campanha redes sociais",
                "img" => "post-7.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post instagram",
                "img" => "post-8.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post instagram transportadora",
                "img" => "post-9.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post instagram transportadora",
                "img" => "post-10.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Post redes sociais empresa de tecnologia",
                "img" => "post-11.png",
                "menu" => $menu[2]
            ],
            [
                "titulo" => "Sistema BPO e CRM Beeapp",
                "img" => "sistema-beeapp.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Sistema controle de pontos corretor",
                "img" => "sistema-passe.png",
                "menu" => $menu[0]
            ],
            [
                "titulo" => "Website clínica de pediatria",
                "img" => "site-1.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Website empresa de container",
                "img" => "site-2.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Website empresa de container",
                "img" => "site-3.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Landingpage de alta conversão",
                "img" => "site-4.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Site personalizado",
                "img" => "site-5.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "E-commerce loja de roupas",
                "img" => "site-6.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Website empresa importadora de peças",
                "img" => "site-7.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Website escritório de advocacia",
                "img" => "site-8.png",
                "menu" => $menu[1]
            ],
            [
                "titulo" => "Website empresa de energia",
                "img" => "site-9.png",
                "menu" => $menu[1]
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
