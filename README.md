# Multidados

Esse projeto tem como objetivo, extrair dados sobre as Operadoras de Saúde do Brasil, a partir do conjunto de dados abertos da ANS, de acordo com o link: https://dados.gov.br/dados/conjuntos-dados/operadoras-de-planos-privados-de-saude

Atualmente ele se conecta na API: https://www.ans.gov.br/operadoras-entity/v1/swagger-ui/index.html?configUrl=/operadoras-entity/v1/v3/api-docs/swagger-config, e consome dois dos recursos.

GET /operadoras (Lista de Operadoras de Saúde do Brasil)
GET /operadoras/{registroAns} (Dados cadastrais das Operadoras)


## Configuração

Para configurar esse projeto localmente, basta clonas o repositório e executar o comando:

``` bash
$ composer install
```

## Utilização

Para utilizar o cliente, crie uma instância informando os dados de comunicação com a api, estes dados são fornecidos pela própria Multidados.

``` php

```

## Histórico de alterações

Por favor veja [CHANGELOG](CHANGELOG.md) para mais informações sobre o que mudou recentemente.

## Segurança

Se você descobrir qualquer problema , por favor, envie um e-mail para: raphael.fatecandos@gmail.com.

## Créditos

- [Raphael Godoi][https://github.com/raphagood]

## Licença

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.