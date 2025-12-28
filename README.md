# Descrição do Projeto

Uma aplicação para criação e gerenciamento de chamados de suporte, utilizando Inteligência Artificial para gerar insights e resumos a partir dos relatórios dos técnicos.

## Objetivo
- Utilizar IA para proporcionar uma visão mais clara das operações e melhorar o planejamento da equipe de forma automatizada.
### Como?
- Gerando insights periódicos de acordo com o conteúdo do relatório dos técnicos e das ordens de serviços abertas pelos usuários
- O sistema funciona levando em consideração o fluxo de trabalho padrão em ambientes de help desk:
	1. Usuário abre um chamado 
	2. O chamado é atribuído a um responsável do setor de suporte
	3. Após a resolução, o técnico responsável pelo chamado preenche o `report`, informando como resolveu o problema
- Para gerar os insights, inicialmente serão realizados dois tipos de consultas as LLMs
	1. Para definir se o relatório é útil para uma análise geral periódica. Isso irá remover todos os relatórios em que a ação não é relevante para a análise geral.
    - Fluxo até a execução em segundo plano (via filas) da classificação do relatório pela LLM
    <img width="1357" height="593" alt="image" src="https://github.com/user-attachments/assets/906aabca-e7f8-4547-a034-6ede4b7ee5c6" />
    
	2. Análise geral que irá usar todos os relatórios úteis para fornecer métricas, como por exemplo:
		- **Volume de chamados por categoria**, permitindo identificar áreas com maior recorrência de falhas
		- **Tendências e padrões temporais**, como aumento de incidentes em períodos específicos
		- **Sugestões de ações preventivas**, baseadas em problemas recorrentes e soluções frequentemente aplicadas
		- **Indicadores de qualidade do atendimento**, inferidos a partir da clareza, completude e efetividade dos relatórios técnicos.
---

## Tecnologias Utilizadas

- **Backend:** PHP, Laravel
- **Recursos**: Observers, Eventos, Filas, Jobs
- **Dashboard Administrativo/Frontend:** Filament
- **Banco de Dados:** MySQL
- **Testes Automatizados:** Pest PHP
- **CI:** GitHub Actions
    

---

# Como Executar o Projeto

Siga os passos abaixo para configurar e executar esta aplicação Laravel.

---

## 1. Clonar o repositório

```bash
git clone https://github.com/ranyesantos/helpz.git
cd helpz
```

---

## 2. Instalar dependências

### Dependências PHP

```bash
composer install
```

### Dependências JavaScript

```bash
npm install
```

---

## 3. Configurar o arquivo de ambiente

```bash
cp .env.example .env
```

Em seguida, atualize as credenciais do banco de dados e outras variáveis necessárias.

Gere a chave da aplicação:

```bash
php artisan key:generate
```

---

## 4. Executar as migrations (e seeders, se necessário)

```bash
php artisan migrate
```

Ou com seeders:

```bash
php artisan migrate --seed
```

---

## 5. Iniciar o servidor de desenvolvimento

```bash
composer run dev
```

A aplicação estará disponível em:

```
http://localhost:8000
```

---

## 6. Executar os testes automatizados

Para executar todos os testes:

```bash
php artisan test
```
