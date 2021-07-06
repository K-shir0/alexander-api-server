# Alexander API Server

Alexander API Server(Frontend)

## Development
初回起動手順（.env.exampleから.envをコピーして下さい）
```
make init

make up

make install

make run-docker

make reset-db
```

起動手順
```
make up

make run-docker
```

終了手順（必ず実行して下さい）
```
make down
```

プロジェクト更新手順
```
make up

make install

make reset-db
```

---

コマンド集
```
初期化
make init

ライブラリをインストール
make install

Dockerを起動
make run-docker

Dockerが立ち上がってるか確認
make ps

Dockerを終了
make run-docker

開発モードで実行
make run-docker

DBをリセット&&マイグレーション
make reset-db

DBにログイン
make mariadb

テスト

リリースビルド
```

開発用ログイン
```
id laravel-a@example.com
pass password
```
