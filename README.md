# 自然の恵み農園 WordPressテーマ

## 開発環境のセットアップ

### 1. Dockerコンテナの起動

```bash
docker compose up -d
```

### 2. SASSの監視を開始

```bash
npm run watch:scss
```

このコマンドを実行すると、`assets/scss/`配下のSASSファイルを監視し、変更があれば自動的に`assets/css/style.css`にコンパイルします。

### 3. 自動リロード機能

開発環境（`WORDPRESS_DEBUG: 1`）では、CSSファイルが更新されると自動的にブラウザがリロードされます。

- SASSファイルを編集 → 自動的にCSSにコンパイル → ブラウザが自動リロード

### 動作確認

1. ブラウザで `http://localhost:8080` を開く
2. `assets/scss/` 配下のSASSファイルを編集して保存
3. 約1秒後にブラウザが自動的にリロードされます

## 開発ワークフロー

```bash
# 1. Dockerを起動
docker compose up -d

# 2. SASS監視を開始（別ターミナル）
npm run watch:scss

# 3. コーディング
# SASSファイルを編集 → 保存 → 自動でCSSにコンパイル → ブラウザリロード
```

## 本番環境へのデプロイ

本番環境では、`functions.php`の自動リロード機能をコメントアウトしてください：

```php
// 開発環境用：自動リロード機能
// 本番環境では必ずコメントアウトしてください
// function add_livereload_script() { ... }
// add_action('wp_footer', 'add_livereload_script');
```

また、`compose.yml`の`WORDPRESS_DEBUG`を`0`に変更してください。
