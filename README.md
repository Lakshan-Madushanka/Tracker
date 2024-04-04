<p align="center">
    <img src="https://github.com/abbasudo/laravel-purity/assets/47297673/20b5e0c5-3636-4c45-a5d5-c7dc8ff14c3f" width="800"/>
</p>

# Tracker
As programmers, we daily encounter errors and solve them. Keep remember all the solutions
with respective errors is not something possible. So there are massive chances you have to
confront the same error that you solved previously but forgotten the solution that previously
applied. Tracker is to solve that issue, with this will never forget the lesson you have learned.
In addition to that this provides link management feature, so you never forget links to important resources.

> [!Note]
> Here **error** means a general term. It can be anything you need to keep remember.

## Resources
### How it works
[![Video](https://github.com/Lakshan-Madushanka/Tracker/assets/47297673/f00aafb4-c565-457a-87d4-f16d70f07bab)](https://youtu.be/nuircvl2z4g)

## Requirements
- PHP >= 8.1
- composer

## Installation
### Local
- Clone the repository.
- copy .env.example to .env
- Open a terminal and run following commands
    - `composer install`
    - `npm run build or npm run dev`

### Docker
- `docker-compose up`
- URL - http://localhost:821/

### Sail
Consult the [documentation](https://laravel.com/docs/11.x/sail)

## Features
- Category management
- Track errors, bugs, issues ...etc. with solutions
  - search errors
  - filter errors by category
  - edit
  - delete
- Syntax highlighting
- Link management
- Responsive design (Ready to use in any device)

## Backup data
Spatie backup package is used. You can run below command. For more information
consult their [documentation](https://spatie.be/docs/laravel-backup/v8/introduction)

`php artisan backup:run`

## Running Tests
From the projects root folder run one of following commands

- `php artisan test`
- `composer test`
- `./vendor/bin/pest`

## Analyze the Codebase
`composer analyze` or `./vendor/bin/phpstan analyse`

## Contributing
We welcome all quality pull requests. While it's not mandatory, we highly encourage contributors to include test cases.

## License
This is an open-source project licensed under the [MIT](https://opensource.org/licenses/MIT) license.

## Support
If this product is of any use to you, please consider starring 🌟 the repository. Your support would be greatly appreciated and will help us evaluate how our future products should be.
