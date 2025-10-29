Farmácia Vila Boa

Descrição
Projeto simples de CRUD para controlar materiais/insumos de uma farmácia (ex.: Dipirona, Seringa 5 ml).
Feito em PHP 7+ (XAMPP) com PDO e prepared statements.

Estrutura do projeto
```
/ (root)
├─ index.php          # Página principal -> lista e busca
├─ create.php         # Formulário de criação
├─ edit.php           # Formulário de edição
├─ delete.php         # Deleção (POST)
├─ db.php             # Conexão PDO
├─ assets/
│  └─ style.css
├─ sql/
│  └─ schema.sql
└─ docs/
   ├─ ERD.png
   ├─ ERD.txt
   └─ usecase.txt
```

Requisitos
PHP 7+ (XAMPP)
MySQL (crie o banco com o script em `sql/schema.sql`)

Instalação local (XAMPP)
1. Copie a pasta `farmacia_vila_boa_crud` para `C:/xampp/htdocs/` (ou o diretório de projetos do seu XAMPP).
2. Inicie Apache e MySQL no painel do XAMPP.
3. Use o phpMyAdmin (http://localhost/phpmyadmin) ou linha de comando para executar `sql/schema.sql` para criar o banco `farmacia` e a tabela `insumos`.
4. Acesse no navegador: `http://localhost/farmacia_vila_boa_crud/index.php`

Usuário/Configuração
As configurações de conexão estão em `db.php`. Por padrão:
- host: localhost
- dbname: farmacia
- user: root
- password: (vazio)

Validações implementadas
- `nome` obrigatório
- `unidade` obrigatório
- `estoque_atual` >= 0 (inteiro)
- `preco` >= 0 (decimal)
Mensagens claras de erro e sucesso são exibidas.

Segurança básica
- Uso de PDO + prepared statements
- Saída com `htmlspecialchars()` para evitar XSS
- Checagem e escapes em entradas

Documentação
- `docs/ERD.png` imagem simples do Diagrama Entidade-Relacionamento
- `docs/ERD.txt` descrição textual do modelo
- `docs/usecase.txt` Diagrama de Caso de Uso textual
