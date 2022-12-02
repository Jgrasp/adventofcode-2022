docker-up:
	docker compose up -d

docker-restart:
	docker compose restart

docker-ssh:
	docker exec -it adventofcode-web-1 /bin/sh

docker-day1:
	docker exec -it adventofcode-web-1 php bin/console adventofcode:day:1