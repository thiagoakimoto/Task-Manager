CREATE DATABASE IF NOT EXISTS to_do;
USE to_do;

CREATE TABLE task (
    id SERIAL PRIMARY KEY, #SERIAL aciona auto_increament automaticamente
    description VARCHAR(50) NOT NULL,
    completed BOOLEAN DEFAULT FALSE
);

