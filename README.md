## Docker Compose

Este projeto inclui um arquivo `docker-compose.yml` que facilita a execução do back-end (Symfony), front-end e banco de dados PostgreSQL em ambientes isolados com Docker. Siga as instruções abaixo para configurar e iniciar os contêineres Docker.

### Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Configuração

1. Clone este repositório:

    ```bash
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2. Configure as variáveis de ambiente no arquivo `.env` no diretório do projeto.

### Execução com Docker Compose

1. Abra um terminal e navegue até o diretório do projeto.

2. Execute o seguinte comando para iniciar os contêineres:

    ```bash
    docker-compose up -d
    ```

3. Isso iniciará os contêineres em segundo plano. Aguarde até que todos os serviços estejam prontos.

4. Para parar os contêineres, use o seguinte comando:

    ```bash
    docker-compose down
    ```

### Acesso aos Serviços

- **Back-end Symfony:** Acesse [http://localhost:8000](http://localhost:8000)
- **Front-end:** Acesse [[http://localhost:8080](http://localhost:5173/)](http://localhost:5173/)
- **Banco de Dados PostgreSQL:** Conecte-se ao host `localhost` na porta `5432` usando as credenciais configuradas no arquivo `.env`.

### Observações

- Certifique-se de ajustar as configurações do Docker Compose conforme necessário, incluindo credenciais do banco de dados, diretórios de código-fonte, etc.

- Se precisar de mais detalhes sobre a configuração do Docker Compose ou tiver problemas, consulte a documentação oficial do Docker e do Docker Compose.

---

**Nota:** Certifique-se de ter o Docker e o Docker Compose instalados antes de executar os comandos acima.
