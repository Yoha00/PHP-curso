----------------------// Enums //----------------------
CREATE TYPE cargo_tipo AS ENUM ('Adm', 'Funcionario');
CREATE TYPE status_maquina AS ENUM ('Disponivel', 'Ocupado', 'Manutenção');
CREATE TYPE tipo_manutencao AS ENUM ('Preventiva', 'Corretiva');
CREATE TYPE metodoPG AS ENUM ('Dinheiro', 'PIX', 'Crédito', 'Débito');
CREATE TYPE status_pg AS ENUM ('Pendente', 'Aprovado', 'Estornado');

----------------------// Tabelas //----------------------
CREATE TABLE tb_usuario (
    usu_codigo SERIAL PRIMARY KEY,
	usu_nome VARCHAR(100) NOT NULL,
	usu_CPF VARCHAR(11) UNIQUE,
    usu_email VARCHAR(150) UNIQUE,
    usu_senha VARCHAR(250),
   	usu_ultimoLogin TIMESTAMP,
    usu_dtCriacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usu_cargo cargo_tipo
);

CREATE TABLE tb_maquina (
    maq_codigo SERIAL PRIMARY KEY,
    maq_nome VARCHAR(50),
    maq_status status_maquina,
    maq_ultimaAtt TIMESTAMP,
    maq_total_Ciclos INT DEFAULT 0,
    maq_preco DECIMAL(10, 2)
);



CREATE TABLE tb_manutencao (
    man_codigo SERIAL PRIMARY KEY,
    maquina_cod INT,
    usuario_cod INT,
    man_tipoManut tipo_manutencao,
    man_desProblema VARCHAR(200),
    man_dtManut TIMESTAMP,  
    man_valorManut DECIMAL(10, 2),
    CONSTRAINT fk_manutencaoMaq FOREIGN KEY (maquina_cod) REFERENCES tb_maquina(maq_codigo),
    CONSTRAINT fk_usuarioMan FOREIGN KEY (usuario_cod) REFERENCES tb_usuario(usu_codigo)
);

CREATE TABLE tb_servicos (
    ser_codigo SERIAL PRIMARY KEY,
    ser_nome VARCHAR(100),
    ser_desServico VARCHAR(250),
    ser_preco_base DECIMAL(10, 2)
);

CREATE TABLE tb_uso_historico (
    ush_codigo SERIAL PRIMARY KEY,
    maquina_cod INT,
    funcionario_cod INT,
	servico_cod INT,
    ush_dt_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ush_dt_fim TIMESTAMP,
    ush_valorTotal_cobrado DECIMAL(10, 2),
    CONSTRAINT fk_maquina FOREIGN KEY (maquina_cod) REFERENCES tb_maquina(maq_codigo),
    CONSTRAINT fk_funcionario FOREIGN KEY (funcionario_cod) REFERENCES tb_usuario(usu_codigo),
	CONSTRAINT fk_servico FOREIGN KEY (servico_cod) REFERENCES tb_servicos(ser_codigo)
);

CREATE TABLE tb_pagamentos (
    pag_codigo SERIAL PRIMARY KEY,
    historico_cod INT,
    pag_metodo_pagamento metodoPG,
    pag_status status_pg, 
    pag_dt_pagamento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pgHistorico FOREIGN KEY(historico_cod) REFERENCES tb_uso_historico(ush_codigo)
);

CREATE TABLE tb_estoque(

    est_codigo SERIAL PRIMARY KEY,

    est_nome VARCHAR(100) NOT NULL,

    est_quantidade_atual DECIMAL(10, 2) DEFAULT 0,

    est_unidade_medida VARCHAR(20),

    est_estoque_minimo DECIMAL(10, 2),

    est_ultima_reposicao TIMESTAMP
);

CREATE TABLE tb_relatorio_insumo (

    rei_codigo SERIAL PRIMARY KEY,

    ser_cod INT,

    est_cod INT,

    rei_gasto_estimado DECIMAL(10, 2),

    CONSTRAINT fk_servico FOREIGN KEY (ser_cod) REFERENCES tb_servicos(ser_codigo),

    CONSTRAINT fk_produto FOREIGN KEY (est_cod) REFERENCES tb_estoque(est_codigo)

);

----------------------// Funções e triggers //----------------------
--// Função para ocupar a maquina após começar a ser usada
CREATE OR REPLACE FUNCTION fn_ocupar_maquina()
RETURNS TRIGGER AS $$ -- Retorna um sinal 
BEGIN -- Começa a troca da linha da maquina que estará ocupada
    UPDATE tb_maquina 
    SET maq_status = 'Ocupado' 
    WHERE maq_codigo = NEW.maquina_cod;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- Cria um trigger, depois de inserir no uso_historico, pra cada linha ele executa a função
CREATE TRIGGER trg_maquina_ocupada
AFTER INSERT ON tb_uso_historico 
FOR EACH ROW
EXECUTE FUNCTION fn_ocupar_maquina();

---------------------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_liberar_maquina()
RETURNS TRIGGER AS $$
BEGIN
    IF (NEW.ush_dt_fim IS NOT NULL AND OLD.ush_dt_fim IS NULL) THEN
        UPDATE tb_maquina 
        SET maq_status = 'Disponivel',
            maq_total_Ciclos = maq_total_Ciclos + 1
        WHERE maq_codigo = NEW.maquina_cod;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_maquina_liberada
AFTER UPDATE ON tb_uso_historico
FOR EACH ROW
EXECUTE FUNCTION fn_liberar_maquina();

-------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_maquina_em_manutencao()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE tb_maquina 
    SET maq_status = 'Manutenção' 
    WHERE maq_codigo = NEW.maquina_cod;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_maquina_manutencao
AFTER INSERT ON tb_manutencao
FOR EACH ROW
EXECUTE FUNCTION fn_maquina_em_manutencao();


----------------------------------------------------------------
CREATE OR REPLACE FUNCTION fn_estoque_por_servico()
RETURNS TRIGGER AS $$
BEGIN

    UPDATE tb_estoque
    SET est_quantidade_atual = est_quantidade_atual - rei.rei_gasto_estimado
    FROM tb_relatorio_insumo rei
    WHERE rei.est_cod = tb_estoque.est_codigo
    AND rei.ser_cod = NEW.servico_cod;
    RETURN NEW;

END;

$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_baixa_estoque
AFTER UPDATE ON tb_uso_historico
FOR EACH ROW
WHEN (NEW.ush_dt_fim IS NOT NULL AND OLD.ush_dt_fim IS NULL)
EXECUTE FUNCTION fn_estoque_por_servico();

