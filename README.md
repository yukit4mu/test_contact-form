# test_contact-form

## 環境構築
### Dockerビルド
- git clone git@github.com:yukit4mu/test_contact-form.git
- docker-compose up -d --build
### Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env , 環境変数を適宜変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## 使用技術(実行環境)
- PHP 8.2.11
- Laravel 8.83.8
- jquery 3.7.1.min.js
- MySQL 8.0.26
- nginx 1.21.1

## ER図
```mermaid
erDiagram
  contacts ||--o{categories : "親テーブル"
  categories ||--o{users: "子テーブル"
  users ||--o{contacts: "fortify認証用"

  contacts {
    bigint id PK
    bigint categry_id FK
    varchar first_name "NOT NULL"
    varchar last_name "NOT NULL"
    tinyint gender "NOT NULL"
    varchar email "NOT NULL"
    varchar tell "NOT NULL"
    varchar address "NOT NULL"
    varchar building
    text detail "NOT NULL"
    timestamp created_at
    timestamp deleted_at
  }

   categories{
    bigint id PK
    varchar content "NOT NULL"
    timestamp created_at
    timestamp deleted_at
  }

  users {
    bigint id PK
    varchar name "NOT NULL"
    varchar email "NOT NULL"
    varchar password "NOT NULL"
    timestamp created_at
    timestamp deleted_at
  }
```
## URL
・開発環境
  - お問い合わせ画面：http://localhost/  
  - ユーザー登録: http://localhost/register  
  - 管理画面: http://localhost/admin  
・phpMyAdmin：http://localhost:8080/