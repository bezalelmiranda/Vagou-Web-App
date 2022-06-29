<?php 

include_once './Conn.php';

//classe que vai fazer o crud
class Crud {

    public object $conn;
    public array $formData;
    public array $db;

    public function logarUser(): array
    {
        // $this->conn = $this->connectDb();
        $query_usuarios = "SELECT id, nome, email, brapa, niveis_acesso_id FROM usuarios WHERE email=:email LIMIT 1";
        $result_usuarios = $this->conn->prepare($query_usuarios);
        $result_usuarios->bindParam(':email', $this->db['email']);
        $result_usuarios->execute();
        
        return $result_usuarios->fetchAll();
    }

    public function listarUsuarios(): array //Função que lista os usuarios
    {
        // $this->conn = $this->connectDb();
        //Comando SQL de busca no banco lista tabelas usuario nivel de acesso e plano 
        $query_usuario = "SELECT usr.id, usr.nome, usr.celular, usr.cpf, usr.email, usr.created, nvl.nivel, pl.plano
                       FROM usuarios AS usr 
                       INNER JOIN niveis_acesso AS nvl ON nvl.id=usr.niveis_acesso_id
                       INNER JOIN planos AS pl ON pl.id=usr.plano_id
                       ORDER BY id DESC LIMIT 4";
        $result_usuario = $this->conn->prepare($query_usuario);
        $result_usuario->execute();

        return $result_usuario->fetchAll();
    }

    public function listarEndereco()
    {
        // $this->conn = $this->connectDb();
        $query_endereco = "SELECT cep, rua, numero, complemento, bairro, cidade FROM enderecos ORDER BY id DESC LIMIT 4";
        $result_endereco = $this->conn->prepare($query_endereco);
        $result_endereco->execute();

        return $result_endereco->fetchAll();
    }

    public function listarVeiculo()
    {
        // $this->conn = $this->connectDb();
        $query_veiculo = "SELECT modelo, marca, placa FROM veiculos ORDER BY id DESC LIMIT 4";
        $result_veiculo = $this->conn->prepare($query_veiculo);
        $result_veiculo->execute();
 
        return $result_veiculo->fetchAll();
    }

    public function listarVagasLivres(): array //Função que lista vagas livres
    {
        // $this->conn = $this->connectDb();
        $query_vagas = "SELECT * FROM vagas WHERE hora_entrada < 1 ";
        $result_vagas = $this->conn->prepare($query_vagas);
        $result_vagas->execute();
        return $result_vagas->fetchAll();
    }

    public function listarVagasOcupadas(): array //Fução que lista vagas Ocupadas
    {
        // $this->conn = $this->connectDb();
        $query_vagas = "SELECT * FROM vagas WHERE hora_entrada > 1 ";
        $result_vagas = $this->conn->prepare($query_vagas);
        $result_vagas->execute();
        return $result_vagas->fetchAll();
    }

    public function Cadastro(): bool 
    {
        //var_dump($this->formData);
        // $this->conn = $this->connectDb();
        $query_cadastrar = "INSERT INTO usuarios (nome, celular, cpf, email, brapa, plano_id, niveis_acesso_id, created) 
                            VALUES (:nome, :celular, :cpf, :email, :brapa, :plano_id, :niveis_acesso_id, NOW())";
        $add_cadastro = $this->conn->prepare($query_cadastrar);
        $add_cadastro->bindParam(':nome', $this->formData['nome']);
        $add_cadastro->bindParam(':celular', $this->formData['celular']);
        $add_cadastro->bindParam(':cpf', $this->formData['cpf']);
        $add_cadastro->bindParam(':email', $this->formData['email']);
        $add_cadastro->bindParam(':brapa', $this->formData['brapa']);
        $add_cadastro->bindParam(':plano_id', $this->formData['planos']);
        $add_cadastro->bindParam(':niveis_acesso_id', $this->formData['nivel-acesso']);
        $add_cadastro->execute();

        $id_usuario = $this->conn->lastInsertId();

        $query_endereco = "INSERT INTO enderecos (cep, rua, numero, complemento, bairro, cidade, usuario_id, created)
                            VALUES (:cep, :rua, :numero, :complemento, :bairro, :cidade, :usuario_id, NOW())";
        $add_endereco = $this->conn->prepare($query_endereco);
        $add_endereco->bindParam(':cep', $this->formData['cep']);
        $add_endereco->bindParam(':rua', $this->formData['rua']);
        $add_endereco->bindParam(':numero', $this->formData['numero']);
        $add_endereco->bindParam(':complemento', $this->formData['complemento']);
        $add_endereco->bindParam(':bairro', $this->formData['bairro']);
        $add_endereco->bindParam(':cidade', $this->formData['cidade']);
        $add_endereco->bindParam(':usuario_id', $id_usuario);
        $add_endereco->execute();

        $query_veiculo = "INSERT INTO veiculos (modelo, marca, placa, usuario_id, created)
                            VALUES (:modelo, :marca, :placa, :usuario_id, NOW())";
        $add_veiculo = $this->conn->prepare($query_veiculo);
        $add_veiculo->bindParam(':modelo', $this->formData['modelo']);
        $add_veiculo->bindParam(':marca', $this->formData['marca']);
        $add_veiculo->bindParam(':placa', $this->formData['placa']);
        $add_veiculo->bindParam(':usuario_id', $id_usuario);
        $add_veiculo->execute();


        if(($add_cadastro->rowCount()) && ($add_endereco->rowCount()) && ($add_veiculo->rowCount())){
            return true;
        } else {
            return false;
        }
        
    }
}
