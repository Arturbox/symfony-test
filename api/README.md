docker volume create postgresdata

docker compose up -d --force-recreate

docker compose exec php composer install

docker compose exec php php bin/console doctrine:schema:update --force

docker compose exec php php bin/console doctrine:fixtures:load

curl --location 'http://localhost:82/api/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE123456789",
"couponCode": "7QcLQyrNcQpT"
}'

curl --location 'http://localhost:82/api/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE123456789",
"couponCode": "7QcLQyrNcQpT",
"paymentProcessor": "paypal"
}'