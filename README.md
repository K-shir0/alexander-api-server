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

別タブで
make run-docker-echo
```

起動手順
```
make up

make run-docker

別タブで
make run-docker-echo
```

終了手順（必ず実行して下さい）
```
make down
```

プロジェクト更新手順
```
make down-clean

（※1個目は特に指定なければスキップ）
--------------------------------

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
make up

Dockerが立ち上がってるか確認
make ps

Dockerを終了
make down

開発モードで実行
make run-docker

echoサーバを実行
make run-docker-echo

DBをリセット&&マイグレーション
make reset-db

DBにログイン
make mariadb

テスト

リリースビルド
```

開発用ログイン(ID, PASSWORD)
```
laravel-a@example.com
password
```
