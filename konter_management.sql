--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

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
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: payments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payments (
    id bigint NOT NULL,
    tanggal date NOT NULL,
    jenis_layanan character varying(255) NOT NULL,
    lokasi_konter character varying(255) NOT NULL,
    nama_bank character varying(255) NOT NULL,
    nomor_rekening character varying(255) NOT NULL,
    atas_nama character varying(255) NOT NULL,
    jumlah_transfer character varying(255) NOT NULL,
    admin_transfer character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.payments OWNER TO postgres;

--
-- Name: payments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.payments_id_seq OWNER TO postgres;

--
-- Name: payments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payments_id_seq OWNED BY public.payments.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: payments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments ALTER COLUMN id SET DEFAULT nextval('public.payments_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2025_05_29_055734_craete_users_table	1
4	2025_05_29_072845_create_sessions_table	2
5	2025_05_29_142111_create_payments_table	3
\.


--
-- Data for Name: payments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.payments (id, tanggal, jenis_layanan, lokasi_konter, nama_bank, nomor_rekening, atas_nama, jumlah_transfer, admin_transfer, created_at, updated_at) FROM stdin;
3	2025-05-29	TARIK TUNAI	AE CELL	BRI	100000	USER	200000	5000	2025-05-29 15:24:56	2025-05-30 09:15:35
4	2025-05-16	TARIK TUNAI	ADP CELL	BRI	123123123	User3	100000	5000	2025-05-29 15:44:48	2025-05-30 09:15:41
5	2025-05-26	TARIK TUNAI	ADP CELL	BCA	123123123	Ujang	20000	5000	2025-05-30 03:04:53	2025-05-30 09:15:55
6	2025-05-15	TARIK TUNAI	AE CELL	BCA	123123123	Dodit	100000	10000	2025-05-30 03:07:36	2025-05-30 09:16:03
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
sWsFAj5I6TlWX1aVkApreZS6pltToMHB9pUVGERv	\N	127.0.0.1	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36	YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQTlZY1U3WkhLUndDUXRrZFg2ZXZYWVJCWERGNDdLc0JxRzJIUkxwTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9saXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX25hbWUiO3M6NToidXNlcjEiO30=	1748596564
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, password, created_at, updated_at) FROM stdin;
1	user1	user1@example.com	$2y$12$ExTLD8oKyUeyJDI4jQrCjOF5LnIkNMjoQyFPEQfuArNewCRWjDwD2	2025-05-29 09:02:52	2025-05-29 09:02:52
2	user2	user2@example.com	$2y$12$F6wws7QIRR2G1FT7x1BJX.RnNlGOUol91euUT6LiylsINBYYMqbSS	2025-05-29 10:09:38	2025-05-29 10:09:38
\.


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);


--
-- Name: payments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.payments_id_seq', 6, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: payments payments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- PostgreSQL database dump complete
--

