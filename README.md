# Chat Application API

The Chat Application API facilitates seamless integration of chat features into applications. It includes authentication, user and contact management, group chat, and messaging capabilities. Users can securely authenticate, manage contacts, engage in group conversations, and exchange messages in real-time.

## Getting Started

These instructions will help you set up and run the project locally on your machine.


### Built With

[![Laravel][Laravel]][Laravel-url]
[![MicrosoftSQL][MicrosoftSQL]][MicrosoftSQL-url]

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/CrisDismaya/chat-app-api.git && cd chat-app-api
   ```
2. Install Composer
   ```sh
   composer install
   ```
3. Run the migration
    ```sh
    php artisan migrate:fresh --seed
    ```
4. Compile and Hot-Reload for Development
    ```sh
    php artisan serve
    ```

## Contributing

We follow a conventional commits approach for our version control commits. This helps maintain clarity and consistency in our commit history, making it easier to understand the purpose and impact of each change.

A conventional commit message follows this structure:

```
<type>(scope(optional)): <space>[short description]
[body (optional)]
[footer (optional)]
```

Here are examples of commit messages for different scenarios:

- **Features**:
```
git commit -m 'feat(Module): verb followed by commit message here'
```
- **Bug Fixes** or **Hotfixes**:
```
git commit -m 'fix(Module): commit message here'
```

- **Major Changes** or **Breaking Changes**:
```
git commit -m 'feat(major changes): latest updates
BREAKING CHANGE: upgraded version'
```

Here are the commit types we use:

- `feat`: Adding a new feature to the application
- `fix`: Bug fixes
- `style`: Styling-related changes
- `refactor`: Code refactoring
- `test`: Changes related to testing
- `docs`: Documentation-related changes
- `chore`: Regular maintenance tasks

Adhering to this commit convention helps us maintain a clear and informative commit history.


<!-- MARKDOWN LINKS & IMAGES -->
[Php]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[Php-url]: https://www.php.net/

[JavaScript]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[JavaScript-url]: https://www.javascript.com/

[JQuery]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com/

[Laravel]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com/

[Vue]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D
[Vue-url]: https://vuejs.org/

[TypeScript]: https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white
[TypeScript-url]: https://www.typescriptlang.org/

[Bootstrap]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com/

[Python]: https://img.shields.io/badge/Python-14354C?style=for-the-badge&logo=python&logoColor=white
[Python-url]: https://www.python.org/

[PostgreSQL]: https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white
[PostgreSQL-url]: https://www.postgresql.org/

[MicrosoftSQL]: https://img.shields.io/badge/Microsoft_SQL_Server-CC2927?style=for-the-badge&logo=microsoft-sql-server&logoColor=white
[MicrosoftSQL-url]: https://www.microsoft.com/en-ph/


