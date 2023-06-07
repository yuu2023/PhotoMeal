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
 
　**[こちらのリンクから、ご覧いただけます。](/doc/機能一覧.md)**


## 未実装機能

　本サービスは2023年5月上旬から開発しています。
 
　現在、開発途中のため、機能を追加実装する予定です。 
 
　追加する機能について、画面設計の画像を添えて、ご説明しています。
 
　**[こちらのリンクから、ご覧いただけます。](/doc/未実装機能.md)**
 
## 工夫した点

   - ユーザビリティを意識し、フェッチを使うことでシームレスに機能を使えるようにしています。
   　 実装例
       - ユーザー登録画面でYahoo!リバースジオコーダAPIと連携し、端末の位置情報から活動地域を取得できます。
       - ユーザー登録画面でYahoo!ジオコーダAPIと連携し、活動地域をワード検索できます。
       - 料理登録画面でグルメサーチAPIと連携し、写真の位置情報から店舗を取得できます。
       - 料理登録画面でグルメサーチAPIと連携し、店舗をワード検索できます。

   - ユーザビリティを意識し、画像送信前に選択した画像を確認できるように、画面に表示するようにしています。

   - 本サービスは位置情報を使用しますが、個人情報を知られたくない人にも配慮して設計しています。
     - 実装例
       - 端末の位置情報を利用したくないユーザーのために、検索機能を代替機能としてご用意しています。
       - 写真の位置情報を利用したくないユーザーのために、検索機能を代替機能としてご用意しています。
       - 「活動地域を登録しない」を選択する、また「活動地域の公開範囲」を選択することで、個人情報を守ることができます。
       - 料理の「公開範囲」を選択することで、個人情報を守ることができます。

   - 料理の店舗の詳細な場所が分かるように、Leafletと連携し、店舗の位置情報から料理をマップに表示できるようにしています。

## 実装環境

　バックエンド： PHP(8.2.5) , Laravel(10.9.0) , MySQL

　フロントエンド： HTML・CSS(SCSS), JavaScript, Bootstrap5, Tailwind CSS(3.3.2)
 
　外部API: グルメサーチAPI, Yahoo!ジオコーダAPI, Yahoo!リバースジオコーダAPI
 
　JavaScriptライブラリ： Leaflet
 
## ユーザー利用環境

   - 本サービスはスマホユーザが多いことを想定し作成しています。レスポンシブデザインとなっていますので、PCやタブレットにも対応しています。

   - 本サービスの全ての機能をご利用になるには位置情報を持つ写真が必要になります。位置情報を利用したくないユーザーには、検索機能を代替機能としてご利用いただけます。

   - 本サービスの全ての機能をご利用になるにはブラウザの設定で位置情報の取得を許可をしていただく必要があります。位置情報を利用したくないユーザーには、検索機能を代替機能としてご利用いただけます。

   - PCでご利用の際、インターネットのIPアドレスを元に現在地を割り出すため、制度が下がる可能性があります。
