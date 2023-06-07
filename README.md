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

　本サービスの機能一覧を、実際の画面の画像を添えて、ご説明しています。
 
　[こちらのリンクから、ご覧いただけます。](/doc/機能一覧.md)


## 未実装機能

　本サービスは2023年5月上旬から開発しています。
 
　現在、開発途中で、以下の機能を追加実装する予定です。 

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

## 実装環境

　バックエンド： PHP(8.2.5) , Laravel(10.9.0) , MySQL

　フロントエンド： HTML・CSS(SCSS), JavaScript, Bootstrap5, Tailwind CSS(3.3.2)
 
　外部API: グルメサーチAPI, Yahoo!ジオコーダAPI, Yahoo!リバースジオコーダAPI
 
　JavaScriptライブラリ： Leaflet
 
## ユーザー利用環境

   - 本サービスはスマホユーザが多いことを想定し作成しています。レスポンシブデザインとなっていますので、PCやタブレットにも対応しています。

   - 本サービスの全ての機能をご利用になるには位置情報を持つ写真が必要になります。位置情報を取得されたくないユーザーには、検索機能を代替機能としてご利用いただけます。

   - 本サービスの全ての機能をご利用になるにはブラウザの設定で位置情報の取得を許可をしていただく必要があります。位置情報を取得されたくないユーザーには、検索機能を代替機能としてご利用いただけます。

   - PCでご利用の際、インターネットのIPアドレスを元に現在地を割り出すため、制度が下がる可能性があります。
