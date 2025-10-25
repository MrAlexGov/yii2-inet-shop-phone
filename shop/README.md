# Интернет-магазин сотовых телефонов

Современный интернет-магазин по продаже сотовых телефонов и аксессуаров, построенный на фреймворке Yii2 с использованием Advanced Template.

## 🚀 Возможности

- **Каталог товаров** с фильтрацией и поиском
- **Корзина покупок** с управлением количеством
- **Просмотр товаров** с галереей изображений
- **Система категорий и брендов**
- **EAV модель** для характеристик товаров
- **Отзывчивая дизайн** на Bootstrap 5
- **Модульная архитектура** для расширения функционала
- **RESTful API** готовность для мобильных приложений
- **Админ панель** с RBAC (роли и разрешения)
- **CRUD операции** для товаров, заказов, пользователей
- **Dashboard** с статистикой и метриками
- **Импорт/экспорт** товаров в CSV

## 📋 Требования

- **PHP** 7.4 или выше
- **MySQL** 5.7+ или **PostgreSQL**
- **Composer** для управления зависимостями
- **Web сервер** (Apache/Nginx) с поддержкой URL rewriting

## 🛠 Установка

### 1. Клонирование проекта

```bash
git clone <repository-url>
cd yii2-shop
```

### 2. Установка зависимостей

```bash
composer install
```

### 3. Настройка базы данных

Создайте базу данных MySQL:

```sql
CREATE DATABASE yii2advanced CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Обновите параметры подключения в файле `common/config/main-local.php`:

```php
'db' => [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
    'username' => 'root',
    'password' => 'rootpassword', // Ваш пароль от MySQL
    'charset' => 'utf8mb4',
],
```

### 4. Инициализация проекта

```bash
php init
```

Выберите окружение:
- `0` - Development (для разработки)
- `1` - Production (для продакшена)

### 5. Применение миграций

```bash
php yii migrate
```

Это создаст все необходимые таблицы в базе данных, включая RBAC таблицы для ролей и разрешений.

### 6. Применение RBAC миграций

```bash
php yii migrate/up --migrationPath=@yii/rbac/migrations
php yii migrate/up
```

Это создаст роли: admin, manager, user с соответствующими разрешениями и админ пользователя.

### 7. Применение финальной миграции (создание админа)

```bash
php yii migrate/up
```

Это создаст админ пользователя с учетными данными:
- **Username:** admin
- **Email:** admin@example.com
- **Password:** password123
- **Роль:** admin (полный доступ к админ панели)

Если пользователь admin уже существует, миграция просто назначит ему роль admin.

### 6. Настройка веб-сервера

#### Apache
Убедитесь, что модуль `mod_rewrite` включен и создайте `.htaccess`:

```apache
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . index.php
```

#### Nginx
```nginx
location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

### 7. Права доступа

```bash
chmod -R 777 runtime/
chmod -R 777 web/assets/
chmod -R 755 yii
```

## 🚦 Запуск

### Frontend (публичная часть)
```bash
php yii serve --docroot=frontend/web
```

Откройте браузер и перейдите на `http://localhost:8080`

### Backend (админ панель)
```bash
php yii serve --docroot=backend/web --port=8081
```

Админ панель доступна по `http://localhost:8081`

#### 🔐 Доступ к админ панели

Админ пользователь создан автоматически при применении миграций:

- **Username:** admin
- **Password:** password123
- **Email:** admin@example.com
- **Роль:** admin (полный доступ)

**Логин в админ панель:**
- Перейдите на `http://localhost:8081/site/login`
- Войдите под учетными данными: admin / password123
- Роли: admin (полный доступ), manager (товары и заказы), user (просмотр)

**Управление ролями:**
```bash
php yii rbac/assign admin 1     # Назначить роль
php yii rbac/revoke admin 1    # Отозвать роль
php yii rbac/assign manager 1  # Назначить роль manager
```

## 📖 Использование

### Каталог товаров

- **Главная страница каталога**: `/catalog`
- **Просмотр товара**: `/catalog/1` (где 1 - ID товара)
- **Фильтрация**:
  - По категории
  - По бренду
  - По цене (мин/макс)
  - Поиск по названию

### Корзина

- **Просмотр корзины**: `/cart`
- **Добавление товара**: `/cart/add/1` (где 1 - ID товара)
- **Изменение количества**: `/cart/update/1?quantity=2`
- **Удаление товара**: `/cart/remove/1`
- **Очистка корзины**: `/cart/clear`

### Примеры URL

#### Frontend
- Каталог: `http://localhost:8080/catalog`
- Товар: `http://localhost:8080/catalog/1`
- Корзина: `http://localhost:8080/cart`
- Регистрация: `http://localhost:8080/site/signup`
- Логин: `http://localhost:8080/site/login`

#### Backend (Админ панель)
- Логин: `http://localhost:8081/site/login`
- Dashboard: `http://localhost:8081/dashboard`
- Товары: `http://localhost:8081/products`
- Заказы: `http://localhost:8081/orders`
- Пользователи: `http://localhost:8081/users`
- Экспорт товаров: `http://localhost:8081/products/export`
- Импорт товаров: `http://localhost:8081/products/import`

### Админ панель

#### 📊 Dashboard
- Обзор статистики: пользователи, заказы, товары, выручка
- Список последних заказов
- Доступ: admin, manager

#### 🛒 Управление товарами
- CRUD операции для товаров
- Фильтрация и поиск
- Импорт/экспорт в CSV
- Управление изображениями (расширяемо)
- Доступ: admin, manager

#### 📦 Управление заказами
- Просмотр списка заказов
- Изменение статусов заказов
- Детали заказа с товарами
- Доступ: admin, manager

#### 👥 Управление пользователями
- CRUD для пользователей
- Назначение ролей (RBAC)
- Просмотр профилей
- Доступ: admin только

#### 🔐 RBAC (Ролевая модель доступа)
- **admin**: полный доступ
- **manager**: товары и заказы
- **user**: просмотр (frontend)

## 🏗 Структура проекта

```
shop/
├── common/                 # Общие компоненты
│   ├── config/            # Конфигурация
│   ├── models/            # Модели (Category, Product, Order, etc.)
│   └── components/        # Общие компоненты
├── frontend/              # Публичная часть
│   ├── config/           # Конфигурация frontend
│   ├── controllers/      # Контроллеры (CatalogController, SiteController)
│   ├── models/           # Модели форм (ProductSearch)
│   ├── views/            # Виды
│   └── web/              # Веб-доступные файлы
├── backend/               # Админ панель
│   ├── config/           # Конфигурация backend
│   ├── controllers/      # Контроллеры
│   ├── models/           # Модели
│   └── views/            # Виды
├── modules/               # Модули
│   └── cart/             # Модуль корзины
│       ├── components/   # Компонент Cart
│       ├── controllers/  # CartController
│       ├── models/       # CartItem
│       └── views/        # Виды модуля
├── console/              # Консольные команды
│   ├── config/          # Конфигурация
│   ├── controllers/     # Контроллеры команд
│   ├── migrations/      # Миграции БД
│   └── models/          # Модели команд
├── environments/         # Конфигурации окружений
└── vendor/               # Composer зависимости
```

## 🗄 База данных

### Основные таблицы

- **products** - товары
- **categories** - категории (с иерархией)
- **brands** - бренды
- **product_images** - изображения товаров
- **orders** - заказы
- **order_items** - элементы заказов
- **attributes** - характеристики (EAV)
- **product_attributes** - значения характеристик
- **user** - пользователи
- **RBAC таблицы** (auth_item, auth_assignment, auth_item_child, auth_rule) - для ролей и разрешений

### Связи

- Продукты связаны с категориями и брендами
- Заказы содержат элементы с товарами
- Характеристики товаров через EAV модель
- Пользователи имеют роли и разрешения через RBAC
- Заказы связаны с пользователями

## 🔧 API

### Каталог

- `GET /catalog` - список товаров с фильтрами
- `GET /catalog/1` - просмотр товара

### Корзина

- `POST /cart/add/1` - добавить товар в корзину
- `GET /cart` - просмотр корзины
- `POST /cart/update/1` - обновить количество
- `POST /cart/remove/1` - удалить товар
- `POST /cart/clear` - очистить корзину

### Консольные команды (RBAC)

- `php yii rbac/assign admin 1` - Назначить роль admin пользователю с ID 1
- `php yii rbac/revoke admin 1` - Отозвать роль admin у пользователя с ID 1
- `php yii rbac/assign manager 1` - Назначить роль manager пользователю с ID 1

## 🎨 Тема и дизайн

Проект использует Bootstrap 5 для отзывчивого дизайна. Основные компоненты:

- Навигационное меню
- Фильтры в боковой панели
- Сетка товаров
- Модальные окна для корзины
- Адаптивная верстка

## 🔒 Безопасность

- CSRF защита на формах
- Валидация входных данных
- Подготовленные SQL запросы
- **RBAC (Role-Based Access Control)** для админ панели:
  - Роли: admin, manager, user
  - Разрешения: manageProducts, manageOrders, manageUsers
  - Гибкая система для назначения прав
- Хэширование паролей
- Защита от XSS и SQL инъекций

## 📈 Производительность

- Кэширование конфигураций
- Оптимизированные запросы с жадной загрузкой
- Индексы в БД для быстрого поиска
- Пагинация для больших списков

## 🧪 Тестирование

```bash
# Запуск тестов
php vendor/bin/phpunit

# Codeception тесты
php vendor/bin/codecept run
```

## 🚀 Развертывание

### Production настройка

1. Выберите Production в `php init`
2. Настройте параметры в `environments/prod/`
3. Оптимизируйте автозагрузчик:
```bash
composer dump-autoload --optimize
```
4. Включите кэширование
5. Настройте веб-сервер для продакшена

## 🤝 Вклад в проект

1. Fork проект
2. Создайте feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit изменения (`git commit -m 'Add some AmazingFeature'`)
4. Push в branch (`git push origin feature/AmazingFeature`)
5. Создайте Pull Request

## 📄 Лицензия

Этот проект распространяется под лицензией MIT.

## 📞 Поддержка

При возникновении проблем:

1. Проверьте логи в `runtime/logs/`
2. Убедитесь в корректности конфигурации БД
3. Проверьте права доступа к файлам
4. Обратитесь к документации Yii2

## 🔄 Обновления

Для обновления зависимостей:

```bash
composer update
php yii migrate
```

## 📋 TODO

- [x] Админ панель с RBAC (роли и разрешения)
- [x] CRUD для товаров, заказов, пользователей
- [x] Dashboard с статистикой
- [x] Импорт/экспорт товаров в CSV
- [ ] Расширенная система поиска с Elasticsearch
- [ ] Платежные интеграции (ЮKassa, CloudPayments)
- [ ] Интеграция с СДЭК/Boxberry
- [ ] Email уведомления
- [ ] Мобильное приложение API
- [ ] Система скидок и промокодов
- [ ] Отзывы и рейтинги товаров
- [ ] Wishlist (список желаний)
- [ ] Многоязычность

---

**Разработано с ❤️ на Yii2 Framework**
