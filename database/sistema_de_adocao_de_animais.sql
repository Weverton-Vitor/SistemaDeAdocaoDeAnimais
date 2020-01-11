CREATE SCHEMA sistema_de_adocao_de_animais;

use sistema_de_adocao_de_animais;

CREATE TABLE animais (
  id int PRIMARY KEY AUTO_INCREMENT,
  tipo_id int,
  nome varchar(30) NOT NULL,
  peso decimal(3,2) NOT NULL,
  altura varchar(3) NOT NULL,
  raca varchar(40) NOT NULL,
  imagem varchar(200) NUll,
  situacao_medica varchar(100) NOT NULL,
  situacao_adocao char(1) NULL COMMENT 'S = Adotado\nN = Não adotado',
  updated_at timestamp NULL,
  created_at timestamp NULL
);

CREATE TABLE tipos (
  id int PRIMARY KEY AUTO_INCREMENT,
  nome varchar(40) NOT NULL
);

CREATE TABLE endereco_adotador (
  id int PRIMARY KEY AUTO_INCREMENT,
  cidade varchar(70) NOT NULL,
  cep char(8) NOT NULL,
  bairro varchar(70) NOT NULL,
  rua varchar(70)NOT NULL,
  numero_casa char(3) NOT NULL,
  updated_at timestamp NULL,
  created_at timestamp  NULL
);

CREATE TABLE pedido_adocao (
  id int PRIMARY KEY AUTO_INCREMENT,
  animal_id int,
  endereco_adotador_id int,
  nome_adotador varchar(70) NOT NULL,
  cpf_adotador int(11) NOT NULL,
  telefone_adotador char(11) NOT NULL,
  email_adotador varchar(50) NOT NULL,
  data_pedido date NOT NULL;
  situacao char(3) NOT NULL COMMENT 'A = Aprovado\nN = Não aprovado\nP = Não analizado',
  informacoes_adicionais VARCHAR(200) NUll,
  updated_at timestamp NULL,
  created_at timestamp NULL 
);

ALTER TABLE animais ADD CONSTRAINT fk_animal_tipo FOREIGN KEY (tipo_id) REFERENCES tipos(id);

ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_animal FOREIGN KEY (animal_id) REFERENCES animais (id);

ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_endereco_adotador FOREIGN KEY (endereco_adotador_id) REFERENCES endereco_adotador (id);

INSERT INTO tipos (nome) VALUES ('Cachorro');
INSERT INTO tipos (nome) VALUES ('Gato');

