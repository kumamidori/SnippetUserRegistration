# KumamidoriSnippet.UserRegistration

- ブログ記事の説明用に書いたスニペット
- Symfony2で作られたユーザー登録サンプル [phpmentors-jp/phpmentors-training-example-symfony](https://github.com/phpmentors-jp/phpmentors-training-example-symfony)
を見て、そのうちの一部機能をBEARアプリケーションとして個人的に移植したものです。

## Usage

```
php bootstrap/web.php post 'app://self/users/registration?lastName=KUMA&firstName=Nana&email=shigematsu.nana@gmail.com&password=testtest' 
```

## 説明用なので、下記は未実装

- ユーザの有効化機能
- メール送信機能
- バリデーション
- フォーム
- ページフロー
- デザイン

# DB migration

```
./vendor/bin/doctrine orm:schema-tool:create
```

```
./vendor/bin/doctrine  orm:schema-tool:update --force
```

# ブログ記事

- コネクタとしての BEAR.Resource について考えたこと（近日UP予定）
