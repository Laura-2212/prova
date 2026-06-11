--
-- PostgreSQL database dump
--

\restrict sUpn65Funi3NSMNbwH91KuWqmAWPe4Abh16ikGGltmDk7fvadzrusxS15gy1ivY

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: aluguelfilme; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.aluguelfilme (
    id integer NOT NULL,
    cliente_id integer NOT NULL,
    data_aluguel date NOT NULL,
    data_devolucao date NOT NULL,
    filme_id integer,
    status character varying(20) DEFAULT 'alugado'::character varying
);


ALTER TABLE public.aluguelfilme OWNER TO postgres;

--
-- Name: aluguelfilme_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.aluguelfilme_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.aluguelfilme_id_seq OWNER TO postgres;

--
-- Name: aluguelfilme_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.aluguelfilme_id_seq OWNED BY public.aluguelfilme.id;


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clientes (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    senha character varying(255) NOT NULL
);


ALTER TABLE public.clientes OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clientes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.clientes_id_seq OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clientes_id_seq OWNED BY public.clientes.id;


--
-- Name: filme; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.filme (
    id integer NOT NULL,
    titulo character(1) NOT NULL,
    diretor character(1) NOT NULL,
    ano integer NOT NULL
);


ALTER TABLE public.filme OWNER TO postgres;

--
-- Name: filme_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.filme_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.filme_id_seq OWNER TO postgres;

--
-- Name: filme_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.filme_id_seq OWNED BY public.filme.id;


--
-- Name: filmesbyfuncionarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.filmesbyfuncionarios (
    id integer NOT NULL,
    titulo character varying(255) NOT NULL,
    imagem_url text NOT NULL,
    diretor character varying(100),
    ano_lancamento integer,
    sinopse text
);


ALTER TABLE public.filmesbyfuncionarios OWNER TO postgres;

--
-- Name: filmesbyfuncionarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.filmesbyfuncionarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.filmesbyfuncionarios_id_seq OWNER TO postgres;

--
-- Name: filmesbyfuncionarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.filmesbyfuncionarios_id_seq OWNED BY public.filmesbyfuncionarios.id;


--
-- Name: funcionarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.funcionarios (
    id integer NOT NULL,
    nome character(1) NOT NULL,
    cargo character(1) NOT NULL
);


ALTER TABLE public.funcionarios OWNER TO postgres;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.funcionarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.funcionarios_id_seq OWNER TO postgres;

--
-- Name: funcionarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.funcionarios_id_seq OWNED BY public.funcionarios.id;


--
-- Name: senha_funcionarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.senha_funcionarios (
    id integer NOT NULL,
    senha character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.senha_funcionarios OWNER TO postgres;

--
-- Name: senha_funcionarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.senha_funcionarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.senha_funcionarios_id_seq OWNER TO postgres;

--
-- Name: senha_funcionarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.senha_funcionarios_id_seq OWNED BY public.senha_funcionarios.id;


--
-- Name: aluguelfilme id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aluguelfilme ALTER COLUMN id SET DEFAULT nextval('public.aluguelfilme_id_seq'::regclass);


--
-- Name: clientes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes ALTER COLUMN id SET DEFAULT nextval('public.clientes_id_seq'::regclass);


--
-- Name: filme id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filme ALTER COLUMN id SET DEFAULT nextval('public.filme_id_seq'::regclass);


--
-- Name: filmesbyfuncionarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filmesbyfuncionarios ALTER COLUMN id SET DEFAULT nextval('public.filmesbyfuncionarios_id_seq'::regclass);


--
-- Name: funcionarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionarios ALTER COLUMN id SET DEFAULT nextval('public.funcionarios_id_seq'::regclass);


--
-- Name: senha_funcionarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.senha_funcionarios ALTER COLUMN id SET DEFAULT nextval('public.senha_funcionarios_id_seq'::regclass);


--
-- Data for Name: aluguelfilme; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.aluguelfilme (id, cliente_id, data_aluguel, data_devolucao, filme_id, status) FROM stdin;
1	1	2026-06-02	2026-06-04	\N	alugado
2	1	2026-06-02	2026-06-04	\N	alugado
3	2	2026-06-09	2026-06-11	\N	alugado
4	4	2026-06-09	2026-06-11	\N	alugado
5	5	2026-06-09	2026-06-11	\N	alugado
6	5	2026-06-09	2026-06-11	\N	alugado
7	5	2026-06-09	2026-06-11	\N	alugado
8	5	2026-06-09	2026-06-11	\N	alugado
9	1	2026-06-09	2026-06-11	\N	alugado
10	1	2026-06-11	2026-06-13	\N	alugado
11	5	2026-06-11	2026-06-13	8	alugado
12	8	2026-06-11	2026-06-13	9	alugado
13	5	2026-06-11	2026-06-13	6	alugado
14	10	2026-06-11	2026-06-13	1	alugado
15	11	2026-06-11	2026-06-13	5	alugado
\.


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.clientes (id, nome, email, senha) FROM stdin;
1	laura	laura@gmail	2212
2	sasa	jhgjhjhg@gdfg	2212
3	dff	hjjhj@gf	2212
4	lalala	lalalal@gmail	2212
5	lala	laurananana0@gmail.com	2212
6	lala	lalalala@gmail	221225
7	pp	pp@gmail	0108
8	pp	pp@gmail.com	240126
9	lalaa	laura.lalal@gmail	2212
10	pp	lanaro0108@gmail.com	240126
11	kmaiap	kaymaiap@gmail.com	12345
\.


--
-- Data for Name: filme; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.filme (id, titulo, diretor, ano) FROM stdin;
\.


--
-- Data for Name: filmesbyfuncionarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.filmesbyfuncionarios (id, titulo, imagem_url, diretor, ano_lancamento, sinopse) FROM stdin;
12	Todo Mundo em Pânico 3	https://upload.wikimedia.org/wikipedia/pt/f/f9/ScaryMovie3.jpg	David Zucker	2003	Após a repórter de jornal Cindy assistir acidentalmente uma estranha fita de vídeo que faz com que o espectador morra numa semana, ela descobre que a fita é apenas um dos muitos acontecimentos estranhos recentes. Os agricultores locais Tom e George relataram círculos enormes que aparecem durante a noite em seus campos. Cindy encontra uma ligação entre a fita e os círculos nas plantações com a ajuda do presidente dos Estados Unidos e uma tia gentil.
8	A proposta	https://br.web.img3.acsta.net/medias/nmedia/18/87/29/75/19874043.jpg	Anne Fletcher	2009	Margaret Tate é uma poderosa editora de livros que corre o risco de ser deportada para o Canadá, seu país natal. Para poder permanecer em Nova York, ela diz estar noiva de Andrew, seu assistente. O jovem aceita ajudá-la, mas impõe algumas condições, entre elas ir para o Alasca e conhecer sua família excêntrica. Com um oficial da imigração sempre à espreita, Margaret e Andrew têm que seguir o plano de casamento apesar de diversos problemas.
6	A revolução dos bichos	https://br.web.img3.acsta.net/img/4c/02/4c0256253f88db9be509b39b1a26bb06.jpg	Andy Serkis	2026	Dirigido por Andy Serkis, A Revolução dos Bichos é ambientado em uma fazenda, onde um movimento em busca da igualdade é sistematizado pelos animais. Inspirado no livro de George Orwell, a história mostra um movimento de revolução e poder, onde sob o comando dos porcos, uma fazenda perde parte de sua vitalidade. Entrando em uma ditadura implacável, os animais se reúnem para lutar prelos próprios direitos.
5	Juntos	https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDcHoGZYefW5HcnZ9qaGv0WAymza636Sec5A&s	 Michael Shanks	2025	Tim e Millie se encontram em uma encruzilhada quando se mudam para o interior. Com as tensões já à flor da pele, um encontro aterrorizante com uma força misteriosa e antinatural ameaça corromper suas vidas, seu amor e sua carne.
1	Enrolados	https://acdn-us.mitiendanube.com/stores/004/687/740/products/pos-03016-e748d6220d43874eaa17181201478736-1024-1024.webp	Nathan Greno e Byron Howard	2011	O bandido mais procurado do reino, Flynn Rider, se esconde em uma torre e acaba prisioneiro de Rapunzel, residente de longa data do local. Dona de cabelos dourados e mágicos com 21 metros de comprimento, ela está trancada há anos e deseja desesperadamente a liberdade. A adolescente determinada faz um acordo com o rapaz, e, juntos, partem para uma aventura emocionante.
9	homem-aranha no aranhaverso	https://www.sonypictures.com.br/sites/brazil/files/2023-06/1400x2100.jpg	 Peter Ramsey, Bob Persichetti, Rodney Rothman	2019	Após ser atingido por uma teia radioativa, Miles Morales, um jovem negro do Brooklyn, se torna o Homem-Aranha, inspirado no legado do já falecido Peter Parker. Entretanto, ao visitar o túmulo de seu ídolo em uma noite chuvosa, ele é surpreendido com a presença do próprio Peter, vestindo o traje do herói por baixo de um sobretudo. A surpresa fica ainda maior quando Miles descobre que ele veio de uma dimensão paralela, assim como outras versões do Homem-Aranha.
10	Todo Mundo em Pânico	https://upload.wikimedia.org/wikipedia/pt/thumb/d/d8/ScaryMovie.jpg/250px-ScaryMovie.jpg	Keenen Ivory Wayans	2000	Após escaparem de um assassino mascarado suspeitosamente familiar, Shorty, Ray, Cindy e Brenda tornam-se alvos de um novo maníaco mascarado.
11	Todo Mundo em Pânico 2	https://upload.wikimedia.org/wikipedia/pt/6/61/ScaryMovie2.jpg	Keenen Ivory Wayans	2001	Cindy, Ray, Shorty e Brenda tentam superar os eventos traumáticos do Halloween anterior. Um projeto escolar os leva à Casa do Inferno, local de um exorcismo malsucedido. Enfrentando medos passados, o grupo se vê em uma nova e assustadora aventura.
\.


--
-- Data for Name: funcionarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.funcionarios (id, nome, cargo) FROM stdin;
\.


--
-- Data for Name: senha_funcionarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.senha_funcionarios (id, senha, created_at, updated_at) FROM stdin;
1	12345678	2026-06-02 09:53:35.975339	2026-06-02 09:53:35.975339
\.


--
-- Name: aluguelfilme_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.aluguelfilme_id_seq', 15, true);


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_id_seq', 11, true);


--
-- Name: filme_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.filme_id_seq', 1, false);


--
-- Name: filmesbyfuncionarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.filmesbyfuncionarios_id_seq', 12, true);


--
-- Name: funcionarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.funcionarios_id_seq', 1, false);


--
-- Name: senha_funcionarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.senha_funcionarios_id_seq', 1, false);


--
-- Name: aluguelfilme aluguelfilme_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aluguelfilme
    ADD CONSTRAINT aluguelfilme_pkey PRIMARY KEY (id);


--
-- Name: clientes clientes_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_email_key UNIQUE (email);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- Name: filme filme_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filme
    ADD CONSTRAINT filme_pkey PRIMARY KEY (id);


--
-- Name: filmesbyfuncionarios filmesbyfuncionarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.filmesbyfuncionarios
    ADD CONSTRAINT filmesbyfuncionarios_pkey PRIMARY KEY (id);


--
-- Name: funcionarios funcionarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.funcionarios
    ADD CONSTRAINT funcionarios_pkey PRIMARY KEY (id);


--
-- Name: senha_funcionarios senha_funcionarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.senha_funcionarios
    ADD CONSTRAINT senha_funcionarios_pkey PRIMARY KEY (id);


--
-- Name: aluguelfilme fk_aluguel_filme; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aluguelfilme
    ADD CONSTRAINT fk_aluguel_filme FOREIGN KEY (filme_id) REFERENCES public.filmesbyfuncionarios(id) ON DELETE CASCADE;


--
-- Name: aluguelfilme fk_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.aluguelfilme
    ADD CONSTRAINT fk_cliente FOREIGN KEY (cliente_id) REFERENCES public.clientes(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict sUpn65Funi3NSMNbwH91KuWqmAWPe4Abh16ikGGltmDk7fvadzrusxS15gy1ivY

