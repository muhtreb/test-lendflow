# Install PHP dependencies using Composer
vendor:
	docker run --rm -v $(PWD):/app composer install

.PHONY: composer
composer:
	docker run --rm -v $(PWD):/app composer $(filter-out $@,$(MAKECMDGOALS))

.PHONY: test
test:
	docker run --rm -v $(PWD):/app -w /app php:8.4 php artisan test

.PHONY: serve
serve:
	docker run --rm -v $(PWD):/app -w /app -p 8000:8000 php:8.4 php artisan serve --host=0.0.0.0 --port=8000
