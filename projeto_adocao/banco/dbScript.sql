create database adocao_Luan;
use adocao_Luan;

create table tbl_cao(
	id			tinyint primary key auto_increment,
    nome		varchar(244)	not null,
    raca		varchar(244)	not null,
    idade 		int				not null,
    descricao	text,
    imagem		varchar(244)	not null,
    adocao 		tinyint
);

ALTER TABLE tbl_cao 
MODIFY COLUMN adocao TINYINT(1) NOT NULL DEFAULT 0;

UPDATE tbl_cao SET adocao = 0 WHERE adocao IS NULL;

SELECT * FROM tbl_cao WHERE adocao = 0;

CREATE TABLE tbl_adotantes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  email VARCHAR(100),
  telefone VARCHAR(20),
  contato TEXT,
  experiencia TEXT,
  residencia TEXT,
  foto_adotante VARCHAR(255),
  foto_residencia VARCHAR(255)
);
