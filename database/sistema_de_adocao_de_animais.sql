CREATE SCHEMA sistema_de_adocao_de_animais;

use sistema_de_adocao_de_animais;

CREATE TABLE animais (
  id int PRIMARY KEY AUTO_INCREMENT,
  tipo_id int NOT NULL,
  nome varchar(40) NOT NULL,
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

CREATE TABLE endereco_adotante (
  id int PRIMARY KEY AUTO_INCREMENT,
  cidade varchar(70) NOT NULL,
  cep char(9) NOT NULL,
  bairro varchar(70) NOT NULL,
  rua varchar(70)NOT NULL,
  numero_casa char(3) NOT NULL,
  updated_at timestamp NULL,
  created_at timestamp  NULL
);

CREATE TABLE dados_adotante(
  id int PRIMARY KEY AUTO_INCREMENT,
  endereco_adotante_id int NOT NULL,
  nome_adotante varchar(70) NOT NULL,
  cpf_adotante char(14) NOT NULL,
  telefone_adotante char(11) NOT NULL,
  email_adotante varchar(50) NOT NULL,
  updated_at timestamp NULL,
  created_at timestamp  NULL
);


CREATE TABLE pedido_adocao (
  id int PRIMARY KEY AUTO_INCREMENT,
  animal_id int NOT NULL,
  user_id int NUll,
  dados_adotante_id int NUll,
  data_pedido date NOT NULL,
  situacao char(3) NOT NULL COMMENT 'A = Aprovado\nN = Não aprovado\nP = Não analizado',
  informacoes_adicionais text NUll,
  updated_at timestamp NULL,
  created_at timestamp NULL 
);

ALTER TABLE animais ADD CONSTRAINT fk_animal_tipo FOREIGN KEY (tipo_id) REFERENCES tipos(id);

ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_animal FOREIGN KEY (animal_id) REFERENCES animais (id);

ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_dados_adontante FOREIGN KEY (dados_adotante_id) REFERENCES dados_adotante (id);

ALTER TABLE dados_adotante ADD CONSTRAINT fk_dados_adontante_endereco_adotante FOREIGN KEY (endereco_adotante_id) REFERENCES endereco_adotante (id);



INSERT INTO tipos (nome) VALUES ('Cachorro');
INSERT INTO tipos (nome) VALUES ('Gato');

