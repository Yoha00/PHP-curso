CREATE TABLE cadastro(
	adm_ID serial primary key,
	nome varchar(100) not null,
	email varchar(200) unique not null,
	dtNascimento date,
	dtCadastro timestamp not null default current_timestamp,
	senha varchar(250) not null
);

CREATE TABLE login(
	login_id serial primary key,
	adm_id int not null,
	dtlogin timestamp default current_timestamp,
	constraint fk_adm_id foreign key(adm_id) references cadastro(adm_ID) on delete cascade
);	

CREATE TABLE maquinas(
	maqid serial primary key,
	nome_maquina varchar(50) not null,
	status varchar(20) default 'Disponivel',
	preco_uso decimal(10, 2) not null,
	ultimaAtualizacao timestamp default current_timestamp
);
