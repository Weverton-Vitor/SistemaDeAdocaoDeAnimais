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

CREATE TABLE users (
  id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  dados_adotante_id int NULL,
  name varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

CREATE TABLE pedido_adocao (
  id int PRIMARY KEY AUTO_INCREMENT,
  animal_id int NOT NULL,
  user_id int NUll COMMENT 'Para pedidos feitos pelo site com o usuário logado',
  dados_adotante_id int NUll COMMENT 'Para pedidos adicionados de forma manual',
  data_pedido date NOT NULL,
  situacao char(3) NOT NULL COMMENT 'A = Aprovado\nN = Não aprovado\nP = Não analizado',
  informacoes_adicionais text NUll,
  updated_at timestamp NULL,
  created_at timestamp NULL 
);

CREATE TABLE password_resets (
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  token varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL
);

CREATE TABLE dados_adotante(
  id int PRIMARY KEY AUTO_INCREMENT,  
  nome_adotante varchar(70) NOT NULL,
  cpf_adotante char(14) NOT NULL,
  telefone_adotante char(11) NOT NULL,
  email_adotante varchar(50) NOT NULL,
  cidade varchar(70) NOT NULL,
  cep char(9) NOT NULL,
  bairro varchar(70) NOT NULL,
  rua varchar(70)NOT NULL,
  numero_casa char(3) NOT NULL,
  updated_at timestamp NULL,
  created_at timestamp  NULL
);


/* Chave estrangeira da tabela tipo de animal na tabela animais*/
ALTER TABLE animais ADD CONSTRAINT fk_animal_tipo FOREIGN KEY (tipo_id) REFERENCES tipos(id);

/* Chave estrangeira da tabela animais na tabela pedido de pedidos de adoção*/
ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_animal FOREIGN KEY (animal_id) REFERENCES animais (id);

/* Chave estrangeira da tabela de dados do adontante na tabela de pedidos de adoção*/
ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_dados_adontante FOREIGN KEY (dados_adotante_id) REFERENCES dados_adotante (id);

/* Chave estrangeira da tabela usuários na tabela de pedidos de adoção*/
ALTER TABLE pedido_adocao ADD CONSTRAINT fk_pedido_adocao_user FOREIGN KEY (user_id) REFERENCES user (id);

/* Chave estrangeira da tabela de dados do adotantes na tabela users*/
ALTER TABLE users ADD CONSTRAINT fk_users_dados_adontante FOREIGN KEY (dados_adotante_id) REFERENCES dados_adotante (id);

/* Inserts padroes de tipos de animais*/
INSERT INTO tipos (nome) VALUES ('Cachorro');
INSERT INTO tipos (nome) VALUES ('Gato');

/* Usuário admin: 
login: admin@gmail.com
senha: 12345678
*/
INSERT INTO `users` (`id`, `dados_adotante_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(NUll, NULL, 'Admin', 'admin@gmail.com', NULL, '$2y$10$tLYTXiUXtGzfxZBfU/gd7OMNUk5ZlbApjOmI/Vco5P3dL7Mt3TxvS', NULL, NULL, NULL);

