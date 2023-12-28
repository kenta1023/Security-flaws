1. Docker ファイルの環境変数に flag をセット
2. Docker イメージをビルドする
   `docker build -t directory_traversal .`
3. Docker コンテナ起動
   `docker run -p 8020:80 directory_traversal`
4. アクセス
   http://<IP アドレス>:8020/
