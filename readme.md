
# marmitaapi

Necessário realizar a instalação do composer. - https://getcomposer.org/download/
Após ter sido instalado o composer, executar:
    - composer install
    - copy .env.example .env / cp.env.example .env - (Necessário configurar as variáveis de ambiente do mysql) 
    - php artisan migrate:fresh --seed - (Irá criar as tabelas no banco mysql bem como seus atributos e gerar dados randômicos para utilizacao)
    - usuário para acesso no sistema: adm@adm.com / adm