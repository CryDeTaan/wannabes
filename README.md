# Wannabes

Capture, search, and rate snippets for any domain.
Contributors get streetcred, and we all know it's all about the street cred. 

<p align="center" style="display: flex;">
<img style="height: 300px; margin-right: 15px; " src="https://user-images.githubusercontent.com/11268952/121777546-a8a14a00-cb8a-11eb-9a91-502df1dbde07.png" alt="light theme">
<img style="height: 300px;" src="https://user-images.githubusercontent.com/11268952/121777643-0fbefe80-cb8b-11eb-9560-c97e1aebe979.png" alt="dark theme">
</p>

## Installation
NOTE: Install process for development environment but similar for production.
1. Clone: `git clone git@github.com:CryDeTaan/wannabes.git`
2. Composer: `composer install`
3. Copy .env: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Set Environment requirements: Open / Edit .env 
6. npm: `npm install && npm run dev`
7. Migrate:  `php artisan migrate`
8. Seed (optional): `php artisan db:seed`


## License

The Wannabes framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
