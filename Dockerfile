# 1. ベースイメージの選択
# PHP 8.1 と Apacheウェブサーバーがプリインストールされた公式イメージを使用します。
FROM php:8.1-apache

# 2. Composerのインストール
# PHPのパッケージ管理ツールであるComposerをコンテナ内にインストールします。
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. 作業ディレクトリの設定
# コンテナ内の作業ディレクトリをApacheの公開フォルダに設定します。
WORKDIR /var/www/html

# 4. プロジェクトファイルのコピー
# ローカルの全てのファイル（index.php, composer.jsonなど）をコンテナ内にコピーします。
COPY . .

# 5. PHP依存ライブラリのインストール
# composer.json に基づいて、EasyUIBuilderなどのライブラリをインストールします。
# --no-interaction: 対話なしで実行
# --optimize-autoloader: パフォーマンス向上のための最適化
# --no-dev: 開発用のライブラリはインストールしない
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 6. ファイル所有者の変更 (おまじない)
# Apacheがファイルを正しく読み込めるように、ファイルの所有者をApacheの実行ユーザーに変更します。
RUN chown -R www-data:www-data /var/www/html
