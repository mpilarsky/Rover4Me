--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2 (Debian 17.2-1.pgdg120+1)
-- Dumped by pg_dump version 17.2 (Debian 17.2-1.pgdg120+1)

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
-- Name: permissions; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.permissions (
    user_id integer NOT NULL,
    isadmin integer DEFAULT 0,
    ismod integer DEFAULT 0
);


ALTER TABLE public.permissions OWNER TO docker;

--
-- Name: reservations; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.reservations (
    id integer NOT NULL,
    user_id integer NOT NULL,
    name character varying(255) NOT NULL,
    location character varying(255) NOT NULL,
    frame_size character varying(50) NOT NULL,
    theme character varying(20) NOT NULL,
    reservation_date date NOT NULL,
    start_time time without time zone NOT NULL,
    end_time time without time zone NOT NULL,
    bike_type character varying(20) NOT NULL,
    CONSTRAINT reservations_bike_type_check CHECK (((bike_type)::text = ANY ((ARRAY['Górski'::character varying, 'Trekkingowy'::character varying, 'Miejski'::character varying, 'Elektryczny'::character varying])::text[]))),
    CONSTRAINT reservations_theme_check CHECK (((theme)::text = ANY ((ARRAY['Damski'::character varying, 'Męski'::character varying])::text[])))
);


ALTER TABLE public.reservations OWNER TO docker;

--
-- Name: reservations_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.reservations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reservations_id_seq OWNER TO docker;

--
-- Name: reservations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.reservations_id_seq OWNED BY public.reservations.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    name character varying(100) NOT NULL,
    surname character varying(100) NOT NULL,
    age integer NOT NULL
);


ALTER TABLE public.users OWNER TO docker;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO docker;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: reservations id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations ALTER COLUMN id SET DEFAULT nextval('public.reservations_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.permissions (user_id, isadmin, ismod) FROM stdin;
14	0	0
15	0	1
16	0	0
18	1	0
\.


--
-- Data for Name: reservations; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.reservations (id, user_id, name, location, frame_size, theme, reservation_date, start_time, end_time, bike_type) FROM stdin;
6	14	pierwsza	Kraków Czyżyny	21	Męski	2025-01-31	17:17:00	21:00:00	Elektryczny
7	14	druga	Kraków Prądnik Czerwony	19	Damski	2025-02-02	08:00:00	13:30:00	Miejski
8	16	rano	Warszawa	18	Męski	2025-01-23	14:00:00	17:15:00	Trekkingowy
9	16	wieczorem	Warszawa	19	Damski	2025-01-22	19:00:00	23:59:00	Miejski
10	16	inna	Olsztyn	16	Męski	2025-02-28	11:00:00	20:45:00	Elektryczny
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.users (id, email, password, name, surname, age) FROM stdin;
14	mpilarski8@gmail.com	$2y$10$pYdZeSU06dtTcVfb7a/.BuzS90r2zKjdm/iPw0zj5GDG27W66v8WC	Maciej	Pilarski	21
15	moderator@mod.pl	$2y$10$iD2he8FMdkMlLiNQjq423ugNYyvbF.CrtleDt46Z5yCrpKtZj/sN6	Jan	Nowak	18
16	dawid@gmail.com	$2y$10$/NICMZN5mZRVoiyL09AX2eW5nq9FHXKfJz9QCfBAeof.iK3IIe8Wm	Dawid	Pilarski	18
18	admin@admin.pl	$2y$10$K1cdHeb3n93IOp6qLKCgm.cEPgoV8wOGbKRT8cBJkilq.oH4uURq.	admin	admin	30
\.


--
-- Name: reservations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.reservations_id_seq', 12, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.users_id_seq', 18, true);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (user_id);


--
-- Name: reservations reservations_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: permissions permissions_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: reservations reservations_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

