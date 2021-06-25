CREATE SCHEMA IF NOT EXISTS test;

CREATE TABLE IF NOT EXISTS test.table
(
    id          SERIAL NOT NULL CONSTRAINT table_pkey PRIMARY KEY,
    descricao   VARCHAR,
    label       VARCHAR,
    created_at  TIMESTAMP DEFAULT now(),
    updated_at  TIMESTAMP,
    deleted_at  TIMESTAMP
);

CREATE TABLE IF NOT EXISTS test.user
(
    id          SERIAL NOT NULL CONSTRAINT user_pkey PRIMARY KEY,
    login       VARCHAR,
    password    VARCHAR,
    created_at  TIMESTAMP DEFAULT now(),
    updated_at  TIMESTAMP,
    deleted_at  TIMESTAMP
);
