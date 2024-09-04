# arch_calculator

### Установка на сервер:

Файлы prodaction находятся в папке dist.
все файлы необходимо загрузить в корневую папку сайта на сервере (publiс_html)


### Выходная часть проекта Папка dist :

Папка dist - это выход всего проекта который "ребилдиться" при внесении изменения в проект.
Папка с бекендом php. Исходная папка для бекенда-php находится в public.
В нее можно вносить изменения который будут обновлятся на выходе dist при ребилдинге проекта (npm run build)
Также в папку publiс можно добовлять необходимые паки котроые будут  на выходе.

### Фронтенд проекта.

Фронтенд проекта находится в папке scr.
Для инсталяции и запуска на локальном сервере
Необходим пакет node js и git   

### Установка Node.js

Node.js — это среда выполнения JavaScript. Установить Node.js можно, скачав установщик с официального сайта, или с помощью менеджера пакетов. Требуется версия 16 или 18 LTS.

Windows:
Установщик: https://nodejs.org/ru/download/
winget: winget install OpenJS.NodeJS.LTS
Chocolatey: choco install nodejs-lts
Mac:
Установщик: https://nodejs.org/ru/download/
brew: brew install node@18
Linux: https://nodejs.org/ru/download/package-manager/

### Установка Git

Git – это распределенная система контроля версий, инструмент, инструмент, без которого сложно представить современную разработку.

Установить git
https://git-scm.com/book/ru/v2/Введение-Установка-Git-Git

### Устанока для работы с фронтенд частью на vue 

Для инсталяции и запуска на локальном сервере
Необходим пакет node js и git

Можно скачать: 
```
git clone https://github.com/urzp/MediaNodes.git
```

Войти в папку проекта: 
```
cd media_node
```

Установка зависимостей: 
```
npm ci
```

Запуск на локальном сервере: 
```
npm run serve
```

Генерация выхоных файлов: 
```
npm run build
```



## Также другие команды от npm:

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
