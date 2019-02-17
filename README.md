# Idioma Booglan

Dicionário pergaminhos do antigo e misterioso idioma Booglan. Após muitos anos de estudo, os linguistas já conhecem algumas características desse idioma.

## Início

Para acessar os resultados acesse url-do-projeto/public 

## Estrutura de arquivos

```bash
├── app
│   ├── Models
│   │   ├── Booglan.php
│   ├── ├── Dicionario.php
│   ├── ├── NumeroBonito.php
│   ├── ├── Preposicao.php
│   ├── ├── Verbo.php
├── public
│   ├── index.php
├── vendor/
├── README.md
├── composer.json
├── app.php
├── texto-a.txt
├── texto-b.txt
└── .gitignore
```


### Pré-requisitos

Necessário uso do composer para fazer o autoload do arquivos usando psr-4

https://getcomposer.org/


### Instalacção

Dentro da pasta raiz do projeto, executar o composer para atualizar a pasta vendor do projeto

```
composer update
```

Após isso já pode acessar os resultados na pasta /public ex:http://localhost/nome-pasta-projeto/public/

## Autor

* **Josiano Carvalho** 


## Licença

This project is licensed under the MIT License - see the [LICENSE](https://opensource.org/licenses/MIT) file for details


