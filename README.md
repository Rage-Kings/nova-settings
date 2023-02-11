## Astreya/Settings

[![pipeline status](https://git.astreya.app/astreya/settings/badges/master/pipeline.svg)](https://git.astreya.app/artemis/astreya/-/commits/master)
[![coverage report](https://git.astreya.app/astreya/settings/badges/master/coverage.svg)](https://git.astreya.app/artemis/astreya/-/commits/master)

## Установка
```composer install```

## Запуск проверки кода PSALM'ом
```psalm```

## Запуск проверки кода PHP Code Sniffer'ом
```phpcs```

## Запуск тестирования
```phpunit --configuration ./phpunit.xml.dist```

## Запуск тестирования с отчетом по покрытию кода тестами
Отчет будет находится в папке covers

```phpunit --configuration ./phpunit.xml.dist --coverage-html covers```