# Teste Dev Full-Stack

## Instruções

1. Clone o repositório e entre na pasta:

```bash
git clone git@github.com:WilliamSampaio/teste-dev-full-stack.git
cd teste-dev-full-stack
```

2. Utilizando o Docker e o Docker Compose execute o comando para subir os containers:

```bash
docker compose up -d --build
```

3. Apos os containers "subirem" execute o seguinte comando para instalar as dependências do Laravel:

```bash
docker exec -it tdfs-php composer new-install
```

Se tudo foi feito corretamente quatro containers devem estar "rodando", verifique executando o comando:

```bash
docker ps
```

Dentro da pasta **backend** existe o `Insomnia.json` você pode importar no Insomnia para testar os endpoints da API.

Caso precise popular a tabela **usuarios** com dados de teste execute o comando:

```bash
docker exec -it tdfs-php artisan db:seed
```
