# ふぉとミール！

　料理の写真に店舗情報を紐づけて管理できるWebサービスです。

　投稿した料理は他のユーザーと共有することもできます。

## 本Webサービスの特徴

- **目的**

    - 私には外食した際に、料理の写真を撮る趣味があります。写真を見返したときに、「この料理をもう一度食べたい。でも、どこのお店で食べたのか思い出せない。」ということがありました。この不便を解決するために、写真の位置情報から店舗を調べられるようにしたい。また、食べたときの気持ちを投稿し、残せるようにしたいと思い、本Webサービスを作成しました。

- **主な機能**

    - 写真の位置情報から店舗の候補を取得することができます。

    - 料理に店舗情報を紐づけ、テキストを添えて投稿することができます。

    - グリッド表示、詳細表示、マップ表示など様々な視点から料理を確認することができます。

    - 検索、フィルター、ソート機能があり、料理を探すことができます。

## 機能一覧

- **ユーザー**
   - 登録
     - アイコンは選択した画像をform送信前に画面に表示できるようにしています。
     - 活動地域はGPS機能、またはワード検索で市区町村を取得して登録できます。
     - 料理の公開範囲を「全体、フレンド、非公開」から選択し登録できます。
   - アカウント
     - ユーザー情報の編集、削除ができます。
   - ログイン
   - ハンバーガーメニュー
     - マイページ
       - ユーザーシングル画面に移行します。(未実装)
     - アカウント
       - アカウント画面へ移行します。
     - ログアウト
       - ログアウトします。

- **料理**
   - 登録
     - 写真は選択した画像をform送信前に画面に表示できるようにしています。
     - 店舗は写真の位置情報、またはワード検索で取得して登録できます。
   - 編集
   - 削除
   - コレクション
     - 表示
       - 料理を一覧表示で確認できます。
       - 料理の公開範囲外のユーザーには表示されないようにしています。
     - 検索
       - 料理のタイトル、紹介文から検索できます。
       - 投稿者の名前、ユーザーIDから検索できます。
       - 店舗名、店舗の住所から検索できます。
       - フィルター
       - 全て
         - 全ての料理を表示します。
       - 自分
         - 自分の料理を表示します。
       - フレンド
         - フレンドの料理を表示します。
       - お気に入り
         - お気に入りの料理を表示します。
       - 活動地域
         - 自分の活動地域と一致する料理を表示します。
       - 近くの料理
         - 現在地から2km圏内の料理を表示します。
     - ソート
       - 登録順
         - 料理の登録順に並び替えます。
       - いいね！
         - 料理のいいね！順に並び替えます。
       - 気まぐれ
         - ランダムの順番に並び替えます。
     - 表示方法の切り替え
       - グリッド表示
       - 詳細表示
       - マップ表示
         - 料理に紐づく店舗の位置情報から、マップ上に料理を表示します。
   - シングル
     - 表示
       - 料理の情報を確認できます。
       - 店舗の情報を確認できます。
       - 料理の公開範囲外のユーザーには表示されないようにしています。
     - いいね！機能
     - お気に入り機能
     - コメント機能
       - コメントを投稿できます。
       - コメントに返信することもできます。
