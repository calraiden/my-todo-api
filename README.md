### Instalacao

Instalacao de bibliotecas necessarias

Instalando o composer com .phar
```sh
$ php composer.phar update
```

Instalando o phpunit com .phar
```sh
$ wget --no-check-certificate https://phar.phpunit.de/phpunit.phar
$ mv phpunit-5.3.4.phar phpunit.phar #Talvez nao precise dessa linha
$ chmod +x phpunit.phar
$ sudo mv phpunit.phar /usr/local/bin/phpunit
$ phpunit --version
```

Usando o arquivo do composer.json
```sh
$ curl -sS https://getcomposer.org/installer | php
```


ou instalando individualmente
```sh
$ php composer.phar require guzzlehttp/guzzle
$ php composer.phar require phpunit/phpunit
$ php composer.phar joshtronic/php-loremipsum
```

### Testes

O TodoTest.php contem alguns testes básicos usando o phpunit

Importante ter instalado as bibliotecas acima via composer para os testes.

```sh
$ php phpunit.phar TodoTest.php
```

### Pastas

Diretorios utilizados

* docs, contem o skeleton do banco criado e outras arquivos relacionados
* todo, o projeto em si, com as classes para receber os metodos HTTP
* vendor, deve ser gerada com o composer


License
----
MIT

**Free Software, =) Yeah!**
