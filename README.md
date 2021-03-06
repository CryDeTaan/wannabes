# Wannabes

Capture, search, and rate snippets for any domain.
Contributors get streetcred, and we all know it's all about the street cred. 

![image](https://user-images.githubusercontent.com/11268952/122160447-dd9ded00-ce67-11eb-9877-59e608b4f014.png)

![image](https://user-images.githubusercontent.com/11268952/122160554-0b833180-ce68-11eb-84fb-b0fbc58ec79c.png)

## Installation

#### **! PREREQUISITES !**

This project requires [MeiliSearch](https://www.meilisearch.com/) and the following resource is great to getting started
with [Searching with Laravel Scout and Meilisearch](https://www.youtube.com/playlist?list=PLfdtiltiRHWFs6FzuopS4nvnF6SckL7TN)
. Also, note the Laravel Scout options in the .evn file.

NOTE: Install process for development environment but similar for production.
1. Clone: `git clone git@github.com:CryDeTaan/wannabes.git`
2. Composer: `composer install`
3. Copy .env: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Set Environment requirements: Open / Edit .env 
6. npm: `npm install && npm run dev`
7. Migrate:  `php artisan migrate`
8. Seed (optional): `php artisan db:seed`

### Production
In production, I update three files:

- Terms and Conditions
- Privacy Policy
- About page


## Roadmap
- [x] Scalable searching
- [x] Comments on snippets
- [ ] Dynamically set Tag colour based on hex code
- [ ] Custom/personal tags
- [ ] ....

## Contributing
Thank you for considering contributing to Wannabes. The `development` branch is the default branch, and can be used to submit PRs.
The `main` branch can be used in production :)

## License

The Wannabes framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
