# ふぉとミール！
  
  <kbd><img width="200" alt="料理コレクション画面グリッド表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/9ac0baeb-05d0-48e4-b008-475180fdaefb"></kbd>
  <kbd><img width="200" alt="料理コレクション画面詳細表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/1eb9c9dc-ead8-41d4-8a36-522c067cbd9d"></kbd>
  <kbd><img width="200" alt="料理コレクション画面マップ表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/3e8040cc-ec59-450b-963e-80766081dac0"></kbd>
     
　料理の写真に店舗情報を紐づけて管理できるWebサービスです。

　投稿した料理は他のユーザーと共有することもできます。

## 本Webサービスの特徴

- **目的**

    - 私には、外食した際に料理の写真を撮る趣味があります。写真を見返したときに、「この料理をもう一度食べたい。でも、どこのお店で食べたのか思い出せない。」ということがありました。この不便を解決するために、写真の位置情報から店舗を調べられるようにしたい。また、食べたときの気持ちを投稿し、残せるようにしたいと思い、本Webサービスを作成しました。

- **主な機能**

    - 写真の位置情報から店舗を取得することができます。
    - 料理に店舗情報を紐づけ、テキストを添えて投稿することができます。
    - グリッド表示、詳細表示、マップ表示など様々な視点から料理を確認することができます。
    - 検索、フィルター、ソート機能があり、料理を探すことができます。
    - 料理に対して、いいね！やコメントができるなど、ユーザー間で気持ちを共有できます。

## 機能一覧

- **ユーザー**

    本サービスを利用するためにアカウント登録をすることができます。

    - 登録画面

      <kbd><img width="200" alt="ユーザー登録画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/c40b0325-a464-4ed5-b6a7-344d4569fa51"></kbd>
      <kbd><img width="200" alt="ユーザー登録画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/478006aa-e528-4664-b5cf-1c3380eac5ae"></kbd>
      - アイコンに選択した画像をform送信前に表示して、確認できるようにしています。
      - 活動地域はGPS機能、またはワード検索で市区町村を取得して登録できます。
    - アカウント画面

      <kbd><img width="200" alt="アカウント画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/c2da8c42-e9c1-4001-bc79-9ba4631a1c5c"></kbd>
      <kbd><img width="200" alt="アカウント画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/360afada-849c-4838-b640-62a3f37e1920"></kbd>
      <kbd><img width="200" alt="アカウント画面3" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/1e221953-1a69-4efb-a500-aa4c76a83c34"></kbd>
    - ログイン画面

      <kbd><img width="200" alt="ログイン画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/49d581ff-d761-4b5e-ac19-9e4dd8c418be"></kbd>
    - ハンバーガーメニュー画面

      <kbd><img width="200" alt="ハンバーガーメニュー" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/eaaed702-a1bb-4c29-97d2-5685c9518c60"></kbd>
      
- **料理**

    食べた料理の写真に店舗情報を紐づけて投稿することができます。

    - 登録画面
     
      <kbd><img width="200" alt="料理登録画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/f0c8d629-3d22-49f7-8aa1-d0d0d531feb2"></kbd>
      <kbd><img width="200" alt="料理登録画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/207cebf4-eb30-4b13-b4ac-ebfee323524b"></kbd>
      - 写真に選択した画像をform送信前に画面に表示して、確認できるようにしています。
      - 店舗は写真の位置情報、またはワード検索で取得して登録できます。
    - 編集画面

      <kbd><img width="200" alt="料理編集画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/5b6e8ee6-abb1-4e61-8bf6-202908f4151c"></kbd>
      <kbd><img width="200" alt="料理編集画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/8e483d51-d841-4a0e-a30a-237df47db524"></kbd>
    - 削除画面

      <kbd><img width="200" alt="料理削除画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/238840fe-766e-4e5a-864e-575038f61d03"></kbd>
    - コレクション画面

      <kbd><img width="200" alt="料理コレクション画面グリッド表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/9ac0baeb-05d0-48e4-b008-475180fdaefb"></kbd>
      <kbd><img width="200" alt="料理コレクション画面詳細表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/1eb9c9dc-ead8-41d4-8a36-522c067cbd9d"></kbd>
      <kbd><img width="200" alt="料理コレクション画面マップ表示" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/3e8040cc-ec59-450b-963e-80766081dac0"></kbd>
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
    - シングル画面

      <kbd><img width="200" alt="料理シングル画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/df184f54-c314-4720-9e9f-7b0b915f6ee9"></kbd>
      <kbd><img width="200" alt="料理シングル画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/a49f2c57-cf76-4e62-84d1-b503645ad5fa"></kbd>
      - 表示
        - 料理の情報を確認できます。
        - 店舗の情報を確認できます。
        - 料理の公開範囲外のユーザーには表示されないようにしています。
      - いいね！機能
      - お気に入り機能
      - コメント機能
     
        <kbd><img width="200" alt="コメントシングル画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/7969ec17-5abd-4859-a91d-f52d8cf322c1"></kbd>
        - 料理に対してコメントを投稿できます。
        - コメントに返信することもできます。

## 未実装機能

　本サービスは2023年5月上旬から開発しています。
 
　現在、開発途中であり、以下の機能を追加実装する予定です。 

   - **メニュー**
     
       料理をまとめオリジナルのメニュー表を作成できます。
       
       - 登録画面
       
         <kbd><img width="200" alt="メニュー登録画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/584d8d5e-e779-432e-a686-b1a411254aa7"></kbd>
       
       - 削除画面
       
         <kbd><img width="200" alt="メニュー削除画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/3d2b342d-9c52-40fe-80fc-e83f6c876e9f"></kbd>

       - メニューの料理を追加画面

         <kbd><img width="200" alt="メニューの料理を追加画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/18fe3e8e-e5ba-4daa-a4c9-3bbd5c8491dc"></kbd>
         <kbd><img width="200" alt="メニューの料理を追加画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/98b97a8d-1947-4143-a46a-9d187b48b5ed"></kbd>
         <kbd><img width="200" alt="メニューの料理を追加画面3" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/499ffae2-6431-475c-b7bf-5349c2cadc5a"></kbd>
 
       - メニューの料理を削除画面

         <kbd><img width="200" alt="メニューの料理を削除画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/ade770af-f31b-4c0c-8350-34cb7abe8b1b"></kbd>
         
       - コレクション画面

         <kbd><img width="200" alt="メニューコレクション画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/22b3ee80-e834-40d6-ac24-fc5abce59619"></kbd>

       - シングル画面

         <kbd><img width="200" alt="メニューシングル画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/dd3749ad-0d89-4fdc-a2df-16c3f1d56d31"></kbd>
         <kbd><img width="200" alt="メニューシングル画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/5446f5b9-746f-482c-bc81-2e775073965e"></kbd>
         <kbd><img width="200" alt="メニューシングル画面3" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/6eedd0b9-051e-4a54-b48f-ddacb3bdf35b"></kbd>

   - **オーナー**
   
       オーナーとは本サービスを利用するユーザーのことです。
       
       料理やメニューを作成できることから、お店のオーナーになるイメージで命名しました。
       
       - コレクション画面

         <kbd><img width="200" alt="オーナーコレクション画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/d0dfeb71-6d26-4783-b6e6-02fc00a2388f"></kbd>

       - シングル画面

         <kbd><img width="200" alt="オーナーシングル画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/ae55710c-a8cc-4d45-a838-9da0017b05e7"></kbd>
         <kbd><img width="200" alt="オーナーシングル画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/63149a96-391c-426a-976e-9f1b72ff5774"></kbd>
         <kbd><img width="200" alt="オーナーシングル画面3" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/c501d0b8-6ca1-4f6c-8a6a-4ebd7063cb1a"></kbd>

   - **ランキング**
   
       いいね！の数のランキングです。
       
       ユーザーのモチベーションを上げる要素の一つとして作成します。
       
       - 料理ランキング画面

         <kbd><img width="200" alt="料理ランキング画面1" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/57d4d950-0579-4a31-9aec-a9ac8b756ab6"></kbd>
         <kbd><img width="200" alt="料理ランキング画面2" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/41149840-6a52-41c3-82e1-a8eb9569bd99"></kbd>

       - メニューランキング画面

         <kbd><img width="200" alt="メニューランキング画面" src="https://github.com/yuu2023/PhotoMeal/assets/131323286/5c989af7-6fcf-446f-a761-3f440a88c60c"></kbd>
