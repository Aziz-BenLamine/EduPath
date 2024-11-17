CREATE TABLE Utilisateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE SujetForum (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    date_creation DATE NOT NULL,
    cree_par INT NOT NULL,
    FOREIGN KEY (cree_par) REFERENCES Utilisateur(id)
);

CREATE TABLE Publication (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL,
    cree_par INT NOT NULL,
    sujet INT NOT NULL,
    FOREIGN KEY (cree_par) REFERENCES Utilisateur(id),
    FOREIGN KEY (sujet) REFERENCES SujetForum(id)
);

CREATE TABLE Reponse (
    id INT PRIMARY KEY AUTO_INCREMENT,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL,
    cree_par INT NOT NULL,
    publication INT NOT NULL,
    FOREIGN KEY (cree_par) REFERENCES Utilisateur(id),
    FOREIGN KEY (publication) REFERENCES Publication(id)
);
