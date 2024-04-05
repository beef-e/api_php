CREATE TABLE if not exists Film (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) not null,
    anno_di_uscita INT not null,
    sinossi TEXT default null
);

CREATE TABLE IF NOT EXISTS Regista (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    secondo_nome VARCHAR(255),
    cognome VARCHAR(255),
    data_di_nascita DATE
);

CREATE TABLE IF NOT EXISTS Attore (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    secondo_nome VARCHAR(255),
    cognome VARCHAR(255),
    data_di_nascita DATE
);

CREATE TABLE IF NOT EXISTS Genere (
    nome VARCHAR(255) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS Film_Regista (
    film_id INT,
    regista_id INT,
    PRIMARY KEY (film_id, regista_id),
    FOREIGN KEY (film_id) REFERENCES Film(id),
    FOREIGN KEY (regista_id) REFERENCES Regista(id)
);

CREATE TABLE IF NOT EXISTS Film_Attore (
    film_id INT,
    attore_id INT,
    PRIMARY KEY (film_id, attore_id),
    FOREIGN KEY (film_id) REFERENCES Film(id),
    FOREIGN KEY (attore_id) REFERENCES Attore(id)
);

-- @block Film_Genere
CREATE TABLE IF NOT EXISTS Film_Genere (
    film_id INT,
    genere_id VARCHAR(255),
    PRIMARY KEY (film_id, genere_id),
    FOREIGN KEY (film_id) REFERENCES Film(id),
    FOREIGN KEY (genere_id) REFERENCES Genere(nome)
);
