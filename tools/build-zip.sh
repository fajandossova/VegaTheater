#!/bin/sh
# Собирает vega.zip для загрузки в WordPress («Внешний вид → Темы → Добавить → Загрузить»).
# Внутри архива — папка vega/ с темой.
set -e
cd "$(dirname "$0")/.."
rm -f vega.zip
zip -rq vega.zip vega -x 'vega/**/.DS_Store'
echo "Готово: $(pwd)/vega.zip"
