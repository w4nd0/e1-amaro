# E1-Amaro

## Sobre o desafio

### Criação de API para cadastro e consulta de produtos

Você precisa criar uma API com os seguintes requisitos:

#### End-point para inserção de dados

-   O cliente poderá enviá-los em arquivos json ou xml e a API
    deverá inserir no banco de dados.
-   Escolha o banco de dados que achar melhor.

#### End-point para consulta destes produtos

-   Pode ser consultado por: id, nome ou tags. Caso a consulta seja por uma tag ou nome,
    deverá listar todos os produtos com aquela respectiva busca, poderá ser feito em um ou mais end-points.

### Link do deploy:

https://ex1-amaro.herokuapp.com/api/

### Instalação

Clonar o repositório e atualizar as dependências com:

```
composer install
```

## **Rotas**

#### **POST products/**

```
RESPONSE STATUS -> HTTP 201 (created)
```

Body:

Um arquivo em formato JSON ou XML

JSON

```
// products.json

{
  "products": [
    {
      "id": 8371,
      "name": "VESTIDO TRICOT CHEVRON",
      "tags": ["balada", "neutro", "delicado", "festa"]
    },
    {
      "id": 8367,
      "name": "VESTIDO MOLETOM COM CAPUZ MESCLA",
      "tags": ["casual", "metal", "metal"]
    }
  ]
}
```

XML

```
// products.xml

<?xml version="1.0" encoding="UTF-8"?>
<products>
    <element>
        <id>8371</id>
        <name>VESTIDO TRICOT CHEVRON</name>
        <tags>
            <element>balada</element>
            <element>neutro</element>
            <element>delicado</element>
            <element>festa</element>
        </tags>
    </element>
    <element>
        <id>8367</id>
        <name>VESTIDO MOLETOM COM CAPUZ MESCLA</name>
        <tags>
            <element>casual</element>
            <element>metal</element>
            <element>metal</element>
        </tags>
    </element>
</products>
```

Response:

```
{
  "success": "3 products added"
}
```

#### **GET products/**

Retorna os produtos.

Parâmetros de consulta: `/?tag=` e `/?product`.

```
RESPONSE STATUS -> HTTP 200 (ok)
```

Response:

```
[
  {
    "id": 8371,
    "name": "VESTIDO TRICOT CHEVRON"
  },
  {
    "id": 8367,
    "name": "VESTIDO MOLETOM COM CAPUZ MESCLA"
  },
  {
    "id": 8363,
    "name": "VESTIDO CURTO MANGA LONGA LUREX"
  }
]
```

#### **GET products/\<int:product_id>/**

Retorna o produto pelo seu ID.

```
RESPONSE STATUS -> HTTP 200 (ok)
```

Response:

```
{
  "id": "8371",
  "name": "VESTIDO TRICOT CHEVRON",
  "tags": [
    {
      "id": 1,
      "name": "balada"
    },
    {
      "id": 2,
      "name": "neutro"
    },
    {
      "id": 3,
      "name": "delicado"
    },
    {
      "id": 4,
      "name": "festa"
    }
  ]
}
```

#### Requisitos Obrigatórios

-   Ter uma cobertura de teste relativamente boa, a maior que você conseguir.
-   Usar PHP
-   Pode usar qualquer framework PHP para o desenvolvimento ou não usar nenhum, fica a sua escolha.
-   Criar um cache para consulta.

#### PLUS - Não necessário

-   Colocar uma autenticação JWT.
-   Usar PHP 7.1

## Orientações

-   Procure fazer uma API sucinta.
-   Os arquivos (json, xml) junto com o formato que o cliente irá enviar estão no repositório.
-   Pensa em escalabilidade, pode ser uma quantidade muito grande de dados.
-   Coloque isso em um repositório GIT.
-   Colocar as orientações de setup no README do seu repositório.
