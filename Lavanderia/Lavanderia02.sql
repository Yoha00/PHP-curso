CREATE TABLE usuario(
	usuario_id SERIAL PRIMARY KEY,
	email VARCHAR(150),
	senha VARCHAR(250),
	ultimoLogin TIMESTAMP,
	dtCriacao DATE TIMESTAMP,
	cargo_usuario cargo_tipo
);

CREATE TABLE historico_uso(
	historico_id SERIAL PRIMARY KEY,
	maquina_id INT,
	funcionario_id INT,
	dt_inicio TIMESTAMP,
	dt_fim TIMESTAMP,
	valorTotal_cobrado DECIMAL(10, 2),
	CONSTRAINT fk_maquina FOREIGN KEY (maquina_id) REFERENCES maquinas(maq_id),
	CONSTRAINT fk_funcionario FOREIGN KEY (funcionario_id) REFERENCES usuario(usuario_id)
);

CREATE TYPE cargo_tipo AS ENUM(
	'Adm',
	'Funcionario'
);
------------------// //------------------ 

CREATE TABLE maquinas(
	maq_id SERIAL PRIMARY KEY,
	nome_maquina VARCHAR(50),
	status status_maquina,
	ultimaAtualizacao TIMESTAMP,
	totalCiclos INT,
	preco DECIMAL(10, 2)
);

CREATE TABLE manutencao(
	manutencao_id SERIAL PRIMARY KEY,
	maquina_id INT,
	usuario_id INT,
	tipoManut tipo_manutencao,
	desProblema VARCHAR(200),
	dtManut DATE TIMESTAMP,
	valorManut DECIMAL(10, 2),
	CONSTRAINT fk_manutencaoMaq FOREIGN KEY (maquina_id) REFERENCES maquinas(maq_id),
	CONSTRAINT fk_usuarioMan FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id)
);

CREATE TYPE status_maquina AS ENUM(
	'Disponivel',
	'Ocupado',
	'Manutenção'
)

CREATE TYPE tipo_manutencao AS ENUM(
	'Preventiva',
	'Corretiva'
)
------------------// //------------------ 
CREATE TABLE pagamentos(
	pagamento_id SERIAL PRIMARY KEY,
	historico_id INT,
	metodo_pagamento,
	status_pagamento,
	dt_pagamento TIMESTAMP,
	CONSTRAINT fk_pgHistorico FOREIGN KEY(historico_id) REFERENCES historico_uso(historico_id)
);