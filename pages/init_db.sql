-- init_db.sql — cria banco e tabelas para Missões do Dia
CREATE DATABASE IF NOT EXISTS missoes_do_dia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE missoes_do_dia;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS missoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  texto TEXT NOT NULL,
  experiencia TEXT,
  publico TINYINT(1) DEFAULT 0,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS avaliacoes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  id_missao INT NOT NULL,
  avaliacao TINYINT NOT NULL, -- 1 = like, -1 = dislike
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (id_missao) REFERENCES missoes(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_avaliacao (id_usuario, id_missao)
) ENGINE=InnoDB;


INSERT INTO usuarios (nome,email,senha_hash) VALUES
('Robert','robert@example.com','123'),
('Otavio','otavio@example.com','123'),
('Guilherme','guilherme@example.com','123'),
('Felipe','felipe@example.com','123');

INSERT INTO missoes (id_usuario,texto,experiencia,publico) VALUES
(1,'Ajudou alguém hoje','Foi muito legal! Contei minha experiência.',1),
(2,'Fez uma boa ação','Me senti muito bem!',1),
(3,'Ajudou um desconhecido','Dia incrível!',1),
(4,'Fez um elogio sincero','A pessoa sorriu muito!',1);
