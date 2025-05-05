up:
	docker-compose up -d web

build:
	docker-compose up -d --build web

stop:
	docker stop $(shell docker ps -q)

rm:
	docker rm $(shell docker ps -aq)

down:
	docker-compose down

reset:
	docker-compose down -v --remove-orphans

bash:
	docker-compose exec web bash

node:
	docker-compose run node bash

node-version:
	docker-compose run node bash -c "node --version"

npm-install:
	docker-compose run node bash -c "npm install"

npm-dev:
	docker-compose run node bash -c "npm run dev"

npm-setup:
	docker-compose run node bash -c "npm init -y"

npm-lib:
	docker-compose run node bash -c "npm install vite typescript sass jquery gsap swiper --save-dev"

npm-init:
	@make npm-setup
	@make npm-lib
